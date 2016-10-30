<?php

require_once "controller/UsersController.php";

class UserTest extends PHPUnit_Framework_TestCase
{
    public function testHandle() {
        $_GET['op'] = 'list';

        $mock = $this->getMockBuilder('\UsersController')
            ->setMethods(array('listUsers', 'addUser', 'deleteUser', 'updateUser'))
            ->getMock();

        $mock->expects($this->once())
             ->method('listUsers');

        $mock->handleRequest($_GET['op']);
    }
}

?>
