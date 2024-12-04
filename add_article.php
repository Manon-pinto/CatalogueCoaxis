<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('scripts/db.php');

// Déclaration d'une variable pour le message
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs du formulaire
    $name = $_POST['name'];
    $category = $_POST['category']; // Récupérer la catégorie sélectionnée
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $pdf = isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK ? $_FILES['pdf']['name'] : null;

    // Vérifier si l'image a bien été téléchargée
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Déplacer l'image dans le dossier approprié
        $imagePath = "images/uploads/" . $image;
        
        // Gérer l'upload de l'image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Gérer l'upload du fichier PDF, s'il existe
            if ($pdf) {
                $pdfPath = "images/uploads/" . $pdf;
                move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);
            }

            try {
                // Préparer et exécuter la requête SQL
                $stmt = $pdo->prepare("INSERT INTO articles (name, category, price, image, description_pdf) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $category, $price, $image, $pdf]);

                $message = '<div class="success-message">Article ajouté avec succès.</div>';
            } catch (PDOException $e) {
                $message = '<div class="error-message">Erreur lors de l\'ajout de l\'article : ' . $e->getMessage() . '</div>';
            }
        } else {
            $message = '<div class="error-message">Erreur lors du téléchargement de l\'image.</div>';
        }
    } else {
        $message = '<div class="error-message">Erreur lors du téléchargement de l\'image. Code d\'erreur : ' . $_FILES['image']['error'] . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
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
        input[type="number"],
        input[type="file"],
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
        input[type="number"]:focus,
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

        <h2>Ajouter un Article</h2>
        <!-- Formulaire de création d'article -->
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nom de l'article" required>
            
            <!-- Menu déroulant pour la catégorie -->
            <select name="category" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="Electronics">PC Portables</option>
                <option value="Clothing">PC Fixes</option>
                <option value="Furniture">Ecrans</option>
                <option value="Books">Tablettes</option>
                <option value="Accessories">Accessoires</option>
                <!-- Vous pouvez ajouter d'autres catégories ici -->
            </select>

            <input type="number" name="price" placeholder="Prix" required>
            <input type="file" name="image" required>
            <input type="file" name="pdf">

            <button type="submit">Ajouter un article</button>
        </form>

        <!-- Bouton de retour au tableau de bord -->
        <a href="dashboard.php" class="back-button">Retour au Dashboard</a>
    </div>
</body>
</html>
