<?php

use Symfony\Component\VarDumper\Cloner\Data;

function getAge($dateOfBirth)
{
    $dob = new DateTime($dateOfBirth);
    $today = new DateTime(date('Y-m-d'));
    $age = $today->diff($dob);

    return $age->y;
}
