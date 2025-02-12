<?php
interface ClientInterface {
    public function getRole(): string;
}

interface AdminInterface extends UserInterface {
    public function manageUsers(): string;
}

class Admin implements AdminInterface, ClientInterface{
    public function getRole(): string {
        return "admin";
    }

    public function manageUsers(): string {
        return "Gestion des utilisateurs...";
    }
}

class Client implements ClientInterface {
    public function getRole(): string {
        return "client";
    }
}