<?php

namespace App\Http\Traits;

trait  SmsTrait
{
    function sendOtp($phone,$message)
    {
        $phone = "966".$phone;
         $curl = curl_init();

         curl_setopt_array($curl, array(
             CURLOPT_URL => 'https://api.taqnyat.sa/v1/messages',
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => '',
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => 'POST',
             CURLOPT_POSTFIELDS => '{

               "recipients": [
                 '.strval($phone).'
             ],
             "body":"'.$message.'",
             "sender":"AmaraCon"
           }',
             CURLOPT_HTTPHEADER => array(
                 'Content-Type: application/json',
                 'Authorization: Bearer b350167229406a79227d7c9c6bb7e9f8'
             ),
         ));

         $response = curl_exec($curl);

         curl_close($curl);
//         echo $response;
    }
}
