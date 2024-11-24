
# Gestion de Stock

## Description
Ce projet est une application web simple permettant de gérer un stock de produits. Les fonctionnalités incluent :
- Ajouter un produit.
- Modifier un produit.
- Supprimer un produit.
- Afficher la liste des produits.

L'application utilise **PHP** pour le backend et **MySQL** comme base de données.



## Installation

1. Clonez ce dépôt ou téléchargez les fichiers sources :
   ```bash
   git clone <URL_DU_DÉPÔT>
   ```

2. Placez les fichiers dans le répertoire `htdocs` ou tout autre répertoire utilisé par votre serveur web.

3. Configurez la base de données :
   - Connectez-vous à votre gestionnaire de base de données MySQL (phpMyAdmin ou ligne de commande).
   - Créez une base de données nommée `stock` :
     ```sql
     CREATE DATABASE stock;
     USE stock;
     ```
   - Créez la table `produits` :
     ```sql
     CREATE TABLE produits (
         id INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
         nom VARCHAR(50),
         description VARCHAR(255),
         prix DOUBLE,
         quantite INT
     );
     ```


---

## Fonctionnalités

1. **Ajouter un produit** :
   - Saisissez les informations d'un produit (nom, description, prix, quantité) et ajoutez-le à la base de données.

2. **Modifier un produit** :
   - Cliquez sur le bouton **Modifier** pour modifier les informations d'un produit existant.

3. **Supprimer un produit** :
   - Cliquez sur le bouton **Supprimer** pour supprimer un produit de la liste.

4. **Afficher la liste des produits** :
   - Tous les produits enregistrés sont affichés dans un tableau.

---

## Structure des fichiers

```plaintext
.
├── index.php            # Page principale affichant la liste des produits et les formulaires
├── handleform.php       # Gestion des actions Ajouter, Modifier et Supprimer
├── README.md            # Documentation du projet
```

---

## Technologies utilisées

- **Langages** :
  - PHP
  - SQL
  - HTML

- **Base de données** :
  - MySQL


