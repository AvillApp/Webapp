<?php 
require_once 'autoload.php';
    
// $channelName = 'news';
// $recipient= 'ExponentPushToken[bQ7mvkGAdDxmAbMfNfXPiq]';

// // You can quickly bootup an expo instance
// $expo = \ExponentPhpSDK\Expo::normalSetup();

// // Subscribe the recipient to the server
// $expo->subscribe($channelName, $recipient);

// // Build the notification data
// $notification = ['body' => 'Jeisson esto es una prueba!'];

// // Notify an interest with a notification
// $expo->notify([$channelName], $notification);


$token = "ExponentPushToken[S_IbP9PeJLFxe8bfMUijva]";
$msg = "Estamos en camino";
$title= "Tu Rappi Segura";
$userId = 'userId from your database';
enviar_push($token, $msg, $title, $userId);

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