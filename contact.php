<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    
    @font-face {
    font-family: 'NeoSansProLight';
    src: url('typo/NeoSansProLight.OTF') format('opentype');
    font-weight: 300; /* ou 'normal' si c'est la seule version légère */
}

@font-face {
    font-family: 'NeoSansProRegular';
    src: url('typo/NeoSansProRegular.OTF') format('opentype');
    font-weight: 400; /* 'normal' */
}

@font-face {
    font-family: 'NeoSansProBold';
    src: url('typo/NeoSansProBold.OTF') format('opentype');
    font-weight: 700; /* ou 'bold' */
}

body {
   font-family: 'NeoSansProLight', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
        
.header h1 {
    font-family: 'NeoSansProBold', sans-serif;
    font-size: 2.5rem; /* Taille ajustée */
}
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #25588d;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.541);
        }
.container-fluid {
    margin-top: 200px; /* Ajoutez une marge équivalente à la hauteur du header */
}

        .logo-container {
            height: 100px;
            text-align: left;
        }

        .logo {
            max-width: 150%;
            height: 150px;
            margin-left: 30px;
            object-fit: contain;
        }

        .title {
            flex-grow: 1;
            font-size: 2.5rem; /* Taille ajustée */
            font-family: 'Neo Sans Pro Bold', sans-serif;
            text-align: left;
        }
        .avatar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .avatar {
            text-align: center;
            margin: 20px;
            transition: transform 0.3s ease-in-out;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
        }

        .avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .avatar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .avatar img:hover {
            transform: rotate(360deg);
        }

        .avatar h3 {
            margin-bottom: 5px;
        }

        .avatar a {
            color: #25588d;
            text-decoration: none;
        }

        .avatar a:hover {
            text-decoration: underline;
        }

        .nav-container {
            background-color: #DEEBD5;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            height: calc(100vh - 60px);
            overflow-y: auto;
            position: fixed;
            top: 130px;
            left: 0;
            bottom: 0;
            width: 15%;
        }

        .nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .nav-item {
            margin-top: 50px;
            margin-bottom: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .nav-link {
                font-family: 'NeoSansProRegular', sans-serif;
            text-decoration: none;
            color: black;
            transition: font-size 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #031668;
            font-size: 1.2em;
        }

        .nav-link.active {
            font-weight: bold;
            color: #76bc21;
        }

        .content {
                font-family: 'NeoSansProRegular', sans-serif;
            margin-top: 200px;
            margin-bottom: 200px;
            padding: 0px;
            margin-left: 20%;
            box-shadow: 0 4px 8px rgba(255, 118, 26, 0.918);
        }


.container-fluid {
    flex: 1;
    margin-top: 130px;
    min-height: calc(100vh - 370px); /* 100% de la hauteur de la fenêtre moins la hauteur de la sidebar et du header */
}
        .title-mentions {
            color: #25588d; /* Bleu similaire au header */
            margin-top: 120px; /* Pour donner un espace sous le header */
        }


/* Footer : position relative pour le maintenir en bas */
footer {
    background-color: #333;
    color: white;
    padding: 1%;
    width: 100%;
    font-family: 'NeoSansProLight', sans-serif;
    position: relative; /* Pour que le footer reste en bas et non fixé */
    margin-top: 20px; /* Espacement pour le footer */
}

/* Styles supplémentaires pour le footer si nécessaire */
.footer-content {
    display: flex;
    flex-wrap: wrap;
}

.footer-section {
    margin: 10px;
}

.footer-section a {
    color: white;
    text-decoration: none;
}

.footer-section a:hover {
    text-decoration: underline;
}

/* Section Contact */
.footer-contact {
    font-size: 22px;
    margin-left: 4.5%;
}

.footer-contact a {
    color: white;
    text-decoration: none;
}

.footer-contact a:hover {
    text-decoration: underline;
}

/* Section Lien central */
.footer-center {
    font-size: 17px;
    flex: 1;
    text-align: center;
}

.footer-center a {
    color: white;
    text-decoration: none;
}

.footer-center a:hover {
    text-decoration: underline;
}

/* Section Copyright et Mentions légales */
.footer-right {
    color: white;
    text-align: right;
    font-size: 13px;
}

.footer-right a {
    color: white;
    text-decoration: none;
}

.footer-right a:hover {
    text-decoration: underline;
}

/* Logo LinkedIn */
.linkedin-logo {
    width: 5%;
    height: auto;
    margin-top: 10px;
}


        @media (max-width: 768px) {
            .header {
                position: static;
            }

            .nav-container {
                width: 100%;
                height: auto;
                position: static;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 10px 0;
            }

            .nav-item {
                margin: 10px;
            }

            .content {
                margin-left: 0;
                margin-top: 20px;
                box-shadow: none;
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .content {
                margin-top: 20px;
            }

            .scroll-container {
                font-size: 14px;
                padding: 5px;
            }
        }
        
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo" class="logo">
        </div>
        <h1>Catalogue de produits</h1>
    </header>
    
    <!-- Navbar et Contenu -->
    <div class="container-fluid">
        <!-- Sidebar (Nav) -->
        <nav class="nav-container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="portable.php">PC Portables</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fixe.php">PC Fixes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecran.php">Ecrans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tablette.php">Tablettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="accessoire.php">Accessoires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resume.php">Résumé</a>
                </li>
            </ul>
        </nav>
        
        
 <div class="avatar-container">
            <div class="avatar">
                <img src="images/avatarf.png" alt="Avatar Femme 1">
                <h3>Celine BROUSSE</h3>
                <p>Responsable d'agence</p>
                <p><a href="mailto:celine.brousse@coaxis.com">Envoyer un mail à Mme BROUSSE</a></p>
                <p><a href="tel:+33671198404">06 71 19 84 04</a></p>
            </div>
            <div class="avatar">
                <img src="images/avatarh.png" alt="Avatar Homme 1">
                <h3>Jean Léandre DURAND</h3>
                <p>Commercial</p>
                <p><a href="mailto:jeanleandre.durand@coaxis.com">Envoyer un mail à Mr DURAND</a></p>
                <p><a href="tel:+33643843513">06 43 84 35 13</a></p>
            </div>
        </div>
    </div>



    <footer>
        <div class="footer-content">
            <div class="footer-contact">
                <p><a href="contact.php" target="_blank">Contact</a></p>
            </div>
            <div class="footer-center">
                <p><a href="https://www.coaxis.com/" target="_blank">www.coaxis.com</a></p>
            </div>
            <div class="footer-right">
                <p>COAXIS SOLUTIONS&copy;2024-Tous droits réservés-
                <a href="mentions-legales.html" target="_blank">Mentions légales</a>-
                <a href="https://www.linkedin.com/company/3w-coaxis/" target="_blank">
                        <img src="images/linkedin.png" alt="LinkedIn" class="linkedin-logo">
                    </a></p>
            </div>
        </div>
    </footer>
</div>
</footer>

    <!-- Scripts nécessaires -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Fonction pour définir le lien actif et agrandir son texte
        function setActiveLink(event) {
            // Empêcher le comportement par défaut du lien
            event.preventDefault();
            // Sélectionner tous les liens de la nav
            var links = document.querySelectorAll('.nav-link');
            // Supprimer la classe 'active' de tous les liens
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            // Ajouter la classe 'active' au lien cliqué
            event.target.classList.add('active');
        }
    </script>
</body>
</html> 