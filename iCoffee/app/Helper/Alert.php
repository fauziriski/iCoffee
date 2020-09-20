<?php
use RealRashid\SweetAlert\Facades\Alert;

function successMessage($message)
{
    $alert = Alert::success($message)->showConfirmButton('Ok', '#3085d6');
    return $alert;
}
   
function errorMessage($message)
{
    $alert = Alert::error($message)->showConfirmButton('Ok', '#3085d6');
    return $alert;

}

function infoMessage($message)
{
    $alert = Alert::info($message)->showConfirmButton('Ok', '#3085d6');
    return $alert;

}

function warningMessage($message)
{
    $alert = Alert::warning($message)->showConfirmButton('Ok', '#3085d6');
    return $alert;

}


