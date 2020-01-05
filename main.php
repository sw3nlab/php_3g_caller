#!/usr/bin/php
<?php

/*
Основная часть инфы взята из : 
https://www.linux.org.ru/forum/general/6405555

И адаптирована под php

Скрипт автоматически снимает трубку и воспроизводит файл 
        [sound.wav] < ----- звук PCM 8000Гц 16bit Mono 
        Онлайн конвертер .mp3 to .wav
        https://g711.org/
        
Проверено на модеме Huawei E171
        /dev/ttyUSB0 <-- порт приёма команд
        /dev/ttyUSB1 <-- порт дебага / отслеживание команд
        /dev/ttyUSB2 <-- интерфейсный порт для звукового потока
*/

 
 $fp = fopen("/dеv/ttyUSB0","wb"); //Открываем порт для приёма команд
 sleep(1);
 fwrite($fp,"ATA\r\n"); //Снимаем трубку
 sleep(1);
 fwrite($fp,"AT^DDSETEX=2;\r\n"); //Переводим модем в режим передачи звука
  
  
 $fz = fopen("/dev/ttyUSB2","rb+"); //Открываем интерфейсный порт
 $fs = fopen("sound.wav","rb+"); //Открываем звуковой файл
  
 fseek($fs,44);//пропускаем первые 44 байта заголовка .wav файла.
  
 while(!feof($fs)){
 
      //Пока не достигнут конец звукового файла, 
      //пишем блоки по 320 байт в интерфейсный порт с паузой в 20 милисекунд. 
      
                     fwrite($fz,fread($fs,320));
                     usleep(20000);

                    }
 fclose($fz); 
 fclose($fs);
  
 fwrite($fp,"AT+CHUP;\r\n"); //кладём трубку
 fclose($fp);
 echo "All Ports closed\r\n";
 exit();
  
 ?>
