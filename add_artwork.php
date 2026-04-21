<?php require "header.php"; ?>


<?php
$error = $_GET['error'] ?? null;

//Gestion des erreurs
$titleError = ($error === "empty_fields");
$artistError = ($error === "empty_fields");
$descriptionError = ($error === "description_short");
$imageError = ($error === "invalid_url");
?>

<!--Messages d'erreur-->
<?php if ($error === "missing_data"): ?>
    <p class="error">Des données du formulaire sont manquantes.</p>

<?php elseif ($error === "empty_fields"): ?>
    <p class="error">Le titre et l'auteur sont obligatoires.</p>

<?php elseif ($error === "description_short"): ?>
    <p class="error">La description doit contenir au moins 3 caractères.</p>

<?php elseif ($error === "invalid_url"): ?>
    <p class="error">L'URL de l'image n'est pas valide.</p>
<?php endif; ?>

<!--Formulaire-->
<form action="process.php" method="POST">
    <div class="champ-formulaire">
        <label for="title">Titre de l'œuvre</label>
        <input type="text" name="title" id="title" class="<?php echo $titleError ? 'input-error' : ''; ?>">
    </div>
    <div class="champ-formulaire">
        <label for="artist">Auteur de l'œuvre</label>
        <input type="text" name="artist" id="artist"  class="<?php echo $artistError ? 'input-error' : ''; ?>">
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" class="<?php echo $imageError ? 'input-error' : ''; ?>">
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="<?php echo $descriptionError ? 'input-error' : ''; ?>"></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require "footer.php"; ?>