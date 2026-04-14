<?php
require_once "bdd.php";

if (
    !isset($_POST['title']) ||
    !isset($_POST['artist']) ||
    !isset($_POST['image']) ||
    !isset($_POST['description'])
) {
    header("Location: add_artwork.php");
    exit;
}

$title = trim($_POST['title']);
$artist = trim($_POST['artist']);
$image = trim($_POST['image']);
$description = trim($_POST['description']);

if ($title === "" || $artist === "") {
    header("Location: add_artwork.php");
    exit;
}

if (strlen($description) < 3) {
    header("Location: add_artwork.php");
    exit;
}

if (!filter_var($image, FILTER_VALIDATE_URL)) {
    header("Location: add_artwork.php");
    exit;
}

$pdo = connection();

$stmt = $pdo->prepare("INSERT INTO artworks (title, artist, image, description)
VALUES (:title, :artist, :image, :description)");

$stmt->execute([
    "title" => htmlspecialchars($title),
    "artist" => htmlspecialchars($artist),
    "image" => htmlspecialchars($image),
    "description" => htmlspecialchars($description)
]);

header("Location: index.php");
exit;