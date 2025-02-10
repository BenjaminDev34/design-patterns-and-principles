<?php

class User {
    public function __construct(private $role = 'user'){}
    public function login() :void{
//        here imagine the login logic
//        ...
        if($this->role == "admin"){
            echo "Hello admin";
        }elseif($this->role == "moderator"){
            echo "Hello moderator";
        }
        else{
            echo "Hello user";
        }
    }
}

$user = new User();
$user->login();