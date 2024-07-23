CREATE TABLE `post`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `contenu` TEXT NOT NULL,
    `auteur` BIGINT UNSIGNED NOT NULL,
    `date_creation` BIGINT NOT NULL,
    `like` BIGINT NOT NULL,
    `id_sous_categorie` BIGINT UNSIGNED NOT NULL,
    `titre` VARCHAR(255) NOT NULL
);
CREATE TABLE `signalement`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `motif` TEXT NOT NULL,
    `auteur` BIGINT UNSIGNED NOT NULL,
    `id_post` BIGINT UNSIGNED NULL,
    `date_creation` BIGINT NOT NULL,
    `id_reponse` BIGINT UNSIGNED NULL
);
CREATE TABLE `sous_categorie`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_categorie` BIGINT UNSIGNED NOT NULL,
    `nom` BIGINT NOT NULL
);
CREATE TABLE `reponse_post`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `contenu` TEXT NOT NULL,
    `auteur` BIGINT UNSIGNED NOT NULL,
    `id_post` BIGINT UNSIGNED NOT NULL,
    `date_creation` BIGINT NOT NULL,
    `like` BIGINT NOT NULL
);
CREATE TABLE `utilisateur`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `pseudo` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `statut` VARCHAR(255) NOT NULL
);
CREATE TABLE `categorie`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` BIGINT NOT NULL
);
ALTER TABLE
    `signalement` ADD CONSTRAINT `signalement_auteur_foreign` FOREIGN KEY(`auteur`) REFERENCES `utilisateur`(`id`);
ALTER TABLE
    `post` ADD CONSTRAINT `post_id_sous_categorie_foreign` FOREIGN KEY(`id_sous_categorie`) REFERENCES `sous_categorie`(`id`);
ALTER TABLE
    `sous_categorie` ADD CONSTRAINT `sous_categorie_id_categorie_foreign` FOREIGN KEY(`id_categorie`) REFERENCES `categorie`(`id`);
ALTER TABLE
    `signalement` ADD CONSTRAINT `signalement_id_reponse_foreign` FOREIGN KEY(`id_reponse`) REFERENCES `reponse_post`(`id`);
ALTER TABLE
    `signalement` ADD CONSTRAINT `signalement_id_post_foreign` FOREIGN KEY(`id_post`) REFERENCES `post`(`id`);
ALTER TABLE
    `post` ADD CONSTRAINT `post_auteur_foreign` FOREIGN KEY(`auteur`) REFERENCES `utilisateur`(`id`);
ALTER TABLE
    `reponse_post` ADD CONSTRAINT `reponse_post_id_post_foreign` FOREIGN KEY(`id_post`) REFERENCES `post`(`id`);
ALTER TABLE
    `reponse_post` ADD CONSTRAINT `reponse_post_auteur_foreign` FOREIGN KEY(`auteur`) REFERENCES `utilisateur`(`id`);