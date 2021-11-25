<?php 
include_once "../Requests/validationRequest.php";
include_once "Controller.php";
include_once "../Models/User.php";
include_once "../Traits/sendMail.php";
include_once "../Traits/userData.php";
class registerController extends Controller{
  use sendMail;
  use userData;
  public function register_post($request){
    $auth = new validationRequest;

    $auth->setEmail($request['email']);
    $emailValidationResult = $auth->emailValidation();
    if(!empty($emailValidationResult)){
      $_SESSION['message']['errors'] = $emailValidationResult;
      $_SESSION['request'] = $request;
      header('location:../Views/register.php');
    }
        
    $auth->setPassword($request['password']);
    $auth->setConfirmPassword($request['confirm-password']);    
    $passwordValidationResult = $auth->passwordValidation();
    if(!empty($passwordValidationResult)){        
      $_SESSION['message']['errors']= $passwordValidationResult;
      $_SESSION['request'] = $request;
      header('location:../Views/register.php');
    }

    $user = new User;
    $code=rand(10000,99999);
    $this->userData($user,$request['name'],$request['password'],$request['email'],$request['phone'],$request['gender'],$code);

    $emailCheckDB=$user->emailCheckDB();
    if(!empty($emailCheckDB)){     
        $_SESSION['message']['errors']= ['email-exists'=>"<div class='alert alert-danger'>Email Already Exists</div>"];
        $_SESSION['request'] = $request;
    }

    $phoneCheckDB=$user->phoneCheckDB();
    if(!empty($phoneCheckDB)){     
        $_SESSION['message']['errors']= ['phone-exists'=>"<div class='alert alert-danger'>Phone Already Exists</div>"];
        $_SESSION['request'] = $request;
    }

    if(empty($emailCheckDB)&&empty($phoneCheckDB)){
      $user->insertData();
      $mailResult = $this->sendMails($request['email'], "Verification Code", "<div> Your Verificaiton Code Is:<b>$code</b> <div>");
      if($mailResult){
        header('location:web.php?verify-email='.$request['email']);die;
      }else{
        header('location:../Views/errors/500.php');die;
      }
    }else{
      header('location:../Views/register.php');
    }
  }

  public function register_get(){
    header('location:../Views/register.php');
  }
}
