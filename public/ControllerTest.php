<?php

require_once "controller/UsersController.php";

class ControllerTest extends PHPUnit_Framework_TestCase
{
   /**
   * @runInSeparateProcess
   */
    public function testRedirect()
    {
        $location = 'index.php';

        $mock = $this->getMockBuilder('\UsersController')
        ->setMethods(array('header'))
            ->getMock();

        $mock->expects($this->once())
             ->method('header');

        $mock->redirect($location);
    }

    public function testHandleList()
    {
        $_GET['op'] = 'list';

        $mock = $this->getMockBuilder('\UsersController')
        ->setMethods(array('listUsers', 'addUser', 'deleteUser', 'updateUser', 'showError'))
            ->getMock();

        $mock->expects($this->once())
             ->method('listUsers');

        $mock->handleRequest($_GET['op']);
    }

    public function testHandleNew()
    {
        $_GET['op'] = 'new';

        $mock = $this->getMockBuilder('\UsersController')
        ->setMethods(array('listUsers', 'addUser', 'deleteUser', 'updateUser', 'showError'))
            ->getMock();

        $mock->expects($this->once())
             ->method('addUser');

        $mock->handleRequest($_GET['op']);
    }

    public function testHandleDelete()
    {
        $_GET['op'] = 'delete';

        $mock = $this->getMockBuilder('\UsersController')
        ->setMethods(array('listUsers', 'addUser', 'deleteUser', 'updateUser', 'showError'))
            ->getMock();

        $mock->expects($this->once())
             ->method('deleteUser');

        $mock->handleRequest($_GET['op']);
    }

    public function testHandleUpdate()
    {
        $_GET['op'] = 'update';

        $mock = $this->getMockBuilder('\UsersController')
        ->setMethods(array('listUsers', 'addUser', 'deleteUser', 'updateUser', 'showError'))
            ->getMock();

        $mock->expects($this->once())
             ->method('updateUser');

        $mock->handleRequest($_GET['op']);
    }

    /**
    * @runInSeparateProcess
    */
    public function testAddUser()
    {
        $_POST['form-submitted'] = TRUE;
        $_POST['fname'] = 'bob';
        $_POST['lname'] = 'bill';
        $_POST['email'] = 'a@b.c';
        $_POST['password'] = 'pass';

        $mock = $this->getMockBuilder('\UsersController')
            ->setMethods(array('createNewUser'))
            ->getMock();

        $mock->expects($this->once())
             ->method('createNewUser');

        $mock->addUser();
    }

    /**
    * @runInSeparateProcess
    */
    public function testUpdateUser()
    {
        $_POST['form-submitted'] = TRUE;
        $_POST['fname'] = 'bob';
        $_POST['lname'] = 'bill';
        $_POST['email'] = 'a@b.c';
        $_POST['password'] = 'pass';
        $id = 1;

        $mock = $this->getMockBuilder('\UsersController')
            ->setMethods(array('updateUser'))
            ->getMock();

        $mock->expects($this->once())
             ->method('updateUser');

        $mock->UpdateUser();
    }

    /**
    * @runInSeparateProcess
    */
    public function testDeleteUser()
    {
        $_GET['id'] = 1;

        $mock = $this->getMockBuilder('\UsersController')
            ->setMethods(array('deleteUser'))
            ->getMock();

        $mock->expects($this->once())
             ->method('deleteUser');

        $mock->deleteUser();
    }
}

?>
