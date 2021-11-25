<?php
include_once "../Requests/validationRequest.php";
include_once "../Traits/sendMail.php";
include_once "../Models/User.php";
class loginController {
  use sendMail;
  public function login_get(){
    header('location:../Views/login.php');
  }

  public function login_post($request){
    $valid = new validationRequest;
    $valid->setEmail($request['email']);
    $result = $valid->emailValidation();
    if(!empty($result)){
      $_SESSION['message']['errors'] = $result;
      $_SESSION['request'] = $request;
    }

    $valid->setPassword($request['password']);
    $resultPass = $valid->passwordLogin();
    if(!empty($resultPass)){
      $_SESSION['message']['errors'] = $resultPass;
      $_SESSION['request'] = $request;  
    }
    if(!empty($result)||!empty($resultPass)){
      header('location:../Views/login.php');die;
    }
    $user = new User;
    $user->setEmail($request['email']);
    $user->setpassword($request['password']);
    $result = $user->login();
    
    if($result){      
      $userDB = $result->fetch_object();
      if($userDB->status == 0){
        $code=rand(10000,99999);
        $user->setCode($code);
        $user->updateCode();
        $mailResult = $this->sendMails($request['email'], "Verification Code", "<div> Your Verificaiton Code Is:<b>$code</b> <div>");
        if($mailResult){
          header('location:web.php?verify-email='.$request['email']);die;
        }else{
          header('location:../Views/errors/500.php');die;
        }
      }else{
        $_SESSION['user'] = $userDB;
        header('location:web.php?index=true');die;
      }
    }else{
      $_SESSION['message']['errors'] = ['wrong-user'=>"<div class='alert alert-danger'> Invalid Login Try Again </div>"];
      $_SESSION['request'] = $request;  
      header('location:../Views/login.php');
    }

  }
}