<?php
namespace iRESTful\Logs\CRUD\Tests\Unit;

final class ValidateDomainTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testValidateDomain_Success() {
        validateDomain('google.com');
    }

    public function testValidateDomain_withNonExistingDomain_throwsException() {

        $asserted = false;
        try {

            validateDomain('non-existing-domain-999.com');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testValidateDomain_withInvalidDomain_throwsException() {

        $asserted = false;
        try {

            validateDomain('this-is-not-a-domain');

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
