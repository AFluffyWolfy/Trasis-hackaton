<?php
    namespace TRASIS;

    require_once 'db_link.inc.php';

    use DB\DBLink;
    use Exception;
    use PDO;

    class Training {

        public $idTraining;
        public $name;
        public $expirationDate;
        public $idTrainingBase;
        public $duration;

    }

    class TrainingRepository {

        /**
         * Gets the requested trainings for a given user
         *
         * @param string $idUser The user's ID
         * @param string &$message The error message if something goes wrong
         *
         * @return array|null An array of TRASIS\User objects, or null if something went wrong
         */
        public static function getResquestedTrainingForUser($idUser, &$message) {
            $result = null;
            $db = null;

            try {
                $db = DBLink::connect2db(MYDB, $message);
                $stmt = $db->prepare('SELECT t.idTraining, t.name, t.duration
                                                FROM trainings t
                                                JOIN request r ON r.idTraining = t.idTraining
                                                WHERE r.idAsked = :idUser AND r.idAccepted IS NULL');
                $stmt->bindValue(':idUser', $idUser);
                if($stmt->execute() && $stmt->rowCount() == 1) {
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
         * Gets the completed trainings for a given user
         *
         * @param string $idUser The user's ID
         * @param string &$message The error message if something goes wrong
         *
         * @return array|null An array of TRASIS\User objects, or null if something went wrong
         */
        public static function getCompletedTrainingForUser($idUser, &$message) {
            $result = null;
            $db = null;

            try {
                $db = DBLink::connect2db(MYDB, $message);
                $stmt = $db->prepare('SELECT t.idTraining, t.name, t.duration
                                                FROM trainings t
                                                JOIN request r ON r.idTraining = t.idTraining
                                                WHERE r.idAsked = :idUser AND r.isValidated IS TRUE');
                $stmt->bindValue(':idUser', $idUser);
                if($stmt->execute() && $stmt->rowCount() == 1) {
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
         * Gets the ongoing training for a specific user
         *
         * @param string $idUser The user's id
         * @param string &$message The error message if something goes wrong
         *
         * @return TRASIS\User[]|null An array of user object, or null if something went wrong
         */
        public static function getOnGoingTrainingForUser($idUser, &$message) {
            $result = null;
            $db = null;

            try {
                $db = DBLink::connect2db(MYDB, $message);
                $stmt = $db->prepare('SELECT t.idTraining, t.name, t.duration
                                                FROM trainings t
                                                JOIN request r ON r.idTraining = t.idTraining
                                                WHERE r.idAsked = :idUser AND r.isValidated IS FALSE AND t.expirationDate > CURRENT_TIMESTAMP');
                $stmt->bindValue(':idUser', $idUser);
                if($stmt->execute() && $stmt->rowCount() == 1) {
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
         * Gets the soon expiring training for a specific user
         *
         * @param string $idUser The user's id
         * @param string &$message The error message if something goes wrong
         *
         * @return TRASIS\User[]|null An array of user object, or null if something went wrong
         */
        public static function getSoonExpiringTrainingForUser($idUser, &$message) {
            $result = null;
            $db = null;

            try {
                $db = DBLink::connect2db(MYDB, $message);
                $stmt = $db->prepare('SELECT t.idTraining, t.name, t.duration
                                                FROM trainings t
                                                JOIN request r ON r.idTraining = t.idTraining
                                                WHERE r.idAsked = :idUser AND r.isValidated IS FALSE AND t.expirationDate > CURRENT_TIMESTAMP');
                $stmt->bindValue(':idUser', $idUser);
                if($stmt->execute() && $stmt->rowCount() == 1) {
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

    }

?>