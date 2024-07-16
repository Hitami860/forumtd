<?php

include('./utilisateur/users.php');

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

    public function addUser($pseudo, $password,)
    {

        $requete = 'INSERT INTO utilisateur (pseudo, password) VALUES(:username, :password)';
        $requetexe = $this->bdd->prepare($requete);
        $requetexe->execute(['username' => $pseudo, 'password' => $password]);
    }

    public function authentification($param = [])
    {

        $users = $this->getAll();

        foreach ($users as $user) {
            if ($param["usern"] == $user["username"] && password_verify($param["password"], $user["password"])) {
                return $user;
            }
        }
    }
    public function getUsers(string $pseudo): array
    {
        try {

            $sql = $this->bdd->connect()->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
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

            $sql = $this->bdd->prepare("INSERT INTO users (pseudo, password, statut, email) VALUES (:pseudo, :password, :statut, :email);");
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

    public function connection($param = [])
    {
    }
}
