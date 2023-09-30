<?php

namespace jquery_dashboard;

class Connection 
{
    private $host = 'localhost';
    private $dbname = 'dashboard';
    private $user = 'root';
    private $pass = 'g8p6e5w8';

    public function connect()
    {

        try {

            $conn = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;",
                $this->user,
                $this->pass
            );

            $conn->exec('set charset set utf8');

            return $conn;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }


}