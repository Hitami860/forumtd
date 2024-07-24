<?php

include('utilisateur/users.php');
include('post/post.php');

class bdd
{
    private $bdd;
    public function connect()
    {
        try {
            $this->bdd = new PDO("mysql:host=localhost;dbname=forum", 'root', '');
            return $this->bdd;
        } catch (PDOException $e) {
            print $e;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM utilisateur";

        $done = $this->bdd->query($sql);

        return $done->fetchAll(PDO::FETCH_ASSOC);
    }
    public function authentification($param = [])
    {

        $users = $this->getAll();

        foreach ($users as $user) {
            if ($param["usern"] == $user["pseudo"] && password_verify($param["password"], $user["password"])) {
                return $user;
            }
        }
    }
    public function getUsers(string $pseudo): array
    {
        try {

            $sql = $this->bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
            $sql->bindParam(':pseudo', $pseudo);
            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {

            return [];
        }
    }

    public function inscription(Users $users)
    {
        try {

            $this->bdd->beginTransaction();

            $pseudo = $users->getPseudo();
            $password = $users->getPassword();
            $statut = $users->getStatut();
            $email = $users->getEmail();

            $sql = $this->bdd->prepare("INSERT INTO utilisateur (pseudo, password, statut, email) VALUES (:pseudo, :password, :statut, :email)");
            $sql->bindParam(':pseudo', $pseudo);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':statut', $statut);
            $sql->bindParam(':email', $email);
            $sql->execute();
            $this->bdd->commit();
        } catch (\Throwable $th) {

            $this->bdd->rollBack();
            echo $th->getMessage();
        }
    }

    public function getAllcategorie()
    {
        $sql = 'SELECT * FROM categorie';
        $done = $this->bdd->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllsous_categorie($id)
    {
        $sql = $this->bdd->prepare('SELECT * FROM sous_categorie WHERE id_categorie = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllsous_categoriee()
    {
        $sql = "SELECT * FROM sous_categorie";
        $sql = $this->bdd->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    
    public function getAllPosts()
    {
        $sql = "SELECT * FROM post";
        $sql = $this->bdd->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPost(posts $posts)
    {

        $titre = $posts->getTitre();
        $contenu = $posts->getContenu();
        $auteur = $posts->getAuteur();
        $id_sous_categorie = $posts->getIdsouscat();
        $date = $posts->getDate();


        $sql = 'INSERT INTO post (titre, contenu, auteur, id_sous_categorie, date_creation) VALUES(:titre, :contenu, :auteur, :id_sous_categorie, :date_creation)';
        $sql = $this->bdd->prepare($sql);
        $sql->bindParam(":titre", $titre);
        $sql->bindParam(":contenu", $contenu);
        $sql->bindParam(":auteur", $auteur);
        $sql->bindParam(":id_sous_categorie", $id_sous_categorie);
        $sql->bindParam(":date_creation", $date);

        $sql->execute();
    }

    public function updateUser($param = [])
    {
        $sql = $this->bdd->prepare("UPDATE utilisateur SET utilisateur (pseudo, password, statut, email) VALUES (:pseudo, :password, :statut, :email);");
        $sql->bindParam(":pseudo", $param["pseudo"]);
        $sql->bindParam(":password", $param["password"]);
        $sql->bindParam(":statut", $param["statut"]);
        $sql->bindParam(":email", $param["email"]);
        $sql->execute();
    }

    public function updatePost($param = []): void
    {
        $sql = $this->bdd->prepare("UPDATE post SET titre = :titre, contenu = :contenu, auteur = :auteur WHERE id = :id");
        $sql->bindParam(":titre", $param["titre"]);
        $sql->bindParam(":contenu", $param["contenu"]);
        $sql->bindParam(":auteur", $param["auteur"]);
        $sql->bindParam(":id", $param["id"]);
        $sql->execute();
    }


    public function addReponse(posts $posts)
    {

        $titre = $posts->getTitre();
        $contenu = $posts->getContenu();
        $auteur = $posts->getAuteur();
        $id_sous_categorie = $posts->getIdsouscat();
        $date = $posts->getDate();
    }

    public function deleteUser($id)
    {

        $sql = $this->bdd->prepare("DELETE FROM utilisateur WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
    }
}
