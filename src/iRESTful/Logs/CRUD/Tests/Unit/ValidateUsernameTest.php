<?php
namespace iRESTful\Logs\CRUD\Tests\Unit;

final class ValidateUsernameTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testValidateUsername_Success() {
        validateUsername('my_username');
    }

    public function testValidateUsername_withSpaces_throwsException() {

        $asserted = false;
        try {

            validateUsername('invalid username');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testValidateUsername_withEndOfLine_throwsException() {

        $asserted = false;
        try {

            validateUsername('invalid'.PHP_EOL.'username');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
