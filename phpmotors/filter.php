<?php

$mail = "jason55@gymailcom";
$check = is_validemail($mail);
echo $check;

function is_validemail($mail)
{

    $check=0;

    if(filter_var($mail,FILTER_VALIDATE_EMAIL))
    {
        $check=1;
    }
    return $check;

}