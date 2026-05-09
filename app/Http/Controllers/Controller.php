<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;

abstract class Controller
{
    public function sendFCMNotification($title, $body, $tokens)
    {
        $credentialsFilePath = storage_path('firebase-auth.json');

        if (!file_exists($credentialsFilePath)) {
            \Log::error("FCM Service Account file not found at: " . $credentialsFilePath);
            return false;
        }

        try {
            $factory = (new Factory)->withServiceAccount($credentialsFilePath);
            $messaging = $factory->createMessaging();

            $responses = [];

            foreach ($tokens as $fcmToken) {
                $message = CloudMessage::withTarget('token', $fcmToken)
                    ->withNotification(Notification::create($title, $body))
                    ->withAndroidConfig(AndroidConfig::fromArray([
                        'priority' => 'high',
                        'notification' => [
                            'channel_id' => 'paud_notif_channel',
                            'sound' => 'default'
                        ]
                    ]));

                try {
                    $result = $messaging->send($message);
                    $responses[] = $result;
                    \Log::info("FCM Response for token {$fcmToken}: Sukses via Kreait. Result: " . json_encode($result));
                } catch (\Kreait\Firebase\Exception\MessagingException $e) {
                    \Log::error("Kreait FCM Error for token {$fcmToken}: " . $e->getMessage());
                    // ERROR HANDLING TEGAS SEPERTI SEBELUMNYA
                    dd([
                        'STATUS' => 'ERROR_DITOLAK_GOOGLE',
                        'FCM_ERROR' => $e->getMessage(),
                        'FCM_ERROR_DETAILS' => $e->errors()
                    ]);
                }
            }

            return $responses;
        } catch (\Exception $e) {
            \Log::error("FCM System Error: " . $e->getMessage());
            dd([
                'STATUS' => 'FATAL_SYSTEM_ERROR',
                'ERROR' => $e->getMessage()
            ]);
            return false;
        }
    }
}
