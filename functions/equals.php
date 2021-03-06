<?php
declare(strict_types=1);

/**
 * @package  Garp\Functional
 * @author   Harmen Janssen <harmen@grrr.nl>
 * @license  https://github.com/grrr-amsterdam/garp-functional/blob/master/LICENSE.md BSD-3-Clause
 */
namespace Garp\Functional;

/**
 * Functional equality check.
 *
 * @param  mixed $comparison
 * @param  mixed $subject
 * @return bool
 */
function equals($comparison, $subject = null) {
    return autocurry(
        function ($comparison, $subject): bool {
            return $comparison === $subject;
        },
        2
    )(...func_get_args());
}
