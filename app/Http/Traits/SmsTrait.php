<?php

namespace App\Http\Traits;

trait SmsTrait
{
    function sendOtp($phone, $message) {
    $phone = $this->formatYemeniNumber($phone); // Ensure +967 format
    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/' . env('TWILIO_ACCOUNT_SID') . '/Messages.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_USERPWD => env('TWILIO_ACCOUNT_SID') . ':' . env('TWILIO_AUTH_TOKEN'),
        CURLOPT_POSTFIELDS => http_build_query([
            'To' => $phone,
            'From' => env('TWILIO_PHONE_NUMBER'),
            'Body' => $message
        ]),
    ]);
    
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}
}