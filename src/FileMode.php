<?php

namespace Ambimax\File;

/**
 * These are the possible modes Php fopen() function
 * for more Information see parameter 'mode' on
 * https://www.php.net/manual/de/function.fopen.php.
 */
enum FileMode: string
{
    case R = 'r';
    case R_PLUS = 'r+';
    case W = 'w';
    case W_PLUS = 'w+';
    case A = 'a';
    case A_PLUS = 'a+';
    case X = 'x';
    case X_PLUS = 'x+';
    case C = 'c';
    case C_PLUS = 'c+';
    case E = 'e';
}
