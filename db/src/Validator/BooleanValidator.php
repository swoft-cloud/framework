<?php

namespace Swoft\Db\Validator;

use Swoft\Bean\Annotation\Bean;
use Swoft\Exception\ValidatorException;

/**
 * @Bean("DbBooleanValidator")
 */
class BooleanValidator implements ValidatorInterface
{
    /**
     * @param string $column    Colunm name
     * @param mixed  $value     Column value
     * @param array  ...$params Other parameters
     * @throws ValidatorException When validation failures, will throw an Exception
     * @return bool When validation successful
     */
    public function validate(string $column, $value, ...$params): bool
    {
        if (! \is_bool($value)) {
            throw new ValidatorException('数据库字段值验证失败，不是bool类型，column=' . $column);
        }
        return true;
    }
}
