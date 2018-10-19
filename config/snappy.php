<?php

return array(


    'pdf' => array(
        'enabled' => true,
        //'binary'  => '/usr/local/bin/wkhtmltopdf',
        'binary'  => 'D:\Serv\wkhtmltox\bin\wkhtmltopdf.exe',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
       // 'binary'  => '/usr/local/bin/wkhtmltoimage',
        'binary'  => 'D:\Serv\wkhtmltox\bin\wkhtmltoimage.exe',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
