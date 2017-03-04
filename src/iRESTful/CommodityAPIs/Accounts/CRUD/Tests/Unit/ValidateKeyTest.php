<?php
namespace iRESTful\CommodityAPIs\Accounts\CRUD\Tests\Unit;

final class ValidateKeyTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        include_once(__DIR__.'/../../code.php');
    }

    public function tearDown() {

    }

    public function testKeyIsValid_has50Characters_Success() {
        $key = '8uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK8765432'; //50 characters
        validateKey($key);
    }

    public function testKeyIsValid_has99Characters_Success() {
        $key = '8uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK8765432uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK8765432'; //99 characters
        validateKey($key);
    }

    public function testKeyIsValid_has49Characters_throwsException() {

        $asserted = false;
        try {

            $key = '8uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK876543'; //49 characters
            validateKey($key);

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testKeyIsValid_has100Characters_throwsException() {

        $asserted = false;
        try {

            $key = '8uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK8765432uytgyhujikolpoijuhytgfrtgfawsqwerTGRFPLOIK87654320'; //100 characters
            validateKey($key);

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

    public function testKeyIsValid_withInvalidCharacter_throwsException() {

        $asserted = false;
        try {

            $key = '8uytgyhujikolpoijuhytgfrtgfawsqwer|TGRFPLOIK8765432'; //This character is invalid: |
            validateKey($key);

        } catch (\Exception $exception) {
            $asserted = true;
        }

        $this->assertTrue($asserted);
    }

}
