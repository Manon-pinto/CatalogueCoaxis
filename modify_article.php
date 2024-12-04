<?php
// Inclusion du fichier de connexion à la base de données
include('scripts/db.php');

// Vérifier si un ID d'article est passé dans l'URL
if (isset($_GET['id'])) {
    $id_article = $_GET['id'];

    // Récupérer les informations de l'article depuis la base de données
    $sql = "SELECT * FROM articles WHERE id = $id_article";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Si l'article existe, récupérer les informations
        $article = mysqli_fetch_assoc($result);
    } else {
        // Si l'article n'existe pas, rediriger vers la page d'accueil ou une page d'erreur
        die("Article non trouvé.");
    }
} else {
    // Si l'ID de l'article n'est pas passé, rediriger l'utilisateur
    die("Aucun article spécifié.");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles informations du formulaire
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $prix = mysqli_real_escape_string($conn, $_POST['prix']);
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);

    // Gérer l'upload de l'image
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Mettre à jour les informations de l'article dans la base de données
    $sql_update = "UPDATE articles 
                   SET nom = '$nom', description = '$description', prix = '$prix', categorie = '$categorie', image = '$image' 
                   WHERE id = $id_article";

    if (mysqli_query($conn, $sql_update)) {
        echo "Article mis à jour avec succès!";
        // Rediriger après la mise à jour (par exemple vers la page des articles)
        header("Location: liste_articles.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
</head>
<body>
    <h2>Modifier l'article : <?php echo $article['nom']; ?></h2>
    
    <form action="modify_article.php?id=<?php echo $id_article; ?>" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom de l'article :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $article['nom']; ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo $article['description']; ?></textarea><br><br>

        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" value="<?php echo $article['prix']; ?>" required><br><br>

        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
            <option value="pc-portable" <?php if ($article['categorie'] == 'pc-portable') echo 'selected'; ?>>PC Portable</option>
            <option value="pc-fixe" <?php if ($article['categorie'] == 'pc-fixe') echo 'selected'; ?>>PC Fixe</option>
            <option value="ecran" <?php if ($article['categorie'] == 'ecran') echo 'selected'; ?>>Écran</option>
            <option value="tablette" <?php if ($article['categorie'] == 'tablette') echo 'selected'; ?>>Tablette</option>
            <option value="accessoire" <?php if ($article['categorie'] == 'accessoire') echo 'selected'; ?>>Accessoire</option>
        </select><br><br>

        <label for="image">Changer l'image :</label>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" value="Mettre à jour l'article">
    </form>

    <br>
    <a href="liste_articles.php">Retour à la liste des articles</a>
</body>
</html>
