<?php
include_once "../Models/User.php";
trait userData {
  public function userData($user,$name,$password,$email,$phone,$gender,$code){

    $user->setName($name);
    $user->setPassword($password);
    $user->setEmail($email);
    $user->setPhone($phone);
    $user->setGender($gender);
    $user->setCode($code);
  }
}