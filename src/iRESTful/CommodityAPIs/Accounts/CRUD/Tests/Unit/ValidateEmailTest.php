<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class ValidateEmailTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testEmailIsValid_Success() {
        validateEmail('steve@irestful.net');
    }

    public function testEmailLooksValid_domainNameDoesNotExists_throwsException() {

        $asserted = false;
        try {

            validateEmail('steve@this-is-not-a-valid-domain-lets-hope-it-does-not-change.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testEmailContainsNoCommercialA_throwsException() {

        $asserted = false;
        try {

            validateEmail('google.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testEmailContainsMultipleCommercialA_throwsException() {

        $asserted = false;
        try {

            validateEmail('steve@again@irestful.net');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testEmailUsernameIsEmpty_throwsException() {

        $asserted = false;
        try {

            validateEmail(' @irestful.net');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testEmailHasNoUsername_throwsException() {

        $asserted = false;
        try {

            validateEmail('@irestful.net');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
