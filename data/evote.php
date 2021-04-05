<?php
// Loading config files
include "config.php";

class Evote {

    private function connect(){
	$conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    /**
     * Deprecated: We should NOT generate our own salts
     */
    private function generateSalt($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Checks and updates password hash to default algo
     * Should ONLY be used on verified users!
     */
    private function verifyPasswordHash($user, $password, $hash) {
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            $this->newPassword($user, $password);
        } else {
            return;
        }
    }

//
//--------------------------------------------------------------------------------------
    public function ongoingSession(){
        $conn = $this->connect();
        $sql =  "SELECT active FROM sessions WHERE (active=1)";
        $r = $conn->query($sql);
        $conn->close();
        if($r->num_rows > 0){
            return TRUE;
        }
	    return FALSE;
    }

    public function ongoingRound(){
        $conn = $this->connect();
        $sql =  "SELECT active FROM elections WHERE (active=1)";
        $r = $conn->query($sql);
        $conn->close();
        if($r->num_rows > 0){
            return TRUE;
        }
	    return FALSE;
    }

    public function countRounds(){
        $conn = $this->connect();
        $sql =  "SELECT COUNT(id) FROM elections";
        $r = $conn->query($sql);
        $count = 0;
        while($row = $r->fetch_array()){
            $count = $row[0];
        }
        $conn->close();
        return $count;
    }

    public function getMaxAlternatives(){
        $conn = $this->connect();
        $sql =  "SELECT nbr_choices FROM elections WHERE active=1";
        $r = $conn->query($sql);
        $count = 0;
        while($row = $r->fetch_array()){
            $count = $row[0];
        }
        $conn->close();
        return $count;
    }

    public function getMaxAltByAltId($id){
        $conn = $this->connect();
        $sql =  "SELECT nbr_choices FROM elections
                WHERE id=(SELECT election_id FROM elections_alternatives WHERE id=$id)";
        $r = $conn->query($sql);
        $count = 0;
        while($row = $r->fetch_array()){
            $count = $row[0];
        }
        $conn->close();
        return $count;
    }

    // ser om en lista med val tillhör rätt valomgång
    public function checkRightElection($alt_ids){
        $conn = $this->connect();

        foreach ($alt_ids as $id) {
            $sql =  "SELECT active FROM elections
                    WHERE id=(SELECT election_id FROM elections_alternatives WHERE id=$id)";
            $r = $conn->query($sql);
            $count = 0;
            while($row = $r->fetch_array()){
                if(!$row[0]){
                    return FALSE;
                }
            }
        }

        return TRUE;

    }

    public function getAllSessions(){
        $conn = $this->connect();
        $sql = "SELECT * FROM sessions ORDER BY id DESC;";
        $res = $conn->query($sql);
        echo $conn->error;
        $conn->close();

        return $res;
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
                $ok = password_verify($password, $hash);
                // If we have an OK password, we should make sure that the hash is up-to-date
                if ($ok == TRUE) {
                    $this->verifyPasswordHash($user, $password, $hash);
                }
            }
            return $ok;
        }else{
	        return FALSE;
        }
    }

    public function createNewUser($username, $password, $privilege){
        $hash = password_hash($password, PASSWORD_DEFAULT);
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

    public function getPrivilege($username){
        $conn = $this->connect();
        $sql =  "SELECT privilege FROM user WHERE (username=\"$username\")";
        $r = $conn->query($sql);
        if($r != FALSE){
            while($row = $r->fetch_assoc()){
                return intval($row["privilege"]);
            }
        }
        return -1; // Default value
    }

    public function newPassword($username, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $conn = $this->connect();
        $sql =  "UPDATE user SET password=\"$hash\" WHERE username=\"$username\"";
        $r = $conn->query($sql);

    }

    public function listUsers(){
        $conn = $this->connect();
        $sql =  "SELECT * FROM user";
        return $conn->query($sql);
    }

    public function deleteUsers($users_id){
        $conn = $this->connect();
        $sql = "DELETE FROM user WHERE id IN ";
        $started = FALSE;
        foreach($users_id as $id){
            if(!$started){
                $sql .= "($id ";
                $started = TRUE;
            }else{
                $sql .=  ",$id";
            }
        }
        if(!$started){
            $sql .= "-1";
        }else{
            $sql .= ")";
        }
        $conn->query($sql);
    }

    public function usernameExists($username){
        $conn = $this->connect();
        $sql =  "SELECT * FROM user WHERE username=\"$username\"";
        $res = $conn->query($sql);
        return ($res->num_rows > 0);
    }
// DATA FUNCTIONS
//-----------------------------------------------------------------------------
    public function vote($options, $personal_code, $current_code){
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

        $hash = crypt($personal_code, LOCAL_CONST_HASH_PEPPER); // LOCAL_CONST_HASH_PEPPER is generated to data/config.php by setup.py
        $sql2 = "SELECT id FROM elections_codes WHERE (code=\"$hash\" AND active IS NULL)";
        $r2 = $conn->query($sql2);
        $personal_code_ok = FALSE;
        $id = -1;
        if($r2->num_rows > 0){
            while($row = $r2->fetch_assoc()){
                    $personal_code_ok = TRUE;
                    $id = $row["id"];
            }
        }

        // lägg in i databasen
        if($personal_code_ok && $current_code_ok && $this->checkRightElection($options)){
            $sql3 = "INSERT INTO elections_usage (alternative_id, code_id, election_id) VALUES ";
            $p = 0;
            foreach ($options as $option_id) {
                if($p != 0){
                    $sql3 .= ", ";
                }
                $sql3 .= "($option_id, $id, (SELECT MAX(id) FROM elections))";
                $p++;
            }
            if($p > 0){
                $conn->multi_query($sql3);
                echo $conn->error;
            }

            $sql4 = "UPDATE elections_codes SET active=(SELECT MAX(id) FROM elections) WHERE id=$id";
            $conn->multi_query($sql4);
            echo $conn->error;
            echo $p;
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function newRound($name, $code, $max, $options){
        $conn = $this->connect();
        $ok = TRUE;
        $hash = password_hash($code, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO elections (name, pass, active, nbr_choices) VALUES (\"$name\", \"$hash\", TRUE, \"$max\")";
        $last_id = -1;
        if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "Database created successfully";
        } else {
                echo "Error creating database: " . $conn->error;
                $ok = FALSE;
        }

        $sql2 = "INSERT INTO elections_alternatives (election_id, name, nbr_votes) VALUES";
        foreach ($options as $opt){
            $sql2 .= "(\"$last_id\",\"$opt\", 0),";
        }
        $sql2 .= "(\"$last_id\",\"-Blank-\" , 0)";
        if ($conn->query($sql2) === TRUE) {
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

        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name, t2.id AS e_id, t2.tot_votes AS tot, t1.id AS id
            FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            WHERE (t2.active = 0)
            ORDER BY t2.id DESC, votes DESC, t1.id ASC";
        $res = $conn->query($sql);
        //return $conn->error;
        $conn->close();

        return $res;

    }
    public function getLastResult(){
        $conn = $this->connect();

        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name, t2.id AS e_id, t2.tot_votes AS tot, t1.id AS id
            FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            WHERE (t2.id = (SELECT MAX(elections.id) FROM elections) AND t2.active = 0)
            ORDER BY votes DESC, t1.id ASC";
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
        $sql = "SELECT * FROM elections_alternatives WHERE election_id=(SELECT MAX(id) FROM elections)";
        $r = $conn->query($sql);
        if($r->num_rows > 0){
            while($row = $r->fetch_assoc()){
                $hash = password_hash($row["name"].$row["nbr_votes"], PASSWORD_DEFAULT);
                $sql = "UPDATE elections_alternatives SET hash=\"$hash\" WHERE id=".$row["id"];
                $conn->query($sql);
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

        $sql = "INSERT INTO elections_codes (code, active) VALUES ";
        $count = 0;
        foreach($codes as $c){
            $hash = crypt($c, LOCAL_CONST_HASH_PEPPER); // Generated to data/config.php on setup
            if($count == 0){
                $sql .= "(\"$hash\", NULL)";
            }else{
                $sql .= ", (\"$hash\", NULL)";
            }
            $count++;
            //$sql .= "INSERT INTO elections_codes (code, active) VALUES (\"$hash\", NULL);";
        }
        $r = $conn->query($sql);

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

        $sql = "UPDATE sessions SET end=now() WHERE active=1;";
        $sql .= "UPDATE sessions SET active=0;";
        $sql .= "TRUNCATE TABLE elections;";
        $sql .= "TRUNCATE TABLE elections_alternatives;";
        $sql .= "TRUNCATE TABLE elections_codes;";
        $sql .= "TRUNCATE TABLE elections_usage;";
        $conn->multi_query($sql);
        $conn->close();

    }

    public function checkCheating(){
        $conn = $this->connect();

        $ok = FALSE;
        $sql = "SELECT * FROM elections_alternatives WHERE hash IS NOT NULL";
        $r = $conn->query($sql);

        if($r->num_rows > 0){
            while($row = $r->fetch_assoc()){
                $test = $row["name"].$row["nbr_votes"];
                $hash = $row["hash"];
                if(!password_verify($test, $hash)) {
                    $ok = TRUE;
                }
            }
        }

        return $ok;
    }

}
?>
