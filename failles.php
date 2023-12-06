<?php

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

// Connexion à la base de données

$dsn  = "mysql:host=localhost;dbname=failles;charset=utf8mb4";

$options = [
    
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, 'admin', 'admin', $options);

// On prépare la requête SQL avec des marqueurs de position

$pdo_prep = $pdo->prepare("SELECT * from user WHERE username = ? AND password = ? ");

// On exécute la requête SQL avec les valeurs des variables $username et $password comme arguments

$pdo_prep->execute([$username,$password]); 

// On récupère le premier enregistrement de la requête SQL sous forme de tableau associatif
$user = $pdo_prep->fetch();

if ($user) {
    echo "<br>"; 
    echo " Bienvenue " .$user['username'] . "!";

} else {

    echo " Nom d'utilisateur ou mot de passe incorrect";

}

