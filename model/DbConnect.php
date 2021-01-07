<?php
class DbConnect{
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $db;
    private $conn;

    function OpenCon()
    {
        $this->dbhost = "127.0.0.1:3306";
        $this->dbuser = "root";
        $this->dbpass = "";
        $this->db = "sellfinish_classified";
        //Creating the connection to the database
        $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass,$this->db) or die("Connect failed: %s\n". $this->conn -> error);

        return $this->conn;
    }

    function CloseCon($conn)
    {
        $this->conn -> close();
    }

}


?>
