<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('scripts/db.php');

// Récupérer les informations de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Si l'utilisateur n'existe pas ou s'il n'a pas de rôle valide, le rediriger vers la page de connexion
if (!$user) {
    header('Location: login.php');
    exit();
}

// Définir les pages du tableau de bord en fonction du rôle
if ($user['role'] == 'admin') {
    $pages = [
        'add_article.php' => 'Ajouter un article',
        'modify_article.php' => 'Modifier un article',
        'delete_article.php' => 'Supprimer un article',
        'delete_user.php' => 'Supprimer un utilisateur',
        'add_user.php' => 'Ajouter un utilisateur',
    ];
} else {
    $pages = [
        'add_article.php' => 'Ajouter un article',
        'modify_article.php' => 'Modifier un article',
        'delete_article.php' => 'Supprimer un article',
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .dashboard-links {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard-link {
            text-decoration: none;
            color: #fff;
            background-color: #00796b; /* Vert clair */
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            margin: 10px 0;
            transition: background-color 0.3s;
        }

        .dashboard-link:hover {
            background-color: #004d40; /* Vert foncé */
        }

        .logout-link {
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #e74c3c; /* Rouge */
            padding: 10px 20px;
            border-radius: 5px;
        }

        .logout-link:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenue, <?php echo htmlspecialchars($user['username']); ?> !</h2>
        <p>Tableau de bord de votre compte</p>

        <div class="dashboard-links">
            <?php foreach ($pages as $page => $label): ?>
                <a href="<?php echo $page; ?>" class="dashboard-link"><?php echo $label; ?></a>
            <?php endforeach; ?>
        </div>

        <a href="logout.php" class="logout-link">Se déconnecter</a>
    </div>
</body>
</html>
