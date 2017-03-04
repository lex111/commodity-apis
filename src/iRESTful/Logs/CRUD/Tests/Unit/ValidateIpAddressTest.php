<?php
namespace iRESTful\Logs\CRUD\Tests\Unit;

final class ValidateIpAddressTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testValidateIpAddress_Success() {
        validateIpAddress('127.0.0.1');
    }

    public function testValidateDomain_withHostNameInsteadOfIpAddress_throwsException() {

        $asserted = false;
        try {

            validateIpAddress('google.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testValidateDomain_withInvalidIpAddress_throwsException() {

        $asserted = false;
        try {

            validateIpAddress('invalid ip address');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
