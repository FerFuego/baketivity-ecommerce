<?php

class cURL {

    private $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    );

    public function callcURL($method, $url, $content) {

        $curl = curl_init();

        switch ($method){
            case "GET":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                if ($content)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));
                break;
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($content)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($content)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));			 					
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($content)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));			 					
                break;
            default:
                if ($content)
                    $url = sprintf("%s?%s", $url, http_build_query($content));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $response = json_decode($output, true);

        return $response;
    }

    public function getUser($id) {
        return $this->callcURL('GET', '/users/'.$id, false);
    }
}