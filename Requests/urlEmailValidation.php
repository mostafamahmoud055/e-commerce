<?php
include_once "../Models/User.php";
class urlEmailValidation{
  private $url;
  public function urlEmail($url){
    $this->url = $url;
    
    if(isset($this->url['verify-email'])&&!empty($this->url['verify-email'])){
      $user = new User;
      $user->setEmail($this->url['verify-email']);
      $userData = $user->emailCheckDB();

      if($userData->num_rows > 0){
        
        return $userData->fetch_object();
      }else{
        return [];
      }
    }else{
      return [];
    }
  }
}