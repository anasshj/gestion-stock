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

// Fetch products
$produits = [];
try {
    $sql = "SELECT * FROM produits";
    $stmt = $pdo->query($sql);
    $produits = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des produits : " . $e->getMessage();
    $produits = [];
}

// Check if a product is being modified
$modifierProduit = null;
if (isset($_GET['modifier'])) {
    $id = $_GET['modifier'];
    try {
        $sql = "SELECT * FROM produits WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $modifierProduit = $stmt->fetch();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du produit à modifier : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Stock</title>
</head>
<body>
    <h1>Ajouter un produit</h1>
    <form action="handleform.php" method="post">
        <input type="text" id="nom" name="nom" required><br><br>
        <textarea id="description" name="description" required></textarea><br><br>
        <input type="number" step="0.01" id="prix" name="prix" required><br><br>
        <input type="number" id="quantite" name="quantite" required><br><br>
        <input type="submit" name="ajouter" value="Ajouter le produit">
    </form>

    <h2>Liste des produits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($produits)): ?>
                <tr>
                    <td colspan="6">Aucun produit trouvé.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?php echo $produit['id']; ?></td>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo number_format($produit['prix'], 2, ',', ' '); ?> €</td>
                    <td><?php echo $produit['quantite']; ?></td>
                    <td>
                        <a href="index.php?modifier=<?php echo $produit['id']; ?>">Modifier</a>
                        <a href="handleform.php?supprimer=<?php echo $produit['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($modifierProduit): ?>
    <h2>Modifier le produit</h2>
    <form action="handleform.php" method="post">
        <input type="hidden" name="id" value="<?php echo $modifierProduit['id']; ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($modifierProduit['nom']); ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($modifierProduit['description']); ?></textarea><br><br>

        <label for="prix">Prix :</label>
        <input type="number" step="0.01" id="prix" name="prix" value="<?php echo $modifierProduit['prix']; ?>" required><br><br>

        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" value="<?php echo $modifierProduit['quantite']; ?>" required><br><br>

        <input type="submit" name="modifier" value="Enregistrer les modifications">
    </form>
    <?php endif; ?>
</body>
</html>
