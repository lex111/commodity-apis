<?php
namespace iRESTful\Logs\CRUD\Tests\Unit;

final class ValidateKeynameTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testValidateKeyname_Success() {
        validateKeyname('keyname');
    }

    public function testValidateKeyname_withNumber_Success() {
        validateKeyname('keyname09');
    }

    public function testValidateKeyname_withHyphen_Success() {
        validateKeyname('this-is-a-valid-keyname');
    }

    public function testValidateKeyname_withHyphen_withNumber_Success() {
        validateKeyname('this-is-a-23-valid-keyname');
    }

    public function testValidateKeyname_withUppercaseLetter_thowsException() {

        $asserted = false;
        try {

            validateKeyname('This-is-an-invalid-keyname');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

    public function testValidateKeyname_withInvalidCharacter_thowsException() {

        $asserted = false;
        try {

            validateKeyname('this-is-an-invalid_character');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

}
