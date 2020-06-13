<?php

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Twig_Environment($loader);

session_start();


$_SESSION['login'] = 'toto';
$_SESSION['password'] = '123456';

// Fomulaire
$Data = [
    'login' => '',
];

if ($_POST) {

    $errors = [];
    $messages = [];

    if (isset($_POST['login'])) {
        $Data['login'] = $_POST['login'];
    }

    if (!isset($_POST['login']) || empty($_POST['login'])) {
        $errors['login'] = true;
        $messages['login'] = "Login ou Mot de passe Inccorect";
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $errors['password'] = true;
        $messages['password'] = "Login ou Mot de passe Inccorect";
    }
    
}

// affichage du rendu d'un template
echo $twig->render('login.html.twig', [
    // transmission de données au template
    'Data' => $Data,
    'errors' => $errors,
    'messages' => $messages,
    'session' => $_SESSION,
]);

