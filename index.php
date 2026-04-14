<?php 
require_once "bdd.php"; //Inclut le fichier de connexion à la base de données

$pdo = connection(); //Connexion à la base de données avec PDO

//Récupère toutes les œuvres depuis la base de données
$stmt = $pdo->query("SELECT * FROM artworks");
$artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Inclus le header (logo + menu) -->
<?php include "header.php"; ?>

<div id="liste-oeuvres">
    <!-- Boucle sur toutes les œuvres récupérées depuis la base de données -->
    <?php foreach ($artworks as $artwork) { ?>
        <article class="oeuvre">
            <!-- Lien dynamique vers la page détail de l'œuvre avec son id -->
            <a href="artwork.php?id=<?php echo htmlspecialchars($artwork['id']); ?>">
                <!-- Image, titre et artiste de l'œuvre -->
                <img src="<?php echo htmlspecialchars($artwork['image']); ?>" alt="<?php echo htmlspecialchars($artwork['title']); ?>">
                <h2><?php echo htmlspecialchars($artwork['title']); ?></h2>
                <p class="description"><?php echo htmlspecialchars($artwork['artist']); ?></p>
            </a>
        </article>
    <?php } ?>
</div>

<!-- Inclus le footer -->
<?php include "footer.php"; ?>