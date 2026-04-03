<?php
include "artworks.php"; //Inclut le tableau des œuvres (le tableau $artworks de artworks.php)
?>
 
<!--Inclus le header (logo + menu)-->
<?php include "header.php"; ?>

    <div id="liste-oeuvres">
        <!--Boucle sur toutes les œuvres du tableau-->
        <?php foreach($artworks as $artwork) { ?>
            <article class="oeuvre">
                 <!--Lien dynamique vers la page détail de l'oeuvre avec l'id-->
                <a href="artwork.php?id=<?php echo $artwork['id']; ?>">
                    <!--Image, titre et artiste de l'œuvre-->
                    <img src="<?php echo $artwork['image']; ?>" alt="<?php echo $artwork['title']; ?>">
                    <h2><?php echo $artwork['title']; ?></h2>
                    <p class="description"><?php echo $artwork['artist']; ?></p>
                </a>
            </article>
        <?php } ?>
    </div>

<!--Inclus le footer-->
<?php include "footer.php"; ?>