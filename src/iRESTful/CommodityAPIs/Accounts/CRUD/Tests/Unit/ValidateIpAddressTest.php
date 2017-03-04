<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class ValidateIpAddress extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testIpAddressIsValid_Success() {
        validateIpAddress('127.0.0.1');
    }

    public function testIpAddressIsInvalid_throwsException() {

        $asserted = false;
        try {

            validateIpAddress('127.0.0.1.5');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testIpAddressIsEmpty_throwsException() {

        $asserted = false;
        try {

            validateIpAddress('');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testIpAddressIsNotAnIpAddress_throwsException() {

        $asserted = false;
        try {

            validateIpAddress('google.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
