<?php

class Users
{
    private $pseudo;

    private $password;

    private $email;

    private $statut;

    private $bdd;


    public function __construct()
    {
        $this->bdd = new bdd();
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

}
