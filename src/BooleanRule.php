<?php

namespace Aegisora\Rules;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;

class BooleanRule
{
    /**
     * @param mixed $value
     * @throws InvalidRuleContextException
     */
    private function validateValue($value): void
    {
        if (is_bool($value)) {
            return;
        }

        throw new InvalidRuleContextException();
    }
}
