<?php
require __DIR__."/slask.php";
class Evote {

    private function connect(){
	$conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
//
//--------------------------------------------------------------------------------------
    public function ongoingSession(){
        $conn = $this->connect();
        $sql =  "SELECT active FROM sessions WHERE (active=1)";
        $r = $conn->query($sql);
        if($r->num_rows > 0){
            return TRUE;
        }
	return FALSE;
    }

    public function ongoingRound(){
        $conn = $this->connect();
        $sql =  "SELECT active FROM elections WHERE (active=1)";
        $r = $conn->query($sql);
        if($r->num_rows > 0){
            return TRUE;
        }
	return FALSE;
    }

// USER FUNCTIONS
//--------------------------------------------------------------------------------------
    public function login($user, $password){
        $conn = $this->connect();
        $sql =  "SELECT password FROM user WHERE (username=\"$user\")";
        $r = $conn->query($sql);
        if($r->num_rows > 0){
            $ok = FALSE;
            while($row = $r->fetch_assoc()){
                $hash = $row["password"];
                $ok = crypt($password, "duvetvad") == $hash;
                $ok = password_verify($password, $hash);
            }
            return $ok;
        }else{
	    return FALSE;
        }

    }

    public function createNewUser($username, $password, $privilege){
        $hash = crypt($password, "duvetvad"); 
        $conn = $this->connect();
        $sql =  "INSERT INTO user (username, password, privilege) VALUES (\"$username\", \"$hash\", \"$privilege\")";
        $r = $conn->query($sql);

    }

    public function verifyUser($username, $privilege){
        $conn = $this->connect();
        $sql =  "SELECT privilege FROM user WHERE (username=\"$username\")";
        $r = $conn->query($sql);
        if($r != FALSE){
            $ok = FALSE;
            while($row = $r->fetch_assoc()){
                if($row["privilege"] == $privilege){
                    $ok = TRUE;
                }
            }
            return $ok;
        }else{
	    return FALSE;
        }
    }

    public function newPassword($username, $password){
        $hash = crypt($password, "duvetvad");
        $conn = $this->connect();
        $sql =  "UPDATE user SET password=\"$hash\" WHERE username=\"$username\"";
        $r = $conn->query($sql);
        
    }
// DATA FUNCTIONS
//-----------------------------------------------------------------------------
    public function vote($option_id, $personal_code, $current_code){
        $conn = $this->connect();
        $sql1 = "SELECT pass FROM elections WHERE (active=1)";
        $r = $conn->query($sql1);
        $current_code_ok = FALSE;
        if($r->num_rows > 0){
            while($row = $r->fetch_assoc()){
                $hash = $row["pass"];
                $current_code_ok = password_verify($current_code, $hash);
            }
        }

        $hash = crypt($personal_code);
        $sql2 = "SELECT id FROM elections_codes WHERE (code=\"$personal_code\" AND active IS NULL)";
        $r2 = $conn->query($sql2);
        $personal_code_ok = FALSE;
        $id = -1;
        if($r2->num_rows > 0){
            while($row = $r2->fetch_assoc()){
                    $personal_code_ok = TRUE;
                    $id = $row["id"];
            }
        }

        if($personal_code_ok && $current_code_ok){
            $sql3 = "INSERT INTO elections_usage (alternative_id, code_id, election_id) VALUES ($option_id, $id, (SELECT MAX(id) FROM elections));";
            $sql3.= "UPDATE elections_codes SET active=(SELECT MAX(id) FROM elections) WHERE id=$id;";
            $conn->multi_query($sql3);
            echo $conn->error;
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function newRound($name, $code, $options){
        $conn = $this->connect();
        $ok = TRUE;
        $hash = password_hash($code, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO elections (name, pass, active) VALUES (\"$name\", \"$hash\", TRUE)";
        $last_id = -1;
        if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "Database created successfully";
        } else {
                echo "Error creating database: " . $conn->error;
                $ok = FALSE;
        }

        $sql2 = "";
        foreach ($options as $opt){
            $sql2 .= "INSERT INTO elections_alternatives (election_id, name, nbr_votes) VALUES (\"$last_id\",\"$opt\", 0);";
        }
        $sql2 .= "INSERT INTO elections_alternatives (election_id, name, nbr_votes) VALUES (\"$last_id\",\"-Blank-\" , 0);";
        if ($conn->multi_query($sql2) === TRUE) {
                echo "Database created successfully";
        } else {
                echo "Error creating database: " . $conn->error;
                $ok = FALSE;
        }

        $conn->close();
        return $ok;
    }

    public function getOptions(){
        $conn = $this->connect();
        $ok = TRUE;

        $sql = "SELECT elections_alternatives.id AS id, elections_alternatives.name AS name, elections.name AS e_name FROM elections_alternatives
            LEFT JOIN elections ON (elections_alternatives.election_id = elections.id)
            WHERE (elections.active = 1)";
        $res = $conn->query($sql);
        echo $conn->error;
        $conn->close();

        return $res;

    }

    public function getResult(){
        $conn = $this->connect();

        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name, t2.id AS e_id, t2.tot_votes AS tot FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            WHERE (t2.active = 0)
            ORDER BY t2.id DESC, votes DESC";
        $res = $conn->query($sql);
        //return $conn->error;
        $conn->close();

        return $res;

    }
    public function getLastResult(){
        $conn = $this->connect();

        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name, t2.tot_votes AS tot FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            WHERE (t2.id = (SELECT MAX(elections.id) FROM elections) AND t2.active = 0)
            ORDER BY votes DESC";
        $res = $conn->query($sql);
        //return $conn->error;
        $conn->close();

        return $res;

    }

    public function endRound(){
        // Updatera antalet röster
        $conn  = $this->connect();
        $sql2 = "SELECT elections_alternatives.id AS id, elections_alternatives.name AS name, elections.name AS e_name FROM elections_alternatives
            LEFT JOIN elections ON (elections_alternatives.election_id = elections.id)
            WHERE (elections.active = 1)";
        $r2 = $conn->query($sql2);
        echo $conn->error;
        echo "hej";
        if($r2->num_rows > 0){
            while($row = $r2->fetch_assoc()){
                $alternative_id = $row["id"];
                $sql3 = "UPDATE elections_alternatives
                        SET nbr_votes=(SELECT COUNT(id) FROM elections_usage WHERE alternative_id=$alternative_id)
                        WHERE id=$alternative_id";
                $conn->query($sql3);
                echo $alternative_id;
                echo $conn->error;
            }
        }
        $conn->close();

        // aktivera koder och avsluta omgång
        $conn = $this->connect();
        $sql = "UPDATE elections SET active=0;";
        $sql .= "UPDATE elections_codes SET active=NULL;";
        $r = $conn->multi_query($sql);
        $conn->close();

        // räkna totala antalet röster
        $conn = $this->connect();
        $sql3 = "UPDATE elections AS t1 SET tot_votes = ( SELECT SUM( nbr_votes )
                FROM elections_alternatives AS t2
                WHERE t2.election_id = (
                SELECT MAX( t1.id ) ) )";
        $conn->query($sql3);
        $conn->close();
    }

    public function newCodes($codes){
        $conn = $this->connect();

        $sql = "";
        foreach($codes as $c){
            $hash = crypt($c);
            $sql .= "INSERT INTO elections_codes (code, active) VALUES (\"$c\", NULL);";
        }
        $r = $conn->multi_query($sql);

        $conn->close();
    }

    public function newSession($name){
        $conn = $this->connect();

        $sql = "INSERT INTO sessions (name, active) VALUES (\"$name\", TRUE)";
        $r = $conn->query($sql);
        $conn->close();
    }

    public function endSession(){
        $conn = $this->connect();

        $sql = "UPDATE sessions SET active=0;";
        $sql .= "TRUNCATE TABLE elections;";
        $sql .= "TRUNCATE TABLE elections_alternatives;";
        $sql .= "TRUNCATE TABLE elections_codes;";
        $sql .= "TRUNCATE TABLE elections_usage;";
        $conn->multi_query($sql);
        $conn->close();

    }

}
?>
