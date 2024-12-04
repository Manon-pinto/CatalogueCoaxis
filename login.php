<?php
session_start();
include('scripts/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
</head>
<body>
    <h2>Connexion à l'administration</h2>


    <!-- Formulaire de connexion -->
    <form method="POST">
        <div>
            <label for="email">Nom d'utilisateur</label>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
