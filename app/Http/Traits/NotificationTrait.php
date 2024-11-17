<?php


namespace App\Http\Traits;

use App\Models\Notification;
use App\Models\PhoneToken;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google_Client;
use Illuminate\Support\Facades\Log;

trait NotificationTrait
{
    /*
       |--------------------------------------------------------------------------
       | send Firebase Notification
       |--------------------------------------------------------------------------
       |
       |this function take a 3 params
       |1- array of users Id , you want to sent
       |2-single id to get the name of sender
       |3-mess array to send
       |
       | Support: "ios ", "android"
       |
       */

    public function sendAllNotifications($array_to, $title, $message, $image = null)
    {
        $this->sendNotification($array_to, $title, $message, $image);
        $this->sendFCMNotification($array_to, $title, $message);
    }

    //****************************************************************************************
    private function initializeAccessToken()
    {
        try {
            $jsonKeyPath = storage_path(config('services.firebase.service_account_json'));
            $jsonKey = json_decode(file_get_contents($jsonKeyPath), true);
            $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

            $credentials = new ServiceAccountCredentials($scopes, $jsonKey);
            $credentials->fetchAuthToken();

            return $credentials->getLastReceivedToken();
        } catch (\Exception $e) {
            // Handle exceptions appropriately here
            return $e->getMessage();
        }

    }

    public function sendFCMNotification($array_to, $title, $message)
    {
        $projectId = config('services.firebase.project_id');
        $accessToken = $this->initializeAccessToken();
        $tokens = PhoneToken::whereIn("user_id", $array_to)->pluck('phone_token')->toArray();

        foreach ($tokens as $token) {
            try {
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
                        ],
                    ],
                ];
                $headers = [
                    'Authorization: Bearer ' . $accessToken['access_token'],
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/" . $projectId . "/messages:send");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notificationData));
                $response = curl_exec($ch);
                curl_close($ch);
//                return $response;
            } catch (\Exception $e) {
                Log::error('Exception: ' . $e->getMessage());
            }
        }

    }

    public function sendNotification($array_to, $title, $message, $image = null)
    {
        $data = [];
        $data['title'] = $title;
        $data['message'] = $message;
        $data['image'] = $image;

        foreach ($array_to as $user_id) {
            $data['user_id'] = $user_id;
            Notification::create($data);
            $data['user_id'] = null;
        }
    }

}
