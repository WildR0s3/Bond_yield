<?php

class database {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "bonds";

        $connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        return $connection;
    }
}