<?php
use PHPUnit\Framework\TestCase;
use Garp\Functional as f;

/**
 * @package  Garp\Functional
 * @author   Harmen Janssen <harmen@grrr.nl>
 * @license  https://github.com/grrr-amsterdam/garp-functional/blob/master/LICENSE.md BSD-3-Clause
 */
class ConcatRightTest extends TestCase {

    public function test_should_concat_arrays() {
        $a = array(1, 2, 3);
        $b = array(4, 5, 6);
        $this->assertEquals(
            array(4, 5, 6, 1, 2, 3),
            f\concat_right($a, $b)
        );
    }

    public function test_should_concat_assoc_arrays() {
        $a = array(
            'first_name' => 'Miles',
            'last_name' => 'Davis'
        );
        $b = array(
            'instrument' => 'trumpet'
        );
        $this->assertEquals(
            array('first_name' => 'Miles', 'last_name' => 'Davis', 'instrument' => 'trumpet'),
            f\concat_right($a, $b)
        );
    }

    public function test_left_overrides_right() {
        $a = array(
            'first_name' => 'Miles',
            'last_name' => 'Davis'
        );
        $b = array(
            'first_name' => 'John'
        );
        $this->assertEquals(
            array('first_name' => 'Miles', 'last_name' => 'Davis'),
            f\concat_right($a, $b)
        );
    }

    public function test_should_concat_strings() {
        $this->assertEquals(
            'DavisMiles',
            f\concat_right('Miles', 'Davis')
        );
    }

    public function test_should_concat_strings_to_arrays_if_either_argument_is_array() {
        $this->assertEquals(
            array('Davis', 'Miles'),
            f\concat_right('Miles', array('Davis'))
        );
        $this->assertEquals(
            array('Davis', 'Miles'),
            f\concat_right(array('Miles'), 'Davis')
        );
    }

    public function test_should_cast_numbers_to_strings() {
        $this->assertEquals(
            '95042',
            f\concat_right(
                42, 50, 9
            )
        );
        $this->assertEquals(
            '4.095',
            f\concat_right(5, 4.09)
        );
    }

    public function test_should_be_variadic() {
        $this->assertEquals(
            [7, 8, 9, 4, 5, 6, 1, 2, 3],
            f\concat_right(
                [1, 2, 3],
                [4, 5, 6],
                [7, 8, 9]
            )
        );
    }

    public function test_should_be_curried() {
        $concatMiles = f\concat_right('Miles');
        $this->assertTrue(is_callable($concatMiles));

        $this->assertEquals('DavisMiles', $concatMiles('Davis'));
        $this->assertEquals(
            ' DavisMiles',
            $concatMiles(f\concat(' ', 'Davis'))
        );

        $concatRightArray = f\concat_right(array('name' => 'Joe'));
        $this->assertEquals(
            array('name' => 'Joe'),
            $concatRightArray(array('name' => 'Hank'))
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_should_throw_on_boolean_arguments() {
        f\concat_right(true, false);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_should_throw_on_invalid_object() {
        f\concat_right('This', 'will', 'go', new stdClass(), 'wrong');
    }

}
