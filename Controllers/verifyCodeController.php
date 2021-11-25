<?php
include_once "../Requests/urlEmailValidation.php";
include_once "../Models/User.php";
class verifyCodeController {

  public function verifyCode_post($request){

    $url = new urlEmailValidation;
    $result = $url->urlEmail($request);

    if($result){
      if($result->code == $request['code'] ){

        $user = new User;
        $user->setStatus(1);
        $user->setEmail($request['verify-email']);    
        $updated = $user->updateStatus();
        if($updated){
          $result->status=1;
          if(isset($request['forget'])){
            header('location:../Routes/web.php?new-password=true&email='.$request['verify-email']);
          }else{
          $_SESSION['user'] = $result;
            header('location:../Views/index.php');
          }
        }else{
          $_SESSION['message']['errors'] = ['wrong-code'=>"<div class='alert alert-danger'>ERRoR DB</div>"];
          $_SESSION['request'] = $request;
          header('location:../Views/verify-code.php?verify-email='.$request['verify-email']);
        }
      
      
      }else{
        $_SESSION['message']['errors']= ['wrong-code'=>"<div class='alert alert-danger'>wronge code</div>"];
        $_SESSION['request'] = $request;
        header('location:../Views/verify-code.php?verify-email='.$request['verify-email']);
      }
    }
  }


  public function verifyCode_get($request){
 
    $url = new urlEmailValidation;
    $result = $url->urlEmail($request);
    if($result){
      if(isset($request['forget'])){
        header('location:../Views/verify-code.php?verify-email='.$request['verify-email'].'&forget=true');
      }else{
        header('location:../Views/verify-code.php?verify-email='.$request['verify-email']);
      }
    }else{
      header('location:../Views/errors/404.php');
    }
  }

} 
