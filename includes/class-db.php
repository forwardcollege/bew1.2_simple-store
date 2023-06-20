<?php

class DB
{
    private $host = 'mysql';
    private $db_name = 'php_docker';
    private $username = 'root';
    private $password = 'secret';
    private $db;

    public function __construct()
    {
        $this->db =  new PDO(
            "mysql:host=$this->host;dbname=$this->db_name", 
            $this->username, 
            $this->password
        );
    }

    public function fetch( $sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetch();
    }

    public function fetchAll( $sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetchAll();
    }

    public function insert( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $this->db->lastInsertId();
    }

    public function update( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->rowCount();
    }

    public function delete( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->rowCount();
    }

    // get the last inserted id from the database
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}