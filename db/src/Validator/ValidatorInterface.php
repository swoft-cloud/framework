<?php

namespace Swoft\Db\Validator;

use Swoft\Exception\ValidatorException;

/**
 * Interface ValidatorInterface
 *
 * @package Swoft\Db\Validator
 */
interface ValidatorInterface
{
    /**
     * @param string $column    Colunm name
     * @param mixed  $value     Column value
     * @param array  ...$params Other parameters
     * @throws ValidatorException When validation failures, will throw an Exception
     * @return bool When validation successful
     */
    public function validate(string $column, $value, ...$params): bool;
}
