<?php

class bdd
{

    private mysqli $bdd;

    public string $hostname, $username, $password, $database, $port;

    function __construct()
    {
        $this->hostname = database_login::$hostname;
        $this->username = database_login::$username;
        $this->password = database_login::$password;
        $this->database = database_login::$database;
        $this->port = database_login::$port;
    }

    public function request($req)
    {
        return $this->bdd->query($req);
    }

    public function connect(): void
    {
        $this->bdd = new mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);

        
    }

    public function disconnect(): void
    {
        $this->bdd->close();
    }

}