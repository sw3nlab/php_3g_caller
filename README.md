# php_3g_caller
> Автоответчик и GSM информер из USB 3G модема.

Можно использовать c любым USB 3G модемом поддерживающим голосовые вызовы.
<br/>
Пример взаимодействия с 3g модемом Huawei E171 на PHP и bash

![image](https://github.com/sw3nlab/php_3g_caller/blob/master/unnamed.jpg)

## ПредНастройка 
проверка портов usb 3G модема и конфигурирование
```php
sw3nlab@nettop:~$ sudo dmesg | grep "modem"
[   34.351170] usbserial: USB Serial support registered for GSM modem (1-port)
[   34.351481] option 6-2:1.0: GSM modem (1-port) converter detected
[   34.355209] usb 6-2: GSM modem (1-port) converter now attached to ttyUSB0
[   34.356207] option 6-2:1.1: GSM modem (1-port) converter detected
[   34.357821] usb 6-2: GSM modem (1-port) converter now attached to ttyUSB1
[   34.358461] option 6-2:1.2: GSM modem (1-port) converter detected
[   34.358885] usb 6-2: GSM modem (1-port) converter now attached to ttyUSB2
sw3nlab@nettop:~$


sw3nlab@nettop:~$ lsusb

Bus 007 Device 001: ID 1d6b:0003 Linux Foundation 3.0 root hub
Bus 006 Device 003: ID 12d1:1506 Huawei Technologies Co., Ltd. Modem/Networkcard <== !
Bus 006 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub

//Если модем определяется как Mass Storage накопитель необходимо установить пакет usb-modeswitch
sw3nlab@nettop:~$ sudo apt install usb-modeswitch usb-modeswitch-data

sw3nlab@nettop:~$ sudo ls /dev/ttyUSB*
/dev/ttyUSB0 /dev/ttyUSB1 /dev/ttyUSB2

sw3nlab@nettop:~$ sudo chmod 777 /dev/ttyUSB0
sw3nlab@nettop:~$ sudo chmod 777 /dev/ttyUSB1
sw3nlab@nettop:~$ sudo chmod 777 /dev/ttyUSB2
```
Проверить порт можно утилитой `screen`:
```php
sw3nlab@nettop:~$ screen /dev/ttyUSB0 115200
>ATI

Manufacturer: huawei
Model: E171
Revision: 21.156.00.00.143
IMEI: 861496*********
+GCAP: +CGSM,+DS,+ES

OK

```
Затем закрыть сессию CTRL+a+k

Так же можно проверить чтение и запись через консоль одной командой:
```php
sw3nlab@nettop:~$ echo -e "ATI\r\n">/dev/ttyUSB0|head -n 3 /dev/ttyUSB0
ATI
Manufacturer: huawei
Model: E171
sw3nlab@nettop:~$
```


## Проверка баланса:
```php
sw3nlab@nettop:~$ php balance.php
```

## Исходящий вызов: 
```php
sw3nlab@nettop:~$ ./call.sh 79*******15
```
79*******15 - номер абонента


## Запуск демона ожидания входящего звонка:
```php
sw3nlab@nettop:~$ screen -q

sw3nlab@nettop:~$ ./start.sh
```

## Пример работы:
[![Watch the video](https://github.com/sw3nlab/php_3g_caller/blob/master/bg.png)](https://www.youtube.com/watch?v=P0o_nLUiKkI)
