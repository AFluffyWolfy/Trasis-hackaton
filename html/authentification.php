<?php
$title = "Login";
$message = "";
$erreur = "";

require '../php/headRequire.php';

require_once '../php/repository_user.php';

if (isset($_POST['login'])) {
    $mail = $_POST['mail'];
    $bcrypt_options = ['cost' => 14];
    $password = $_POST['password'];

    if (empty($password) or empty($mail)) {
        $erreur .= 'un champ est vide <br>';
    }

    $user = \TRASIS\RepositoryUser::connectUser($mail, $password,$message);

    if($user === false || $user === null) {
        $erreur .= 'l\'email ou le mot de passe est incorrect <br>';
    }

    if($erreur === "") {
        if(password_verify($password, $user->password)) {
            $_SESSION['islog'] = true;
            \TRASIS\RepositoryUser::user_dataInSession($mail,$message);
            header('location: dashboard.php');
        } else {
            $erreur .= 'Mot de passe erroné. <br>';
        }
    }
}
?>

<body class="background-lightaccent">
    <?php require 'navigation-bar.php' ?>
    <main class="center-form">
        <form class="background-blue" method="post">
            <input type="email" placeholder="Email" name="mail" class="background-lightaccent with-border font-default fs-600">
            <input type="password" placeholder="Password" name="password" class="background-lightaccent with-border font-default fs-600">
            <input type="submit" value="Se connecter" name="login" class="background-gold with-border font-default fs-600 hover-light">
        </form>
    </main>
</body>
</html>