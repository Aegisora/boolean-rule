<?php

namespace Aegisora\Rules;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;

class BooleanRule
{
    private bool $expected;

    private function __construct(
        bool $expected
    ) {
        $this->expected = $expected;
    }

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
