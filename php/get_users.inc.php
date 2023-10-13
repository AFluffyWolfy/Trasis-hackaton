<?php

    require_once 'repository_user.php';

    use TRASIS\RepositoryUser;

    $message = "";
    $users = RepositoryUser::getAllUsers($message);

    echo strlen($message) == 0 ? json_encode(RepositoryUser::getAllUsers($message)) : "{ message : $message }";

?>