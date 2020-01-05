#!/bin/bash
while [ 1 ]; do
        DATA=`dd if=/dev/ttyUSB1 count=1`

        echo $DATA

if echo $DATA|grep RING; then
/usr/bin/php main.php
else
    echo "Waiting incoming call..."
fi

done
