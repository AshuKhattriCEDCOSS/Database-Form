<?php
error_reporting(0);
    class User extends DB
    {
       
        public string $fname;
        public string $lname;
        public string $emailfield;
        public string $pass;

        public function __construct($fname, $lname, $emailfield, $pass)
        {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->emailfield = $emailfield;
            $this->pass = $pass;
        }
           /**
            * Add User Function
            *This Function is for SignUp Functinality
            * @return void
            */
        public function addUser(){
            $sql="INSERT INTO User(First_Name,Last_Name,Email_id,User_Password,User_Status,User_Role,User_Address) Values('$this->fname','$this->lname','$this->emailfield','$this->pass','Pending','customer','Chowk')";
            
            try{
               
                DB::getInstance()->exec($sql);
                return "Data Inserted<br>Waiting for Response";
            }
            catch(Exception $e){
               
                return "<h5>Email is Already Registered<br> Please Sign In!!<h5>";
            }
        }
    }