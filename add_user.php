<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include('scripts/db.php');

// Déclaration d'une variable pour le message
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $email = $_POST['email'];  // Récupérer l'email du formulaire

    // Préparer la requête SQL pour insérer un utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role, email) VALUES (?, ?, ?, ?)");

    // Exécuter la requête avec les données soumises
    try {
        $stmt->execute([$username, $password, $role, $email]);
        $message = '<div class="success-message">Utilisateur ajouté avec succès.</div>';
    } catch (PDOException $e) {
        $message = '<div class="error-message">Erreur: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Bleu clair */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0px 15px 45px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 28px;
            color: #00796b; /* Vert clair */
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 2px solid #00796b;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #004d40; /* Vert foncé */
        }

        button {
            background-color: #00796b;
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004d40;
        }

        h3 {
            font-size: 18px;
            color: #00796b;
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-size: 16px;
            color: #00796b;
            margin: 8px 0;
        }

        .success-message {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .error-message {
            color: #d32f2f;
            margin: 10px 0;
        }

        a {
            color: #00796b;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            margin-top: 20px;
            padding: 12px;
            background-color: #00796b;
            color: white;
            font-size: 16px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            width: 100%;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #004d40;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <?php if ($message != '') echo $message; ?> <!-- Affichage du message -->

        <h2>Ajouter un Utilisateur</h2>
        <!-- Formulaire de création d'utilisateur -->
        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="email" name="email" placeholder="Email" required>  <!-- Champ email ajouté -->
            <select name="role">
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>

            <button type="submit">Ajouter un utilisateur</button>
        </form>

        <!-- Bouton de retour au tableau de bord -->
        <a href="dashboard.php" class="back-button">Retour au Dashboard</a>
    </div>
</body>
</html>