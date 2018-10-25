#!/bin/sh
./tools/phpab --output ./src/autoload.php ./src
./tools/phpunit.phar --testdox --colors=auto
