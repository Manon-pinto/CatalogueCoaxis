<?php
session_start();
include('scripts/db.php');
require('fpdf.php');

// Vérifie si le panier existe
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit();
}

// Créer un objet FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Ajouter un titre
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Résumé de votre Panier', 0, 1, 'C');

// Ajouter une ligne vide
$pdf->Ln(10);

// Ajouter les colonnes du panier
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 10, 'Nom de l\'article', 1);
$pdf->Cell(30, 10, 'Quantité', 1);
$pdf->Cell(40, 10, 'Prix Unitaire', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Ln();

$total_panier = 0;
foreach ($_SESSION['panier'] as $article) {
    $pdf->Cell(60, 10, $article['name'], 1);
    $pdf->Cell(30, 10, $article['quantite'], 1);
    $pdf->Cell(40, 10, number_format($article['price'], 2, ',', ' ') . '€', 1);
    $pdf->Cell(40, 10, number_format($article['price'] * $article['quantite'], 2, ',', ' ') . '€', 1);
    $pdf->Ln();
    $total_panier += $article['price'] * $article['quantite'];
}

// Ajouter le total du panier
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 10, 'Total du panier :', 0);
$pdf->Cell(40, 10, number_format($total_panier, 2, ',', ' ') . '€', 0);

// Générer le fichier PDF
$pdf->Output('D', 'panier.pdf');
?>
