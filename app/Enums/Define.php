<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Define extends Enum
{
    const DATE_FORMAT_12 = 'Y-m-d h:i A';
    const DATE_FORMAT_24 = 'Y-m-d H:i:s';
    const DATE_FORMAT = 'Y-m-d';
}