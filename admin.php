<?php

require_once('config/config.php');
session_start();
$bdd = new bdd();
$bdd->connect();
$users = $bdd->getAll();
$categorie=$bdd->getAllcategorie();
$sous_categorie=$bdd->getAllsous_categoriee();


if (isset($_POST['edit'])){

}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin</title>
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
                            <?php if ($_SESSION['user']['statut'] == "admin") { ?>
                                <li>
                                    <a href="admin.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Admin</a>
                                </li>
                        <?php }
                        } ?>

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
    <main class="container mx-auto">
        <table class="border border-black w-full pt-6 h-[20%]">
            <thead>
                <th class="border border-black">Pseudo</th>
                <th class="border border-black">Statut</th>
                <th class="border border-black">Email</th>
                <th class="border border-black">Action</th>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr class="odd:bg-gray-100">
                        <td class="border border-black"><?php echo $user['pseudo']; ?></td>
                        <td class="border border-black"><?php echo $user['statut']; ?></td>
                        <td class="border border-black"><?php echo $user['email']; ?></td>

                        <td>
                            <form action="" method="post">
                                <input type="text" name="statut" placeholder="statut" value="<?php $user["statut"]; ?>">
                                <input type="text" name="email" placeholder="email" value="<?php $user["email"]; ?>">
                                <button class="" type="submit" name="edit" value="<?php echo $user["id"]; ?>">Editer</button>
                                <form action="" method="post">
                                    <button class="text-red-600 uppercase" type="submit" name="supprime" value="<?php echo $user['id']; ?>">Supprimer</button>
                                </form>
                            </form>
                        </td>
                    </tr>

                    <?php if (isset($_POST['supprime'])) {
                        foreach ($users as $user) {
                            if ($_POST['supprime'] == $user['id']) {
                                $bdd->deleteUser($user['id']);
                            }
                        }
                    } ?>

                <?php } ?>

            </tbody>
        </table> <br>
        <table>
        <thead>
            <th class="border border-black">Categorie</th>
            <th class="border border-black">Sous-categorie</th>
            <th class="border border-black">Action</th>
        </thead>
        <tbody>
        <?php foreach ($categorie as $catego) { ?>

        <tr class="odd:bg-gray-100">
                        <td class="border border-black"><?php echo $catego['nom']; ?></td>

        </tr>
        
        <?php } ?>

        <?php foreach ($sous_categorie as $souscat) { ?>
          <?php  if ($souscat['id_categorie'] == $catego['id']) { ?>
        <tr class="odd:bg-gray-100">
            <td class="border border-black"><?php print $souscat['nom']; ?></td>
        </tr>
        <?php } ?>
        <?php } ?>


        </tbody>

        </table>

</body>

</main>

</html>