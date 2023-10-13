<?php

    require_once "repository_user.php";

    use TRASIS\RepositoryUser;
    use TRASIS\User;

    if(isset($_GET['archive_user']) && isset($_GET['idUser'])) {
        $user = new User();
        $user->idUser = intval($_GET['idUser']);
        $message = "";
        RepositoryUser::user_desactivate($user, $message);
        echo $message;
    } else if(isset($_GET['edit_user'])) {
    } else {
        echo "{ message : \"You cannot do this\" } " . var_dump($_POST);
    }

?>