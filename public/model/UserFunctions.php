<?php

class UserFunctions {

    private function openDb() {
        if (!$connection = mysqli_connect('localhost', 'root', 'root', 'scotchbox')) {
            throw new Exception("Connection to the database server failed!");
        } else {
            $connection->query("CREATE TABLE IF NOT EXISTS users (
              id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              fname VARCHAR(128) NOT NULL,
              lname VARCHAR(128) NOT NULL,
              email VARCHAR(255) DEFAULT NULL,
              password VARCHAR(255) DEFAULT NULL
            )");
            return $connection;
        }
    }

    private function closeDb($connection) {
        mysqli_close($connection);
    }

    public function getUsers() {
        try {
            $connection = $this->openDb();
            $dbresult = $connection->query("SELECT * FROM users");
            $users = array();
            while ( ($obj = mysqli_fetch_object($dbresult)) != NULL ) {
                $users[] = $obj;
            }
            $this->closeDb($connection);
            return $users;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUser($id) {
        try {
            $connection = $this->openDb();
            $dbId = $connection->real_escape_string($id);

            $dbresult = $connection->query("SELECT * FROM users WHERE id=$dbId");

            $result = mysqli_fetch_object($dbresult);
            $this->closeDb($connection);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createNewUser( $fname, $lname, $email, $password ) {
        try {
            $connection = $this->openDb();
            $dbFname = ($fname != NULL)?"'".$connection->real_escape_string($fname)."'":'NULL';
            $dbLname = ($lname != NULL)?"'".$connection->real_escape_string($lname)."'":'NULL';
            $dbEmail = ($email != NULL)?"'".$connection->real_escape_string($email)."'":'NULL';
            $dbPassword = ($password != NULL)?"'".$connection->real_escape_string($password)."'":'NULL';

            $result = $connection->query("INSERT INTO users (fname, lname, email, password) VALUES ($dbFname, $dbLname, $dbEmail, $dbPassword)");

            $this->closeDb($connection);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateUser( $fname, $lname, $email, $password, $id ) {
        try {
            $connection = $this->openDb();
            $dbFname = ($fname != NULL)?"'".$connection->real_escape_string($fname)."'":'NULL';
            $dbLname = ($lname != NULL)?"'".$connection->real_escape_string($lname)."'":'NULL';
            $dbEmail = ($email != NULL)?"'".$connection->real_escape_string($email)."'":'NULL';
            $dbPassword = ($password != NULL)?"'".$connection->real_escape_string($password)."'":'NULL';
            $dbId = ($id != NULL)?"'".$connection->real_escape_string($id)."'":'NULL';

            $result = $connection->query("UPDATE users SET fname = $dbFname, lname = $dbLname, email = $dbEmail, password = $dbPassword WHERE id = $dbId");

            $this->closeDb($connection);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteUser( $id ) {
        try {
            $connection = $this->openDb();
            $dbId = $connection->real_escape_string($id);
            $connection->query("DELETE FROM users WHERE id=$dbId");
            $this->closeDb($connection);
        } catch (Exception $e) {
            throw $e;
        }
    }


}

?>
