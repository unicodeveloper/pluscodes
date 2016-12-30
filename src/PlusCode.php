<?php

/*
 * This file is part of the Jusibe PHP library.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unicodeveloper\OpenLocationCode;

use Unicodeveloper\OpenLocationCode\Exceptions\NotAString;
use Unicodeveloper\OpenLocationCode\Exceptions\Invalid;


class PlusCode {

    // A separator used to separate the code into two parts to aid memorability.
    const SEPARATOR = '+';

    // The number of characters to place before the separator.
    const SEPARATOR_POSITION = 8;

    // The character used to pad codes.
    const SUFFIX_PADDING = '0';

    // The character set used to encode the values.
    const CODE_ALPHABET = '23456789CFGHJMPQRVWX';

    const ENCODING_BASE = 20;

    // The maximum value for latitude in degrees.
    const LATITUDE_MAX = 90;

    // The maximum value for longitude in degrees.
    const LONGITUDE_MAX = 180;

    // Maxiumum code length using lat/lng pair encoding. The area of such a
    // code is approximately 13x13 meters (at the equator), and should be suitable
    // for identifying buildings. This excludes prefix and separator characters.
    const PAIR_CODE_LENGTH = 10;

    // The resolution values in degrees for each position in the lat/lng pair
    // encoding. These give the place value of each position, and therefore the
    // dimensions of the resulting area.
    const PAIR_RESOLUTIONS = [20.0, 1.0, .05, .0025, .000125];

    // Number of columns in the grid refinement method.
    const GRID_COLUMNS = 4;

    // Number of rows in the grid refinement method.
    const GRID_ROWS = 5;

    // Size of the initial grid in degrees.
    const GRID_SIZE_DEGREES = 0.000125;

    // Minimum length of a code that can be shortened.
    const MIN_TRIMMABLE_CODE_LEN = 6;

    /**
     * Determines if a code is valid
     * @param  none
     * @return code
     */
    public function isValid(code)
    {
       // Is it a string
       if (!is_string(code)) {
          throw NotAString::create("Please input a valid string");
       }

       // Is it the only character?
       if (strlen(code) == 1) {
          throw Invalid::create("Code is not valid, can't be lonely");
       }

       // The separator is required.
       if (strpos(code, self::SEPARATOR) === false) {
         throw Invalid::create("Code is not valid");
       }

       // Is it in an illegal position?
       if (strpos(code, self::SEPARATOR) > self::SEPARATOR_POSITION || 
            strpos(code, self::SEPARATOR) % 2 === 1) {
         throw Invalid::create("Code is not valid");
       }

       // We can have an even number of padding characters before the separator,
       // but then it must be the final character.
       if (strpos(code, self::SUFFIX_PADDING) == 0) {
          throw Invalid::create("Code is not valid");
       }

    }
}

$p =  new PlusCode;
echo $p->getIt();