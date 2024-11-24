<?php
$host = 'localhost';
$dbname = 'stock';
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username,  $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Handle adding a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    $sql = "INSERT INTO produits (nom, description, prix, quantite) VALUES (:nom, :description, :prix, :quantite)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite' => $quantite]);
    header("Location: index.php"); // Redirect back to the main page
    exit();
}

// Handle updating a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    $sql = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, quantite = :quantite WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite' => $quantite, 'id' => $id]);
    header("Location: index.php");
    exit();
}

// Handle deleting a product
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $sql = "DELETE FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: index.php");
    exit();
}

// If no valid action, redirect back to index
header("Location: index.php");
exit();
