<?php

namespace Classes;
class ApiClient
{
    public function __construct(
        public string $url,
        public string $client_secret,
    )
    {
    }

    public function sendRequest($jsonData)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $this->client_secret",
                "Content-Type: application/json"
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($jsonData),
        ]);
        $response = curl_exec($curl);

        if (curl_error($curl)) {
            throw new Exception("CURL error: " . curl_error($curl));
        }

        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return [
            'response' => $response,
            'httpcode' => $responseCode
        ];
    }
}