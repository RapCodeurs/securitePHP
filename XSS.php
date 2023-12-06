<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telechargement</title>
</head>
<body>
    <h1>Téléchargement d'unt fichier</h1>
    <form method="POST", enctype="multipart/form-data">
        <input type="file", name="file" required>
        <button type="submit", name="submit">Téléchargement</button>
    </form>
</body>
</html>

<?php

// Vérifie si le formulaire a été soumis en vérifiant si le bouton submit a été utilisé
if(isset($_POST['submit'])){

    // récuperation des informations de notre fichier
    // Récupère le nom du fichier en supprimant les balises HTML et PHP potentiellement dangereuses
    $file_name = strip_tags($_FILES['file']['name']);
    // Récupère la taille du fichier envoyé
    $file_size = $_FILES['file']['size'];
    // Récupère l'emplacement temporaire du fichier envoyé sur le serveur
    $file_tmp = $_FILES['file']['tmp_name'];
    // Récupère le type MIME du fichier envoyé
    $file_type = $_FILES['file']['type'];

    // Sépare le nom de fichier et son extension
    $file_ext = explode('.', $file_name);
    // Récupère l'extension du fichier en transformant la chaîne en minuscule
    $file_end = end($file_ext);
    $file_end = strtolower($file_end);

    // Définit la liste des extensions de fichiers autorisées
    $extensions = ['doc', 'jpg', 'docx', 'xls'];


    if(in_array($file_end, $extensions) === false){

        // Si l'extension du fichier n'est pas autorisée, on affiche un message d'erreur
        echo " Veuillez utiliser les extensions suivantes : DOC, JPG , DOCX , XLS";
    }
    // Si la taille du fichier dépasse la limite autorisée, on affiche un message d'erreur
    elseif($file_size > 300000){
        echo " le fichier est trop volumineux";

    }else{
        // On nettoie le nom de fichier en supprimant les caractères spéciaux
        $file_end = preg_replace('/[^A-Za-z0-9.\-]/', '' ,$file_end);

        // On déplace le fichier uploadé vers le répertoire "uploads" avec son nom d'origine
            move_uploaded_file($file_tmp, "uploads/".$file_name);
        
        // On affiche un message de succès pour indiquer que le téléchargement a réussi
            echo " Le fichier ".$file_name." a été téléchargé avec succès";
    }
}

?>