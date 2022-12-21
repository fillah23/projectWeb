<?php 
class Database{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $mysqli;
  
    public function __construct() {
      $this->db_connect();
    }
  
    public function db_connect(){
      $this->host = 'localhost';
      $this->user = 'root';
      $this->pass = '';
      $this->db = 'fans';
  
      $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
      return $this->mysqli;
    }
  }
?>