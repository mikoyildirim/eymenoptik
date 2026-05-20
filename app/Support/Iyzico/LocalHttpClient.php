<?php

namespace App\Support\Iyzico;

use Iyzipay\HttpClient;

class LocalHttpClient implements HttpClient
{
    public function get($url)
    {
        return $this->send($url, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
        ]);
    }

    public function getV2($url, $header)
    {
        return $this->send($url, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header,
        ]);
    }

    public function post($url, $header, $content)
    {
        return $this->send($url, [
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header,
        ]);
    }

    public function put($url, $header, $content)
    {
        return $this->send($url, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header,
        ]);
    }

    public function delete($url, $header, $content = null)
    {
        return $this->send($url, [
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header,
        ]);
    }

    private function send(string $url, array $options)
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, $options + [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
