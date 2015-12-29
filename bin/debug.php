<?php

require __DIR__ . '/../vendor/autoload.php';

$ttl      = 10;
$filename = __DIR__ . '/cache-file';

if ( filemtime($filename) + $ttl > time() ) {
    echo "read from cache";
} else {
    echo "cache stale";
}




