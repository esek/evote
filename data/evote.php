<?php
class Evote {

    private function connect(){
        $conn = new mysqli("localhost", "evote", "evote", "evote");
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        } 
        return $conn;
    }
        
    /**
       Returns the election id. If there is no ongoing election it returns NULL.
    @return 	electionId | NULL
    */	
    public function getElectionId(){
	return 1;
    }
	/*
    Tells if there is a ongoing round
    @return 	TRUE | FALSE
    */
    public function ongoingRound(){
	return FALSE;
    }   
	/*
    Check username and password at login
    @return		TRUE | FALSE
    @param	(user)
    @param 	(password)
    */
    public function usercheck($user, $password){
        
	return TRUE;
    }

    public function vote($id, $pass){
        
    }

    public function newRound($name, $code, $options){
        $conn = $this->connect();
        $ok = TRUE;
        $sql =  "INSERT INTO elections (name, pass, active) VALUES (\"$name\", \"$code\", TRUE)";
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
        
        $sql = "SELECT elections_alternatives.id AS id, elections_alternatives.name AS name FROM elections_alternatives
            LEFT JOIN elections ON (elections_alternatives.election_id = elections.id)
            WHERE (elections.active = 1)";
        $res = $conn->query($sql);
        echo $conn->error;
        $conn->close();

        return $res;

    }

    public function getResult(){
        $conn = $this->connect();
        
        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            ORDER BY t1.id, t1.nbr_votes";
        $res = $conn->query($sql);
        //return $conn->error;
        $conn->close();

        return $res;

    }
    public function getLastResult(){
        $conn = $this->connect();

        $sql = "SELECT MAX(elections.id) AS max FROM elections";
        $r = $conn->query($sql);
        $row = $r->fetch_assoc();
        $maxId = $row["max"];
        $sql = "SELECT t1.nbr_votes AS votes, t1.name AS name, t2.name AS e_name FROM elections_alternatives AS t1
            LEFT JOIN elections AS t2 ON (t1.election_id = t2.id)
            WHERE (t2.id = \"$maxId\")
            ORDER BY t1.id, t1.nbr_votes";
        $res = $conn->query($sql);
        //return $conn->error;
        $conn->close();

        return $res;

    }

}
?>
