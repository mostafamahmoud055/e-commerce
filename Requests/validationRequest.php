 <?php
  class validationRequest{
     private $email;
     private $password;
     private $confirmPassword;
     private $errors=[]; 
     public function getEmail(){
      return $this->email;
     }
     public function setEmail($email){
       $this->email=$email;
     }
     public function getPassword(){
      return $this->password;
     }
     public function setPassword($password){
      $this->password = $password;
     }
     public function getConfirmPassword(){
      return $this->confirmPassword;
     }
     public function setConfirmPassword($confirmPassword){
      $this->confirmPassword = $confirmPassword;
     }

     public function emailValidation(){
       
      if(!$this->email){
        $this->errors['email']['email-required'] = "<div class='alert alert-danger'> Email Is Required </div>";
      }else{
        // validate on format of email
        $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        if(!preg_match($pattern,$this->email)){
            $this->errors['email']['email-format'] = "<div class='alert alert-danger'> Wrong Email Format </div>";
        }
      }
    return $this->errors;
    }


    public function passwordValidation(){
      if(!$this->password){
        $this->errors['password']['password-required'] = "<div class='alert alert-danger'> password Is Required </div>";
      }
      if(!$this->confirmPassword){
        $this->errors['password']['confirm-password'] = "<div class='alert alert-danger'>confirm password Is Required </div>";
      }

      if(empty($this->errors)){
        if($this->password!=$this->confirmPassword){
          $this->errors['password']['not-confirmed'] = "<div class='alert alert-danger'>password Is not confirmed </div>";
        }
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
              if(!preg_match($pattern,$this->password)){
                  $this->errors['password']['password-format'] = "<div class='alert alert-danger'> Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>";
              }
      }
      return $this->errors;
    }


    public function passwordLogin(){
      if(!$this->password){
        $this->errors['password']['password-required'] = "<div class='alert alert-danger'> Password Is Required </div>";
      }
      if(empty($this->errors)){
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
              if(!preg_match($pattern,$this->password)){
                  $this->errors['password']['password-format'] = "<div class='alert alert-danger'> Wrong Email OR Password </div>";
              }
      }
      return $this->errors;
    }
    
  }
 ?>