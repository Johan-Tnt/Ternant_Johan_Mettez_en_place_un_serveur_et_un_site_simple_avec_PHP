<?php
require_once "bdd.php";

//Vérification de la présence des données du formulaire ($_POST)
//Permet d’éviter l’accès direct au script sans soumission du formulaire
if (
    !isset($_POST['title']) ||
    !isset($_POST['artist']) ||
    !isset($_POST['image']) ||
    !isset($_POST['description'])
) {
    //Si une donnée manque → retour au formulaire
    header("Location: add_artwork.php");
    exit;
}

//Récupération et nettoyage des données utilisateur, trim() → suppression des espaces inutiles
$title = trim($_POST['title']);
$artist = trim($_POST['artist']);
$image = trim($_POST['image']);
$description = trim($_POST['description']);

//Validation des champs obligatoires, le titre et l’artiste sont requis pour créer une œuvre valide
if ($title === "" || $artist === "") {
    header("Location: add_artwork.php");
    exit;
}

//Validation de la description, impose une longueur minimale pour éviter des contenus vides
if (strlen($description) < 3) {
    header("Location: add_artwork.php");
    exit;
}

// Validation de l’URL de l’image, FILTER_VALIDATE_URL vérifie que la chaîne respecte un format d’URL valide (http, https, etc.)
if (!filter_var($image, FILTER_VALIDATE_URL)) {
    header("Location: add_artwork.php");
    exit;
}

$pdo = connection();

//Sécurise les données avant insertion en base
$stmt = $pdo->prepare("INSERT INTO artworks (title, artist, image, description)
VALUES (:title, :artist, :image, :description)");

//Exécution de l’insertion en base de données, htmlspecialchars() protège contre les failles XSS lors de l’affichage
$stmt->execute([
    "title" => htmlspecialchars($title),
    "artist" => htmlspecialchars($artist),
    "image" => htmlspecialchars($image),
    "description" => htmlspecialchars($description),
]);

//Redirection à la page d’accueil pour afficher la nouvelle œuvre ajoutée
header("Location: index.php");
exit;