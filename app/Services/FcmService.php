<?php

namespace App\Services;

use Google\Client;
use GuzzleHttp\Client as GuzzleClient; // Use Guzzle for making HTTP requests

class FcmService
{
    protected $client;
    protected $authConfigPath;

    public function __construct()
    {
        $this->authConfigPath = storage_path('app/public/firebase/malboos-fcm-0969926eb82e.json');
        $this->client = new Client();

        // Check if the Firebase service account file exists
        if (file_exists($this->authConfigPath)) {
            $this->client->setAuthConfig($this->authConfigPath); // Path to your Firebase service account key
            $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        } else {
            \Log::warning('Firebase Auth Config File Missing', ['path' => $this->authConfigPath]);
            $this->client = null;
        }
    }

    /**
     * Send notification to FCM.
     *
     * @param string $token The recipient device token.
     * @param string $title The notification title.
     * @param string $body The notification body.
     * @param array $data Additional data payload.
     * @return string The response message.
     */
    public function sendNotification($token, $title, $body, $data = [])
    {
        if (!$this->client) {
            \Log::warning('Push notification skipped: Firebase client is not configured.');
            return 'Push notifications are disabled due to missing Firebase configuration.';
        }

        try {
            $accessToken = $this->getAccessToken();

            if (!$accessToken) {
                \Log::error('FCM Access Token Error', ['message' => 'Failed to generate access token']);
                return 'Access token not generated';
            }

            // Prepare the FCM message payload
            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'data' => $data, // Custom data payload
                ],
            ];

            $url = 'https://fcm.googleapis.com/v1/projects/malboos-fcm/messages:send';
            $client = new GuzzleClient();

            // Log the payload before sending
            \Log::info('FCM Payload', ['payload' => $message]);

            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $message,
            ]);

            // Log the response body after success
            $responseBody = json_decode($response->getBody()->getContents(), true);
            \Log::info('FCM Response', ['response' => $responseBody]);

            if ($response->getStatusCode() == 200 && isset($responseBody['name'])) {
                return 'Message sent successfully. Message ID: ' . $responseBody['name'];
            } else {
                \Log::error('FCM Failed Response', ['response' => $responseBody]);
                return 'Message sending failed. Response: ' . json_encode($responseBody);
            }

        } catch (\Google_Service_Exception $e) {
            \Log::error('Google Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'Google Service Exception: ' . $e->getMessage();
        } catch (\Exception $e) {
            \Log::error('General Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'General Exception: ' . $e->getMessage();
        }
    }

    /**
     * Get Access Token.
     *
     * @return string|null
     */
    private function getAccessToken()
    {
        if ($this->client) {
            return $this->client->fetchAccessTokenWithAssertion()['access_token'];
        }

        return null;
    }
}
