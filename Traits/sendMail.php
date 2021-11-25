<?php
include_once "../Mails/verificationMail.php";
trait sendMail {
  public function sendMails($request,$subject,$body){
    $mail = new verificationMail;
    $sent=$mail->sendMail($request,$subject,$body);
    if($sent)
    return true;
    else
    return false;
  }
}