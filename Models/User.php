<?php
include_once "../Database/database.php";
include_once "../Interfaces/operations.php";
class User extends database implements operations {
    private $id;
    private $name;
    private $phone;
    private $email;
    private $status;
    private $code;
    private $user_type;
    private $gender;
    private $password;
    private $image;
    private $created_at;
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;

        
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;

        
    }

    public function getUser_type()
    {
        return $this->user_type;
    }

    public function setUser_type($user_type)
    {
        $this->user_type = $user_type;

        
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;

        
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
 
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        
    }


    public function getUpdated_at()
    {
        return $this->updated_at;
    }


    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        
    }



    public function selectData(){
        $query = "SELECT * FROM users";
        return $this->runDQL($query);
    }
    public function insertData(){
        $query = "INSERT INTO `users` (`users`.`name`,`users`.`password`,`users`.`email`,`users`.`phone`,`users`.`gender`,`users`.`code`) 
        VALUES ('$this->name','$this->password','$this->email',$this->phone,'$this->gender',$this->code)";
        //die($query);
        return $this->runDML($query);
    }
    public function deleteData(){

    }
    public function updateData(){
        $query = "UPDATE `users` 
        SET `users`.`name` = '$this->name' ,
            `users`.`phone` = $this->phone ,
            `users`.`gender` = '$this->gender'";
            if($this->image){
                $query .=" ,`users`.`image` = '$this->image' ";
            }
        $query.=    "WHERE `users`.`id` = $this->id";
        return $this->runDML($query);
    }

    public function emailCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email'";
        return $this->runDQL($query);
    }
    public function phoneCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`phone` = '$this->phone'";
        return $this->runDQL($query);
    }
    public function updateStatus()
    {
       return $this->runDML("UPDATE `users` SET `users`.`status` = $this->status WHERE `users`.`email` = '$this->email' ");
    }

    public function login()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password'";
        return $this->runDQL($query);
    }

    public function updateCode()
    {
       return $this->runDML("UPDATE `users` SET `users`.`code` = $this->code WHERE `users`.`email` = '$this->email'");
    }

    public function updatePassword()
    {
        return $this->runDML("UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`email` = '$this->email'");
    }
    public function getUserById()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`id` = '$this->id'";
        return $this->runDQL($query);
    }
}
    