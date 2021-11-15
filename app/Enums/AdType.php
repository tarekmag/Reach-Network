<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AdType extends Enum
{
    /**
     * Ad Types
     */
    const FREE = 'free';
    const PAID = 'paid';
}