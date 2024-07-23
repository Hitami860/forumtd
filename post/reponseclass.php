<?php


class Reponse 
{

    private $contenu;

    private $auteur;

    private $like;

    private $date;

    private $bdd;


    public function __construct()
    {
        $this->bdd = new bdd();
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setLike($like)
    {
        $this->like = $like;
    }

    public function getLike(): string
    {
        return $this->like;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }


}