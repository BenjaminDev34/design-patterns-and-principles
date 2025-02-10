<?php

Interface RoleInterface {
    public function greet();
}

class UserRole implements RoleInterface{
    public function greet() :void{
        echo "Hello user";
    }
}

class AdminRole implements RoleInterface{
    public function greet() :void{
        echo "Hello admin";
    }
}

class ModeratorRole implements RoleInterface{
    public function greet() :void{
        echo "Hello moderator";
    }
}

readonly class GoodUser {
    public function __construct(private RoleInterface $role){}
    public function login(){
//        here imagine the login logic
//        ...
        return $this->role->greet();
    }
}

$goodUser = new GoodUser(new UserRole());
$goodUser->login();