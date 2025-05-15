<?php


namespace App\Http\Traits;


use App\Models\UserToken;
use Google\Auth\Credentials\ServiceAccountCredentials;
trait NotificationTrait
{
    private function initializeAccessToken()
    {


        try {
            $jsonKeyPath = base_path(config('services.firebase.service_account_json'));
            $jsonKey = json_decode(file_get_contents($jsonKeyPath), true);
            $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

            $credentials = new ServiceAccountCredentials($scopes, $jsonKey);
            $credentials->fetchAuthToken();

            return  $credentials->getLastReceivedToken();
        } catch (\Exception $e) {
            // Handle exceptions appropriately here
            return $e->getMessage();
        }

    }
    public function sendFCMNotification($array_to, $title, $message,$type, $data = null,
                                        $message_type = null)
    {
        $projectId = env('FIREBASE_PROJECT_ID');
        $accessToken = $this->initializeAccessToken();
        $tokens = UserToken::whereIn("user_id", $array_to)->
        where('type',$type)->pluck('token')->toArray();

        foreach ($tokens as $token) {
            $notificationData = [
                "message" => [
                    "token" => $token,
                    "notification" => [
                        "title" => $title,
                        "body" => $message,
                    ],
                    "data" => [
                        "title" => $title,
                        "body" => $message,
                        "data_" => json_encode($data),
                        "message_type_" => $message_type,
                    ],
                    "android" => [
                        "notification"=>[
                        "sound" => "notification",
                        "channel_id" => "test",
                        ]
                    ],
                ],
            ];
            $headers = [
                'Authorization: Bearer ' . $accessToken['access_token'],
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/".$projectId."/messages:send");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificationData));
            $response = curl_exec($ch);
        }

//        return $response;
    }
}
