#!/usr/bin/php
<?php

$text = "Вас приветствует Кириши Хакер спейс. Все вопросы или предложения, пишите в сообщения сообщества или в дискорд. Желаем вам хорошего настроения. Досвидания.";
                     
system('wget -q -U Mozilla -O sound.mp3 "http://translate.google.com/translate_tts?ie=UTF-8&total=1&idx=0&textlen=32&client=tw-ob&q='.$text.'&tl=Ru-gb"');

//ffmpeg -i input.mp3 -acodec pcm_s16le -ac 1 -ar 16000 output.wav

system("ffmpeg -i sound.mp3 -acodec pcm_s16le -ac 1 -ar 8000 sound.wav");

$fp = fopen("/dev/ttyUSB0","wb");
//fwrite($fp,"AT+CHUP;\r\n");
sleep(1);
//fwrite($fp,"ATA\r\n");
sleep(1);
fwrite($fp,"AT^DDSETEX=2;\r\n");


$fz = fopen("/dev/ttyUSB2","rb+");
$fs = fopen("sound.wav","rb+");

     fseek($fs,44);


    while(!feof($fs)){

         fwrite($fz,fread($fs,320));
         
         usleep(20000);
    }

fclose($fz);     
fclose($fs);

fwrite($fp,"AT+CHUP;\r\n");
fclose($fp);
unlink("sound.wav");
echo "All Ports closed\r\n";

exit();

?>

