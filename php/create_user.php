<?php
require ("repository_user.php");
require ("repository_functions.php");
use TRASIS\FunctionsRepository;
use TRASIS\User;
use TRASIS\RepositoryUser;

// Réception des infos, création du User et création du mot de passe random
$randomPassword = random_str(8);
$options = ['cost' => 14];
$hashedRandomPassword = password_hash($randomPassword, PASSWORD_BCRYPT, $options);
$user = new User();
$user->mail = $_POST['mail'];
$user->firstname = $_POST['firstname'];
$user->lastname =$_POST['lastname'];
$user->password = $hashedRandomPassword;
$user->functions = [];
$numberOfFunctions = intval($_POST['function_count']);

envoiDuMail($user, $randomPassword);

for ($i = 1; $i <= $numberOfFunctions; $i++) {
    array_push($user->functions, $_POST['function'.$i]);
}

$message = "";
RepositoryUser::user_create($user, $message);

foreach($user->functions as $function) {
    var_dump($function);
    FunctionsRepository::assignUserToFunction($user->mail, $function, $message);
    var_dump($message);
}

//header("Location: ../html/admin-main.php");

/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 * @throws Exception
 */
function random_str(
    int $length,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string
{
    $str = '';
    $max = strlen($keyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

// Envoi du mail
/**
 * @param User $user
 * @param string $randomPassword
 * @return void
 */
function envoiDuMail(User $user, string $randomPassword): void
{
    $destinateur = $user->mail;
    $sender = "trasis@trasis.com";
    $raison = "Creation of your Trasis Training account";
    $contenu = "An administrator has created an account for you on the Trasis Training website. Your password to connect is the following $randomPassword";

    $headers = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Reply-To: ' . $sender . "\n";
    $headers .= 'From: <' . $sender . '>' . "\n";
    $headers .= 'Delivered-to: ' . $destinateur . "\n";
    //mail($destinateur, $raison, $contenu, $headers); <-- besoin de setup un SMTP, donc pas fait
}


