<?php

class SMRest {

	protected function post($query, $body = array()) {

	}

	protected function get($query) {

	}

	protected function put($query, $body = array()) {

	}

	protected function delete($query) {

	}

    public function request($query = "", $requestMethod = "GET", $data = array()) {
    	
        if (!in_array($requestMethod, self::$validRequestMethods))
            die("Your requested method is not valid! and Valid methods are : ".
                implode(",", self::$validRequestMethods));
                
        if (!function_exists('curl_init'))
            die('Sorry cURL is not installed!');
        else
        {
            $consumer = new OAuthConsumer(self::consumerKey, self::consumerSecret);

            // Setup OAuth request - Use NULL for OAuthToken parameter
            $request = OAuthRequest::from_consumer_and_token($consumer, NULL, 
                    $requestMethod, self::apiUrl.$query);

            // Sign the constructed OAuth request using HMAC-SHA1 - Use NULL for OAuthToken parameter
            $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, NULL);
            
            // Extract OAuth header from OAuth request object and assign to a variable
            $oauthHeader = $request->to_header();
        
            $curl = curl_init(self::apiUrl.$query);           
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FAILONERROR, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            switch ($requestMethod) {
                case 'GET':
                    curl_setopt(
                        $curl, 
                        CURLOPT_HTTPHEADER,
                        array(
                            "Content-Type: application/vnd.stackmob+json;",
                            'Content-Length: 0',
                            "Accept: application/vnd.stackmob+json; version=".self::version,
                            $oauthHeader
                        )
                    );
                    break;
                case 'POST':
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array(
                            'Content-Type: application/vnd.stackmob+json; version='.self::version,
                            'Content-Length: '.strlen(json_encode($data)),
                            "Accept: application/vnd.stackmob+json; version=".self::version,
                            $oauthHeader
                        )
                    );
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case 'PUT':
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array(
                            "Content-Type: application/vnd.stackmob+json;",
                            'Content-Length: '.strlen(json_encode($data)
                        ),
                        "Accept: application/vnd.stackmob+json; version=".self::version,
                        $oauthHeader)
                    );
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    break;
                case 'DELETE':
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array(
                            "Content-Type: application/vnd.stackmob+json;",
                            'Content-Length: 0',
                            "Accept: application/vnd.stackmob+json; version=".self::version,
                            $oauthHeader
                        )
                    );
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
                    break;
            }
            
            $response = curl_exec($curl);
            
            if (!$response) {
                print_r(curl_error($curl));
                curl_close($curl);
                return false;
            } else
                curl_close($curl);

            return true;
        }
    }
	
}
?>