<?php
include_once "../Controllers/registerController.php";
include_once "../Controllers/verifyCodeController.php";
include_once "../Controllers/logoutController.php";
include_once "../Controllers/loginController.php";
include_once "../Controllers/profileController.php";
include_once "../Controllers/indexController.php";
include_once "../Controllers/forgetPasswordController.php";
$auth = new registerController;
$verify = new verifyCodeController;
$logout = new logoutController;
$login = new loginController;
$profile = new profileController;
$index = new indexController;
$forgetPassword = new forgetPasswordController;

if(isset($_POST['register_post'])){
  $auth->register_post($_POST);
  
}elseif(isset($_GET['register'])){
  $auth->register_get($_GET);

}elseif(isset($_GET['verify-email'])){
  $verify->verifyCode_get($_GET);

}elseif(isset($_POST['verify-email-post'])){
  $verify->verifyCode_post($_POST);

}elseif(isset($_GET['login'])){
  $login->login_get();

}elseif(isset($_POST['login'])){
  $login->login_post($_POST);

}elseif(isset($_GET['logout'])){
  $logout->logout();

}elseif(isset($_GET['profile'])){
  $profile->profile_get();

}elseif(isset($_GET['index'])){
  $index->index();

}elseif(isset($_GET['forget-password'])){  
  $forgetPassword->forgetPassword_get();

}elseif(isset($_POST['forget-password'])){  
  $forgetPassword->forgetPassword_post($_POST);

}elseif(isset($_GET['new-password'])){  
  $forgetPassword->newPassword_get($_GET);

}elseif(isset($_POST['change-password'])){  
  $forgetPassword->changePassword_post($_POST);
  
}else{

header('location:../Views/errors/404.php');
}
?>