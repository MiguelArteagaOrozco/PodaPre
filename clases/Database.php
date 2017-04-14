<?php
class Database {

    private $link;
    private $host, $username, $password, $database;

    public function __construct(){
        $this->host   = "localhost";
        $this->username    = "root";
        $this->password    = "1682951";
        $this->database    = "poda";

        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        return true;
    }

    public function getAllLigas(){
        return $this->query("select * from liga;");
    }

    public function query($query) {
        $result = mysqli_query($this->link, $query); 
        if (!$result)
            die('Invalid query: ' . mysqli_error($this->link));


        return $result;

    }

    public function __destruct() {
        mysqli_close($this->link)
            OR die("There was a problem disconnecting from the database.");
    }
}
?>