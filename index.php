<?php

$bdd = new PDO('mysql:host=localhost;dbname=searchbar;charset=utf8', 'root', 'root');

$login = $bdd->query('SELECT login FROM users ORDER BY id DESC');

if (isset($_GET['q']) AND !empty($_GET['q']))
{
    $q = htmlspecialchars($_GET['q']);

    // MODIFIER LA REQUETE AU CAS OU ON VU UN CHAMPS PLUS LARGE CHOIX

    $login = $bdd->query('SELECT login FROM users WHERE login LIKE "'.$q.'%" ORDER BY id DESC');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SearchBar</title>
</head>
<body>

<form method="GET" action="">
    <input type="search" name="q" placeholder="Recherche...">
    <input type="submit" value="Valider">
<form>

<?php if ($login->rowCount() > 0) { ?>
    
    <ul>
        <?php while ($l = $login->fetch()) { ?>
            <li><?= $l['login']; ?></li>
        <?php } ?>
    </ul>

<?php }else { ?>

    Aucun résultat...

<?php } ?>



    
</body>
</html>