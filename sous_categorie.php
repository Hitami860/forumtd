<?php

require_once('config/config.php');
session_start();
$bdd = new bdd();
$bdd->connect();
$id = $_GET["id"];
$posts = $bdd->getAllposts();
$date = date('d/m/Y h:i:s');


if (isset($_POST["publier"])) {

    $titre = ($_POST["titre"]);
    $contenu = ($_POST["contenu"]);
    $time = $date;
    $newpost = new posts();
    $auteur = $_SESSION['user']['id'];
    $newpost->setTitre($titre);
    $newpost->setContenu($contenu);
    $newpost->setAuteur($auteur);
    $newpost->setIdsouscat($id);
    $newpost->setDate($time);
    $bdd->addPost($newpost);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
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
                        <?php if (isset($_SESSION['user'])) { ?>
                            <li>
                                <a href="deconnexion.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Deconnexion</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="connexion.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Connexion</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="contact.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <a href="profil.php"><img src="https://img.icons8.com/?size=100&id=kDoeg22e5jUY&format=png&color=000000" alt="Photo profil" class="w-10 h-fit rounded-full"></a>
                        <?php } ?>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <p class="text-xl text-bold">
                                <?php print $_SESSION['user']['pseudo'] ?>
                            </p>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mx-auto">

        <?php foreach ($bdd->getAllposts() as  $post) { ?>
            <a href="reponse.php" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-12 md:w-12 md:rounded-none md:rounded-s-lg" src="https://img.icons8.com/?size=100&id=kDoeg22e5jUY&format=png&color=000000" alt="photo profil">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $post['titre']; ?></h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $post['contenu'];  ?><br><?php echo $post['date_creation'] ?></p>
                    <?php echo $post['auteur']; ?>
                </div>
            </a> <br>
            <?php if (isset($_SESSION['user'])) { ?>
                <?php if ($_SESSION['user']['id'] == "id") { ?>
                    <td><a><?php echo $post['id']; ?>Editer</a></td>
            <?php }
            } ?>
        <?php } ?>


    </div>
    <main class=" container mx-auto">
        <form action="" name="" class="flex justify-center items-center flex-col flex-end" method="post"> <br>
            <input type="text" name="titre" placeholder="Titre du post" class=" h-8 w-[50%] border border-slate-400 border-solid rounded"> <br>
            <textarea name="contenu" id="" placeholder="Contenu du post" class="h-64 w-[50%] border border-slate-400 border-solid rounded bg-gray-100"></textarea> <br>
            <button type="submit" name="publier" class="py-3 px-5 text-sm font-medium border bg-[#74a1f0] text-center text-black rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Publier</button>
        </form>
    </main>

</body>

</html>