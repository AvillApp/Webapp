<?php 
require_once 'autoload.php';

  function enviar_push($token, $msg, $title, $userId){

    $notification = ['title' => $title,'body' => $msg];
    try{

        $expo = \ExponentPhpSDK\Expo::normalSetup();
        $expo->notify($userId,$notification);//$userId from database
        $status = 'success';
    }catch(Exception $e){
            $expo->subscribe($userId, $token); //$userId from database
            $expo->notify($userId,$notification);
            $status = 'new subscribtion';
    }

    echo $status;

  }

?>