<?php

interface UserInterface{
    public function getRole() :string;
    public function manageUsers() :string;
}

class AdminUser implements UserInterface{
    public function getRole() :string{
        return "admin";
    }
    public function manageUsers() :string{
        return "Manage users";
    }
}

class clientUser implements UserInterface{
    public function getRole() :string{
        return "client";
    }

    /**
     * @throws Exception
     */
    public function manageUsers() :never{
        throw new Exception("You can't manage users");
    }
}

$client = new ClientUser;
echo $client->getRole();