<?php
namespace TRASIS;

require_once 'db_link.inc.php';

use DB\DBLink;
use Exception;
use PDO;

class Functions {

    public $idFunction;
    public $label;
    public $description;

}

class FunctionsRepository {

    /**
     * Creates a new function in the database
     *
     * @param string $label The label of the new function
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if the function was created successfully, false otherwise
     */
    public static function functions_create($label, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("INSERT INTO functions (label)
                                    VALUES (:label)");
            $stmt->bindValue(":label", $label);
            $stmt->execute();
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;
    }

    /**
     * Gets all functions from the database
     *
     * @param string &$message The error message if something goes wrong
     *
     * @return TRASIS\Functions[]|null An array of function objects, or null if something went wrong
     */
    public static function getAllFunctions() {
        $result = null;
        $db = null;

        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare('SELECT idFunction, label, description
                                            FROM functions');
            if($stmt->execute() && $stmt->rowCount() == 1) {
                $result = $stmt->fetchAll(PDO::FETCH_CLASS, "TRASIS\Functions");
            } else {
                $message = "erreur to get functions";
            }
        } catch (Exception $e) {
            $message .= "Erreur";
        }
        DBLink::disconnect($db);
        return $result;
    }

    /**
     * Checks if a label already exists in the database
     *
     * @param string $label The label to check
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean True if the label does not exist, false otherwise
     */
    public static function veriflabelnotexist($label, &$message){
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("SELECT label FROM functions WHERE label = :label");
            $stmt->bindValue(':label', $label);
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
     * Gets the id of a function from its label
     *
     * @param string $label The function's label
     * @param string &$message The error message if something goes wrong
     *
     * @return array|boolean An associative array containing the id of the function, or false if something went wrong
     */
    public static function getidFunctionFromLabel ($label, &$message) {
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare ("SELECT idFunction FROM functions WHERE label = :label");
            $stmt->bindValue(':label', $label);
            if(!$stmt->execute()){
                return false;}
            $result = $stmt->fetch();
            $info = [
                'idFunction' => $result['idFunction']
            ];
            return $info;

        }catch (Exception $e){
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return false;
    }

    /**
     * Gets the label of the function from the given $idFunction
     *
     * @param int $idFunction The id of the function
     * @param string &$message The error message if something goes wrong
     *
     * @return array|false The label of the function, or false if something went wrong
     */
    public static function getlabelfromIdFunction ($idFunction, &$message) {
        try{
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare ("SELECT label FROM functions WHERE idFunction = :idFunction");
            $stmt->bindValue(':idFunction', $idFunction);
            if(!$stmt->execute()){
                return false;}
            $result = $stmt->fetch();
            $info = [
                'label' => $result['label']
            ];
            return $info;

        }catch (Exception $e){
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return false;
    }

    /**
     * Deletes a function from the database using it's label
     *
     * @param string $label The label of the function
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean true if there is no error, false otherwise
     */
    public static function functions_deletefromlabel($label, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("DELETE FROM functions WHERE label= :label;");
            $stmt->bindValue(":label", $label);
            $stmt->execute();
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;

    }

    /**
     * Assigns an user to a function
     *
     * @param string $mail The user's mail
     * @param string $label The label of the function
     * @param string &$message The error message if something goes wrong
     *
     * @return boolean true if there is no error, false otherwise
     */
    public static function assignUserToFunction($mail, $label, &$message)
    {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("INSERT INTO has VALUES((SELECT idFunction FROM functions WHERE label = :label),(SELECT idUser FROM users WHERE mail = :mail))");
            $stmt->bindValue(":mail", $mail);
            $stmt->bindValue(":label", $label);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $noerror = true;
            }
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;
    }

    /**
     * Deletes all the functions of an user
     *
     * @param string $mail The user's mail
     * @param string &$message The error message if something goes wrong
     *
     * @return true if there is no error, false otherwise
     */
    public static function deleteAllFunctionOfUser($mail, &$message) {
        $noerror = false;
        try {
            $db = DBLink::connect2db(MYDB, $message);
            $stmt = $db->prepare("DELETE FROM has WHERE idUser = (SELECT idUser FROM users WHERE mail = :mail)");
            $stmt->bindValue(":mail", $mail);
            if ($stmt->execute()) {
                $noerror = true;
            }
        } catch (Exception $e) {
            $message .= $e . '<br>';
        }
        DBLink::disconnect($db);
        return $noerror;
    }

}
