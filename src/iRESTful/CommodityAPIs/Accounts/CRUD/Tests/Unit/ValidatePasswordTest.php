<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class ValidatePasswordTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testPasswordHasDefaultAlgo_Success() {
        $hash = password_hash('my pass', \PASSWORD_DEFAULT);
        validatePassword($hash);
    }

    public function testPasswordIsNotHashed_throwsException() {

        $asserted = false;
        try {

            validatePassword('password is not hashed');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

}
