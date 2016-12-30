<?php

require 'vendor/autoload.php';

use Unicodeveloper\OpenLocationCode\PlusCode;

$plusCode = new Unicodeveloper\PlusCode\PlusCode();
echo $plusCode::ENCODING_BASE;