<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsertRecords extends Controller
{
    public function zohoCreate($token, $modul, $prepeaRequst){
        $curl_pointer = curl_init();
        
        $curl_options = array();
        $url = "https://www.zohoapis.com/crm/v2/" . $modul;
        
        $curl_options[CURLOPT_URL] =$url;
        $curl_options[CURLOPT_RETURNTRANSFER] = true;
        $curl_options[CURLOPT_HEADER] = 1;
        $curl_options[CURLOPT_CUSTOMREQUEST] = "POST";
        $requestBody = array();
        $recordArray = array();
        $recordObject = $prepeaRequst;
        
        $recordArray[] = $recordObject;
        $requestBody["data"] =$recordArray;
        $curl_options[CURLOPT_POSTFIELDS]= json_encode($requestBody);
        $headersArray = array();
        
        $headersArray[] = "Authorization". ":" . "Zoho-oauthtoken " . $token;
        
        $curl_options[CURLOPT_HTTPHEADER]=$headersArray;
        
        curl_setopt_array($curl_pointer, $curl_options);
        
        $result = curl_exec($curl_pointer);
        $responseInfo = curl_getinfo($curl_pointer);
        curl_close($curl_pointer);
        list ($headers, $content) = explode("\r\n\r\n", $result, 2);
        if(strpos($headers," 100 Continue")!==false){
            list( $headers, $content) = explode( "\r\n\r\n", $content , 2);
        }
        $headerArray = (explode("\r\n", $headers, 50));
        $headerMap = array();
        foreach ($headerArray as $key) {
            if (strpos($key, ":") != false) {
                $firstHalf = substr($key, 0, strpos($key, ":"));
                $secondHalf = substr($key, strpos($key, ":") + 1);
                $headerMap[$firstHalf] = trim($secondHalf);
            }
        }
        $jsonResponse = json_decode($content, true);
        if ($jsonResponse == null && $responseInfo['http_code'] != 204) {
            list ($headers, $content) = explode("\r\n\r\n", $content, 2);
            $jsonResponse = json_decode($content, true);
        }
        // var_dump($headerMap);
        // var_dump($jsonResponse);
        // var_dump($responseInfo['http_code']);

        return $jsonResponse;
        
    }
}
