<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class PermissionConstructorTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testCannotRead_cannotWrite_Success() {
        permissionConstructor(false, false);
    }

    public function testCanRead_cannotWrite_Success() {
        permissionConstructor(true, false);
    }

    public function testCanRead_canWrite_Success() {
        permissionConstructor(true, true);
    }

    public function testCannotRead_canWrite_throwsException() {

        $asserted = false;
        try {

            permissionConstructor(false, true);

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
