<?php

class UserFunctions
{
   /**
   * Opens the connection to the database and makes sure the table is there.
   *
   * @param  none
   * @return conection to database
   * @throws Exception if connection to database fails
   */
    private function openDb()
    {
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

    /**
    * Closes the connection to the database
    *
    * @param  object $connection
    * @return void
    * @throws none
    */
    private function closeDb($connection)
    {
        mysqli_close($connection);
    }

    public function getUsers()
    {
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
            $this->showError("Get users error", $e->getMessage());
        }
    }

    /**
    * Queries the database for a user based on id
    *
    * @param  int $id
    * @return object of user
    * @throws Exception if the user cannot be found
    */
    public function getUser($id)
    {
        try {
            $connection = $this->openDb();
            $dbId = $connection->real_escape_string($id);

            $dbresult = $connection->query("SELECT * FROM users WHERE id=$dbId");

            $result = mysqli_fetch_object($dbresult);

            $this->closeDb($connection);

            return $result;
        } catch (Exception $e) {
            $this->showError("Get user error", $e->getMessage());
        }
    }

    /**
    * Creates a new user in the database
    *
    * @param  string $fname, string $lname, string $email, string $password
    * @return query result
    * @throws Exception if the user cannot be created
    */
    public function createNewUser($fname, $lname, $email, $password)
    {
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
            $this->showError("Create user error", $e->getMessage());
        }
    }

    /**
    * Updates a user by id
    *
    * @param  string $fname, string $lname, string $email, string $password, int $id
    * @return query result
    * @throws Exception if the user cannot be updated
    */
    public function updateUser($fname, $lname, $email, $password, $id)
    {
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
            $this->showError("Update user error", $e->getMessage());
        }
    }

    /**
    * Deletes user by ID
    *
    * @param int $id
    * @return void
    * @throws Exception if the user cannot be deleted
    */
    public function deleteUser($id)
    {
        try {
            $connection = $this->openDb();
            $dbId = $connection->real_escape_string($id);
            $connection->query("DELETE FROM users WHERE id=$dbId");
            $this->closeDb($connection);
        } catch (Exception $e) {
            $this->showError("Delete user error", $e->getMessage());
        }
    }
}

?>
