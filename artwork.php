<?php
include "artworks.php"; //Inclut le tableau des œuvres

//1. Récupérer l'id dans l'URL
//$_GET['id'] récupère la valeur après ?id=...
//intval() transforme en nombre pour sécuriser
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

//2. Cherche l'œuvre correspondante
$artworkFound = null;
//Parcourt toutes les oeuvres
foreach($artworks as $artwork) {
     //Si l'id correspond
    if ($artwork['id'] === $id) {
        $artworkFound = $artwork;
        break; //La boucle s'arrête dès qu'on trouve l'oeuvre
    }
}

//3. Gestion d'erreur
//Si aucune œuvre n'est trouvée → message + arrêt du script
if (!$artworkFound) {
    echo "Œuvre non trouvée !";
    exit;
}
?>

<?php include "header.php"; ?>


    <article class="oeuvre-detail">
        <!--Image, titre, artiste, description de l'oeuvre + lien de retour <a href = "" ...>-->
        <img src="<?php echo $artworkFound['image']; ?>" alt="<?php echo $artworkFound['title']; ?>">
        <h1><?php echo $artworkFound['title']; ?></h1>
        <p class="artiste"><?php echo $artworkFound['artist']; ?></p>
        <p class="description"><?php echo $artworkFound['description']; ?></p>
        <a href="index.php">← Retour à la galerie</a>
    </article>


<?php include "footer.php"; ?>

