<?php

namespace Komakino\Modulus11\Tests;

use Komakino\Modulus11\Modulus11;

class Mod11Test extends \PHPUnit_Framework_TestCase
{

    public function provideValues()
    {
        return array(
            array('1234.56.78903', '1234.56.7890', 3),
            array('036522X', '036522', 'X'),
            array('01010104900', '0101010490', 0)
        );
    }

    /**
     * @param string $withCheckDigit
     * @dataProvider provideValues
     */
    public function testValidate($withCheckDigit)
    {
        $this->assertTrue(Modulus11::validate($withCheckDigit));
    }

    /**
     * @param string $withCheckDigit
     * @param string $withoutCheckDigit
     * @param string|int $checkDigit
     * @dataProvider provideValues
     */
    public function testCalculate($withCheckDigit, $withoutCheckDigit, $checkDigit)
    {
        $this->assertSame($checkDigit, Modulus11::calculate($withoutCheckDigit));
    }

    /**
     * @param string $withCheckDigit
     * @param string $withoutCheckDigit
     * @param string|int $checkDigit
     * @dataProvider provideValues
     */
    public function testAppendCheckDigit($withCheckDigit, $withoutCheckDigit, $checkDigit)
    {
        $appended = Modulus11::appendCheckDigit($withoutCheckDigit);
        $this->assertSame($withoutCheckDigit . $checkDigit, $appended);
        $this->assertTrue(Modulus11::validate($appended));
    }

    public function testCustomFactors()
    {
        $this->assertTrue(Modulus11::validate('11223346'));
        $this->assertTrue(Modulus11::validate('1705833214',[2,5,4,9,8,1,6,7,3]));
        $this->assertSame(3,Modulus11::calculate('1705833214'));
    }
}
