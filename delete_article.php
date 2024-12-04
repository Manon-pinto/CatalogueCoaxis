<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusion du fichier de connexion à la base de données
include('scripts/db.php');

// Vérifier si des articles ont été sélectionnés pour la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_articles'])) {
    // Vérifier que des articles ont été sélectionnés
    if (!empty($_POST['articles'])) {
        // Préparer la liste des IDs à supprimer
        $ids_to_delete = implode(",", $_POST['articles']);

        // Exécuter la requête pour supprimer les articles sélectionnés
        $sql = "DELETE FROM articles WHERE id IN ($ids_to_delete)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "Les articles sélectionnés ont été supprimés avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression des articles : " . $e->getMessage();
        }
    } else {
        echo "Aucun article n'a été sélectionné.";
    }
}

// Récupérer la liste des articles
$sql = "SELECT id, name, category FROM articles";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des articles : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des articles</title>
</head>
<body>
    <h2>Liste des articles</h2>

    <!-- Formulaire de sélection et de suppression -->
    <form action="delete_article.php" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select_all" onclick="toggleSelectAll()"></th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier s'il y a des articles dans la base de données
                if (!empty($articles)) {
                    // Afficher tous les articles dans la table
                    foreach ($articles as $article) {
                        echo "<tr>
                                <td><input type='checkbox' name='articles[]' value='" . $article['id'] . "'></td>
                                <td>" . $article['name'] . "</td>
                                <td>" . $article['category'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun article trouvé.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <input type="submit" name="delete_articles" value="Supprimer les articles sélectionnés">
    </form>

    <br>
    <a href="dashboard.php">Retour au dashboard</a>

    <script>
        // Fonction pour sélectionner/désélectionner tous les articles
        function toggleSelectAll() {
            var checkboxes = document.querySelectorAll('input[name="articles[]"]');
            var selectAllCheckbox = document.getElementById('select_all');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
</body>
</html>
