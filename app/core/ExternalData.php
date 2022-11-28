<?php
namespace app\core;

class ExternalData{

	// Use cURL (stands for client URL) to get data from endpoints on the Web
	// provide the URL as the parameter and the function returns the string result
	//TODO: add basic authorization header
	static function get($url, $method = 'GET', $data = [], $followLocation = true)
	{
		//cURL is much better than file_get_contents
		$curl = curl_init();

		$cookieFile = "curl_cookies.txt";
		if(substr(PHP_OS,0,3) == 'WIN'){
			$cookieFile = str_replace('\\','/',getcwd().'/'.$cookieFile);
		}

		$options = array(
			CURLOPT_URL => $url, // this is the URL of the endpoint to request from
			CURLOPT_RETURNTRANSFER => true, //this forces output as a string to a variable
			CURLOPT_TIMEOUT => 30, //set the maximum time for the request before exiting
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, //1.1 is supported currently
			CURLOPT_FOLLOWLOCATION => $followLocation, //redirect the request as instructed in response headers
			CURLOPT_CUSTOMREQUEST => $method, //$method can be GET, POST, DELETE, PUT
			CURLOPT_POSTFIELDS => $data, //data to submit
			CURLOPT_COOKIEJAR => $cookieFile,
			CURLOPT_COOKIEFILE => $cookieFile,
			CURLOPT_HEADER => false, //set to true to see the response headers (multiple if redirected)
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache" //request uncached/fresh responses
			)
		);

		curl_setopt_array($curl, $options);

		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

//TODO: complete this
	// Use file_get_contents to get data from endpoints on the Web
	// provide the URL as the parameter and the function returns the string result
	static function fileGet($url, $method = 'GET', $data = [], $followLocation = true)
	{
		$opts = array('http' =>
		  array(
		    'method'  => $method,
		    'header'  => "Content-Type: text/xml\r\n".
		      "Authorization: Basic ".base64_encode("$https_user:$https_password")."\r\n",
		    'content' => $body,
		    'timeout' => 60
		  )
		);
                       
		$context  = stream_context_create($opts);
		
		$response = file_get_contents($url, false, $context, -1, 40000);

		return $response;
	}
}