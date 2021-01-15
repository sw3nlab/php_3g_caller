#!/bin/bash
echo -e "ATD+"$1";\r\n">/dev/ttyUSB0
while [ 1 ]; do
    sleep 2
    DATA=`dd if=/dev/ttyUSB0 count=1`

        echo $DATA

if echo $DATA|grep CONN:1,0; then
#echo "okokokokoko"
/usr/bin/php call.php
exit
else
    echo "No."
fi

done
