<?php
// phpcs:ignoreFile

declare(strict_types=1);

define('DS', DIRECTORY_SEPARATOR);
define('TMP', sys_get_temp_dir());

if (!is_dir(TMP)) {
    mkdir(TMP);
}

require_once 'vendor/autoload.php';
