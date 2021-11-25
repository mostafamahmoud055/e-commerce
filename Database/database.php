<?php
class database{
  private $host='localhost';
  private $username = 'root';
  private $password = '';
  private $dbName ='e-commerce';
  private $con='';

  public function __construct()
  {
    $this->con = new mysqli($this->host,$this->username,$this->password,$this->dbName);
    if($this->con->connect_error){
      die("connection faild".$this->con->connect_error);
    }
  }

  public function runDML($query){
    $result = $this->con->query($query);
    if($result){
      return true;
    }else{
      return false;
    }
  }

  public function runDQL($query){
    $result = $this->con->query($query);
    
    if($result->num_rows > 0){
      return $result;
    }else{
      return [];
    }
  }
}

  