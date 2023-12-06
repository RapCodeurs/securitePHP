<?php
// Pour échaper les charactères speciaux on utiluse la fonction htmlspecialchars()
// Pour filtrer les liens on peut utiliser la fonction filter_var: *** $url = filter_var($message, FILTER_VALIDATE_URL);

If (isset($_POST['submit']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    $url = filter_var($message, FILTER_VALIDATE_URL);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cas pratique</title>
</head>
<body>
    <h1>Formulaire</h1>
    <form method="post">
        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="5" cols="40"><?php if($url !== false ){echo "Lien interdit";} else{ echo $message; } ?></textarea><br>
        <input type="submit" name="submit" value="Soumettre">
    </form>
</body>
</html>