<?php

class logoutController {

  public function logout(){
    session_unset();
    session_destroy();
    header('location:../Views/login.php');  
  }
}