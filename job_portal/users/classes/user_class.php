<?php 

class User
{
    private $name;
    private $email;
    private $role;
    private $emp_company;
    private $password;
    private $signup_date;


    public function __construct($name, $email, $role, $emp_company, $password)
    {
        $this->name         =   $name;
        $this->email        =   $email;
        $this->role         =   $role;
        $this->emp_company  =   $emp_company;
        $this->password     =   $password; 
        $this->signup_date  =   date("Y-m-d");
    }


    private function passwordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function createAccount()
    {
        if(duplicateEmail($this->email))
        {
            return array(
                "message"   =>  "User already exists",
                "success"   =>  false
            );
            exit;
        }
        else 
        {
            $user               =   R::dispense("users");
            $user->name         =   $this->name;
            $user->email        =   $this->email;
            $user->role         =   $this->role;
            $user->emp_company  =   $this->emp_company;
            $user->password     =   $this->passwordHash($this->password);
            $user->signup_date  =   $this->signup_date;

            if(R::store($user))
            {
                return array(
                    "message"   =>  "Account Created Successfully",
                    "success"   =>  true
                );
            }
            else 
            {
                return array(
                    "message"   =>  "Failed to create account",
                    "success"   =>  false
                );
            }

        }
    }
}

?>