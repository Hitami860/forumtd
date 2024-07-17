<?php
require_once('config/config.php');
require_once('utilisateur/users.php');

$bdd=new bdd();
$bdd->connect();

if (isset($_POST['inscription'])) {
    $mdp = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $bdd->addUser($_POST["username"], $mdp);

    if (isset($_POST['inscription'])) {
        $pseudo = $_POST['username'];
        $password = $_POST['password'];
        $user = $bdd->getUsers($pseudo);
        if (!empty($pseudo) && !empty($password) && !$user) {
            $users = new Users();
            $users->setPseudo($pseudo);
            $users->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $users->setStatut("user");
            $bdd->inscription($users);
            header("Location: inscription.php");
        }else{
            echo "Ce pseudo existe déjà ou les identifiants sont vides";
        }
}
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
</head>

<body>

    <header>

        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="image/icons8-collaboration-50.png" class="h-8" alt="Logo site" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Forum.com</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="index.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Accueil</a>
                        </li>
                        <li>
                            <a href="connexion.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Connexion</a>
                        </li>
                        <li>
                            <a href="contact.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <h2 class="flex justify-center text-xl">Crées ton compte !</h2>
    <form action="" method="post" class="flex flex-col justify-center w-full items-center gap-5">
        <input type="text" name="username" placeholder="Identifiant ou mail" class="h-8 w-[50%] border border-slate-400 border-solid rounded">
        <input name="password" placeholder="Mot de passe" class="h-8 w-[50%] border border-slate-400 border-solid rounded">
        <input type="submit" name="inscription" value="inscription" class="border border-black bg-[#1486e1] text-xl w-48 h-12 rounded-xl">
    </form>

</body>

</html>