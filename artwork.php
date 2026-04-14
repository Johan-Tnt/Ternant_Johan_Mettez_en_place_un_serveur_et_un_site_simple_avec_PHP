<?php
require_once "bdd.php"; //Inclut le fichier de connexion à la base de données

$pdo = connection(); //Connexion à la base de données avec PDO

// 1. Vérifier si l'id est présent dans l'URL et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// 2. Récupérer l'œuvre correspondante depuis la base de données (requête préparée)
$stmt = $pdo->prepare("SELECT * FROM artworks WHERE id = :id");
$stmt->execute(['id' => $id]);

$artworkFound = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Gestion d'erreur : si aucune œuvre n'est trouvée → redirection
if (!$artworkFound) {
    header("Location: index.php");
    exit;
}
?>

<?php include "header.php"; ?>

<article class="oeuvre-detail">
    <!-- Image, titre, artiste, description de l'œuvre + lien de retour -->
    <img src="<?php echo htmlspecialchars($artworkFound['image']); ?>" alt="<?php echo htmlspecialchars($artworkFound['title']); ?>">
    <h1><?php echo htmlspecialchars($artworkFound['title']); ?></h1>
    <p class="artiste"><?php echo htmlspecialchars($artworkFound['artist']); ?></p>
    <p class="description"><?php echo htmlspecialchars($artworkFound['description']); ?></p>
    <a href="index.php">← Retour à la galerie</a>
</article>

<?php include "footer.php"; ?>