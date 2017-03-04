<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class ValidateDomainNameTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testDomainNameIsValid_Success() {
        validateDomainName('irestful.net');
    }

    public function testDomainNameLooksValid_butDoesNotExists_throwsException() {

        $asserted = false;
        try {

            validateDomainName('this-is-not-a-valid-domain-lets-hope-it-does-not-change.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

    public function testDomainNameIsEmpty_throwsException() {

        $asserted = false;
        try {

            validateDomainName('');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

    public function testDomainNameIsInvalid_throwsException() {

        $asserted = false;
        try {

            validateDomainName('this is not a domain name');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);

    }

}
