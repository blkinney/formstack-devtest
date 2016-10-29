<?php

require_once 'model/UserFunctions.php';

class UsersController
{
    private $userFunctions = NULL;

    /**
    * Contructs class UserFunctions
    *
    * @param  none
    * @return void
    * @throws none
    */
    public function __construct()
    {
        $this->userFunctions = new UserFunctions();
    }

    /**
    * Redirects user to given location
    *
    * @param  none
    * @return void
    * @throws none
    */
    public function redirect($location)
    {
        header('Location: '.$location);
        exit();
    }

    /**
    * Interprets user request and invokes correct method
    *
    * @param  none
    * @return void
    * @throws exception if user action can't be interpreted
    */
    public function handleRequest()
    {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listUsers();
            } elseif ( $op == 'new' ) {
                $this->addUser();
            } elseif ( $op == 'delete' ) {
                $this->deleteUser();
            } elseif ( $op == 'update' ) {
                $this->updateUser();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
    }

    /**
    * Lists all users in the database
    *
    * @param  none
    * @return void
    * @throws non
    */
    public function listUsers()
    {
        $users = $this->userFunctions->getUsers();
        include 'view/users.php';
    }

    /**
    * Takes data from form and sends it to be added to the database
    *
    * @param  none
    * @return void
    * @throws exception if user can't be added
    */
    public function addUser()
    {

        $fname = '';
        $lname = '';
        $email = '';
        $password = '';

        $errors = array();

        if ( isset($_POST['form-submitted']) ) {

            $fname       = isset($_POST['fname']) ?   $_POST['fname']  :NULL;
            $lname      = isset($_POST['lname'])?   $_POST['lname'] :NULL;
            $email      = isset($_POST['email'])?   $_POST['email'] :NULL;
            $password    = isset($_POST['password'])? $_POST['password']:NULL;

            try {
                $this->userFunctions->createNewUser($fname, $lname, $email, $password);
                $this->redirect('index.php');
                return;
            } catch (Exception $e) {
                throw $e;
            }
        }

        include 'view/add-user.php';
    }

    /**
    * Deletes a user from the database
    *
    * @param  none
    * @return void
    * @throws none
    */
    public function deleteUser()
    {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }

        $this->userFunctions->deleteUser($id);

        $this->redirect('index.php');
    }

    /**
    * Takes data from form and sends it to the method to update a user in the database
    *
    * @param  none
    * @return void
    * @throws exception if user can't be updated
    */
    public function updateUser()
    {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }

        $user = $this->userFunctions->getUser($id);

        $fname = $user->fname;
        $lname = $user->lname;
        $email = $user->email;
        $password = $user->password;
        $id = $user->id;

        $errors = array();

        if ( isset($_POST['form-submitted']) ) {
            $fname       = isset($_POST['fname']) ?   $_POST['fname']  :NULL;
            $lname      = isset($_POST['lname'])?   $_POST['lname'] :NULL;
            $email      = isset($_POST['email'])?   $_POST['email'] :NULL;
            $password    = isset($_POST['password'])? $_POST['password']:NULL;

            try {
                $this->userFunctions->updateUser($fname, $lname, $email, $password, $id);
                $this->redirect('index.php');
                return;
            } catch (Exception $e) {
                throw $e;
            }
        }

        include 'view/update-user.php';
    }

    /**
    * Shows errors in case of exceptions
    *
    * @param  string $title, string $message
    * @return void
    * @throws none
    */
    public function showError($title, $message)
    {
        include 'view/error.php';
    }
}

?>
