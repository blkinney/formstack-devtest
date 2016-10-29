<?php

require_once 'model/UserFunctions.php';

class UsersController {

    private $userFunctions = NULL;

    public function __construct() {
        $this->userFunctions = new UserFunctions();
    }

    public function redirect($location) {
        header('Location: '.$location);
    }

    public function handleRequest() {
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

    public function listUsers() {
        $users = $this->userFunctions->getUsers();
        include 'view/users.php';
    }

    public function addUser() {

        $title = 'Add new user';

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
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/add-user.php';
    }

    public function deleteUser() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }

        $this->userFunctions->deleteUser($id);

        $this->redirect('index.php');
    }

    public function updateUser() {

        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }

        $user = $this->userFunctions->getUser($id);

        $title = 'Update user';

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
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/update-user.php';
    }

    public function showError($title, $message) {
        include 'view/error.php';
    }

}
?>
