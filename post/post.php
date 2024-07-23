<?php

class posts
{
    private $contenu;

    private $auteur;

    private $like;

    private $titre;

    private $date;

    private $s_cat;

    private $bdd;


    public function __construct()
    {
        $this->bdd = new bdd();
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getTitre(): string
    {
        return $this->titre;
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
    public function setIdsouscat($s_cat)
    {
        $this->s_cat = $s_cat;
    }
    public function getIdsouscat()
    {
        return $this->s_cat;
    }

    public function getDate()
    {
        return $this->date;
    }

}
