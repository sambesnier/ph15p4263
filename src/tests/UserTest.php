<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 26/06/2017
 * Time: 13:52
 */

use PHPUnit\Framework\TestCase;

/**
 * @covers User
 */
class UserTest extends TestCase
{
    public function setUp()
    {
        $this->user = new User();
    }
}
