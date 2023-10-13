<?php
namespace TRASIS;

require_once 'db_link.inc.php';

use DB\DBLink;
use Exception;
use PDO;

class User {

    public $idUser;
    public $firstname;
    public $lastname;
    public $functions;
    public $mail;
    public $password;
    public $idManager;

}

class RepositoryUser {

    /**
     * Connects the user to the database
     *
     * @param string $mail The user's mail
     * @param string $password The user's password
     * @param string &$message The error message if something goes wrong
     *
     * @return TRASIS\User|null The user object, or null if something went wrong
     */
    public static function connectUser($mail, $password, &$message) {
        $result = null;
        $db = null;

        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare('SELECT idUser, firstname, lastname, mail, password
                                            FROM users 
                                            WHERE mail = :mail AND isActive IS TRUE');
            $stmt->bindValue(':mail', $mail);
            if($stmt->execute() && $stmt->rowCount() == 1) {
                $result = $stmt->fetchObject("TRASIS\User");
            } else {
                $message = "Wrong identifiant";
            }
        } catch (Exception $e) {
            $message .= "Erreur";
        }
        DBLink::disconnect($db);
        return $result;
    }


    /**
     * Gets the user's information using the user's ID
     *
     * @param string $idUser The user's ID
     * @param string &$message The error message if something goes wrong
     *
     * @return TRASIS\User|null The user object, or null if something went wrong
     */
    public static function getUserId($idUser, &$message) {
        $result = null;
        $db = null;

        try {
            $db = DBLink::connect2db(MYDB, $message);
            var_dump($message);
            $stmt = $db->prepare('SELECT idUser, firstname, lastname, mail
                                            FROM users 
                                            WHERE idUser = :idUser');
            $stmt->bindValue(':idUser', $idUser);
            if($stmt->execute() && $stmt->rowCount() == 1) {
                $result = $stmt->fetchObject("TRASIS\User");
            } else {
                $message = "Wrong identifiant";
            }
        } catch (Exception $e) {
            $message .= "Erreur";
        }
        DBLink::disconnect($db);
        return $result;
    }

    /**
     * Gets all users' information from the database
     *
     * @param string &$message The error message if something goes wrong
     *
     * @return TRASIS\User[]|null An array of user objects, or null if something went wrong
     */
    public static function getAllUsers(&$message) {
        $result = null;
        $db = null;

        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare('SELECT idUser, firstname, lastname, mail
                                            FROM users');
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS, "TRASIS\User");
            } else {
                $message = "Wrong identifiant";
            }
        } catch (Exception $e) {
            $message .= "Erreur";
        }
        DBLink::disconnect($db);
        return $result;
    }


    /**
     * Creates a new user in the database
     *
     * @param TRASIS\User $user The user object to be created
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if user was created successfully, false otherwise
     */
    public static function user_create($user, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("INSERT INTO users (firstname, lastname, mail, password, idManager, isactive)
                                    VALUES (:firstname,:lastname,:mail,:password,:idManager, true)");
            $stmt->bindValue(":firstname", $user->firstname);
            $stmt->bindValue(":lastname", $user->lastname);
            $stmt->bindValue(":mail", $user->mail);
            $stmt->bindValue(":password", $user->password);
            $stmt->bindValue(":idManager", $user->idManager);
            $stmt->execute();
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;
    }

    /**
     * Modifies an existing user in the database
     *
     * @param TRASIS\User $user The user object to be modified
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if user was modified successfully, false otherwise
     */
    public static function user_modif($user, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail, idManager = :idManager WHERE idUser = :idUser;");
            $stmt->bindValue(":firstname", $user->firstname);
            $stmt->bindValue(":lastname", $user->lastname);
            $stmt->bindValue(":mail", $user->mail);
            $stmt->bindValue(":password", $user->password);
            $stmt->bindValue(":idManager", $user->idManager);
            $stmt->bindValue(":idUser", $user->idUser);
            $stmt->execute();
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;

    }


    /**
     * Changes the user's password in the database
     *
     * @param TRASIS\User $user The user object whose password needs to be changed
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if password was changed successfully, false otherwise
     */
    public static function user_changePassword($user, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("UPDATE users SET password = :password WHERE idUser = :idUser;");
            $stmt->bindValue(":password", $user->password);
            $stmt->bindValue(":idUser", $user->idUser);
            $stmt->execute();
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;
    }

    /**
     * Checks if a given mail is already in use by an existing user
     *
     * @param TRASIS\User $user The user object to be checked
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if mail is not in use, false otherwise
     */
    public static function user_verifmailnotexist($user, &$message){
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("SELECT mail FROM users WHERE mail = :mail");
            $stmt->bindValue(':mail', $user->mail);
            if($stmt->execute() == true && $stmt->rowCount() == 0)
            {
                return true;
            } else {
                return false;
            }
        }catch (Exception $e){
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return false;
    }

    /**
     * Stores the user's information in the session
     *
     * @param string $mail The user's mail
     * @param string &$message The error message if something goes wrong
     *
     * @return array|boolean The user's information, or false if something went wrong
     */
    public static function user_dataInSession ($mail, &$message) {
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare ("SELECT idUser, mail, lastname, firstname, idManager FROM users WHERE mail = :mail");
            $stmt->bindValue(':mail', $mail);
            if(!$stmt->execute()){
                return false;}
            $result = $stmt->fetch();

            $_SESSION['idUser'] = $result['idUser'];
            $_SESSION['mail'] = $result['mail'];
            $_SESSION['lastname'] = $result['lastname'];
            $_SESSION['firstname'] = $result['firstname'];
            $_SESSION['idManager'] = $result['idManager'];
            return $result;

        }catch (Exception $e){
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return false;
    }


    /**
     * Gets the user's ID from their mail
     *
     * @param string $mail The user's mail
     * @param string &$message The error message if something goes wrong
     *
     * @return array|boolean An array containing the user's ID, or false if something went wrong
     */
    public static function user_getidUserFromMail ($mail, &$message) {
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare ("SELECT idUser FROM users WHERE mail = :mail");
            $stmt->bindValue(':mail', $mail);
            if(!$stmt->execute()){
                return false;}
            $result = $stmt->fetch();
            $info = [
                'idUser' => $result['idUser']
            ];
            return $info;

        }catch (Exception $e){
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return false;
    }

    /**
     * Deactivates a user in the database
     *
     * @param TRASIS\User $user The user to deactivate
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if the user was deactivated, false otherwise
     */
    public static function user_desactivate ($user, &$message) {
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("UPDATE users SET isactive = FALSE WHERE idUser = :idUser");
            $stmt->bindValue(':idUser', $user->idUser);
            if($stmt->execute()){
                $message = "User updated";
                return true;
            } else{
                $message = "Cannot update user";
                return false;
            }
        }catch (Exception $e){
            $message .= $e . '<br>';
        }

        DBLink::disconnect($db);
        return false;
    }

}

?>