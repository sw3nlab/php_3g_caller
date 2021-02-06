# php_3g_caller
> Автоответчик и GSM информер из USB 3G модема.

Можно использовать любым USB 3G модемом поддерживающим голосовые вызовы.
Пример взаимодействия с 3g модемом Huawei E171 на PHP и bash

## ПредНастройка 
проверка портов usb 3G модема конфигурирование
```php
lsusb

sudo ls /dev/ttyUSB*
/dev/ttyUSB0 /dev/ttyUSB1 /dev/ttyUSB2

sudo chmod 777 /dev/ttyUSB0
sudo chmod 777 /dev/ttyUSB1
sudo chmod 777 /dev/ttyUSB2
```
Проверить порт можно утилитой `screen`:
```php
screen /dev/ttyUSB0 115200
ATE
ATI
```
Затем закрыть сессию CTRL+a+k

Так же можно проверить чтение и запись через консоль одной командой:
```php
echo -e "ATI\r\n">/dev/ttyUSB0|head -n 3 /dev/ttyUSB0
```


## Проверка баланса:
```php
php balance.php
```

## Исходящий вызов: 
```php
./call.sh 79*******15
```
79*******15 - номер абонента


## Запуск демона ожидания входящего звонка:
```php
screen -q

./start.sh
```

