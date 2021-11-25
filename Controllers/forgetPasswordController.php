<?php
include_once "../Requests/validationRequest.php";
include_once "../Traits/sendMail.php";
include_once "../models/User.php";
class forgetPasswordController{
  use sendMail;
  public function forgetPassword_get(){
    
    header('location:../Views/forget-password.php');
  }
  public function forgetPassword_post($request){
    $valid = new validationRequest;
    $valid->setEmail($request['email']);
    $result = $valid->emailValidation();
    if(!empty($result)){
      $_SESSION['message']['errors'] = $result;
      $_SESSION['request'] = $request;
      header('location:../Views/forget-password.php');die;
    }

    $user = new User;
    $user->setEmail($request['email']);
    $result = $user->emailCheckDB();
    if($result){
      $code=rand(10000,99999);
      $user->setCode($code);
      $user->updateCode();
      $mailResult = $this->sendMails($request['email'], "Verification Code", "<div> Your Verificaiton Code Is:<b>$code</b> <div>");
      if($mailResult){
        header('location:web.php?verify-email='.$request['email'].'&forget=true');die;
      }else{
        header('location:../Views/errors/500.php');die;
      }
    }else{
      $_SESSION['message']['errors']= ['email-exists'=>"<div class='alert alert-danger'>Email Not Exists</div>"];
      $_SESSION['request'] = $request;
      header('location:../Views/forget-password.php');die;
    }
  }

  public function newPassword_get($request){
    header('location:../Views/new-password.php?email='.$request['email']);die;
  }

  public function changePassword_post($request){
    $valid = new validationRequest;
    $valid->setPassword($request['password']);
    $valid->setConfirmPassword($request['confirm-password']);
    $resultPass = $valid->passwordValidation(); 
    if(!empty($resultPass)){
      $_SESSION['message']['errors'] = $resultPass;
      $_SESSION['request'] = $request;  
      header('location:../Views/new-password.php?email='.$request['email']);die;
    }else{
      $user = new user;
      $user->setEmail($request['email']);
      $result = $user->emailCheckDB();
      if($result){
        $userDB = $result->fetch_object();
        if($userDB->password == sha1($request['password'])){
          $_SESSION['message']['errors'] = ['old-password'=>"<div class='alert alert-danger'> Can not Enter Old Password </div>"];
          header('location:../Views/new-password.php?email='.$request['email']);die;
        }else{
          $user->setPassword($request['password']);
          $updated = $user->updatePassword();          
          if($updated){
            header('location:web.php?login=true');
          }else{
            header('location:../Views/errors/500.php');
          }
        }
      }else{
        header('location:../Views/errors/404.php');
      }
    }
  }
}