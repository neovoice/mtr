<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');  

//Declared array
$new_arr = array(); 

//Create Socket 
$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, 10);
	if (!$socket) {
		echo "$errstr ($errno)\n";
	} else {//Connection
		fputs($socket, "Action: Login\r\n");
		fputs($socket, "UserName: monitor\r\n");
		fputs($socket, "Secret: monitor@4dyln3t\r\n\r\n");

		while (!feof($socket)) {//listening socket
			$return = fgets($socket);
			$new_key = strstr($return, ':', true);//var key
			$new_val = strstr($return, ':');
			$new_val = str_replace(':', '', $new_val);
			$new_val = str_replace(' ', '', $new_val);//var value

			if( ($new_key) && ($new_val) ) {// !=NULL, create array
				$new_arr[$new_key] = $new_val;
				
				if (array_key_exists("Event", $new_arr)){
					$arrjson = json_encode($new_arr);
					//print_r($arrjson);
					//echo "\n\n";
					echo "data: {$arrjson}\n\n";
					flush();
				}//if array_key_exist 


			}//if key 

		}//while 
	}//else socket sucess
 fclose($socket);
?>
