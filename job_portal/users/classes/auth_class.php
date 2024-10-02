<?php 

class Auth
{
    private $email;
    private $password;


    public function __construct($email, $password)
    {
        $this->email        =   $email; 
        $this->password     =   $password; 
    }

    
    public function authenticate()
    {
        $user   =   R::findOne("users", "WHERE email = ?", [$this->email]);

        if($user)
        {
            if(password_verify($this->password, $user->password))
            {
                $this->setSession(); // Set the session.
                return array(
                    "message"   =>  "Login Successful",
                    "success"   =>  true
                );
            }
            else
            {
                return array(
                    "message"   =>  "Incorrect email or password",
                    "success"   =>  false
                );
            }
        }
        else
        {
            return array(
                "message"   =>  "No such user exists. Try creating new account", 
                "success"   =>  false
            );
        }
    }


    public function setSession()
    {
        $_SESSION["email"]      =   $this->email;
    }


    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../sign_in.html");
    }
}


?>