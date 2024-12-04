<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusion du fichier de connexion à la base de données
include('scripts/db.php');

// Vérifier si des utilisateurs ont été sélectionnés pour la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_users'])) {
    // Vérifier que des utilisateurs ont été sélectionnés
    if (!empty($_POST['users'])) {
        // Préparer la liste des IDs à supprimer
        $ids_to_delete = implode(",", $_POST['users']);

        // Exécuter la requête pour supprimer les utilisateurs sélectionnés
        $sql = "DELETE FROM users WHERE id IN ($ids_to_delete)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "Les utilisateurs sélectionnés ont été supprimés avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression des utilisateurs : " . $e->getMessage();
        }
    } else {
        echo "Aucun utilisateur n'a été sélectionné.";
    }
}

// Récupérer la liste des utilisateurs
$sql = "SELECT id, nom, prenom FROM users";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h2>Liste des utilisateurs</h2>

    <!-- Formulaire de sélection et de suppression -->
    <form action="delete_user.php" method="POST">
        <table border="1">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select_all" onclick="toggleSelectAll()"></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier s'il y a des utilisateurs dans la base de données
                if (!empty($users)) {
                    // Afficher tous les utilisateurs dans la table
                    foreach ($users as $user) {
                        echo "<tr>
                                <td><input type='checkbox' name='users[]' value='" . $user['id'] . "'></td>
                                <td>" . $user['nom'] . "</td>
                                <td>" . $user['prenom'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun utilisateur trouvé.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <input type="submit" name="delete_users" value="Supprimer les utilisateurs sélectionnés">
    </form>

    <br>
    <a href="dashboard.php">Retour au dashboard</a>

    <script>
        // Fonction pour sélectionner/désélectionner tous les utilisateurs
        function toggleSelectAll() {
            var checkboxes = document.querySelectorAll('input[name="users[]"]');
            var selectAllCheckbox = document.getElementById('select_all');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
</body>
</html>
