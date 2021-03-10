<?php
//Autor: Wagner Bizarro
//$type = $_POST['type'];
//$name = $_POST['name'];
$name = "Telefonia";
//echo "$type $name";

$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, 10); 
	if (!$socket) {
		echo "$errstr ($errno)\n";
	} else {//Connection
		fputs($socket, "Action: Login\r\n");
		fputs($socket, "UserName: monitor\r\n");
		fputs($socket, "Secret: monitor@4dyln3t\r\n\r\n");
		
		fputs($socket, "Action: Command\r\n");
	        fputs($socket, "Command: queue show $name\n\r\n");
		fputs($socket, "Action: Logoff\r\n\r\n");

		//shell_exec('echo 0 > /var/www/html/mtr/php/info.txt');
		$file = fopen("/var/www/html/mtr/php/info.txt", "w+");
		fwrite($file,'');
		while (!feof($socket)) {
			$return = fgets($socket);
			fwrite($file, $return."\r\n");
			
		}
	} 
	fclose($file);
	fclose($socket);
	
	shell_exec('cp /var/www/html/mtr/php/info.txt /var/www/html/mtr/php/Qinfo.txt');
	$Qfile = file_get_contents('/var/www/html/mtr/php/Qinfo.txt');
	$Qfile = strstr($Qfile, 'Output:    Members:');
	//$Qfile = strtok($Qfile, "Response Goodbye");
	//$Qfile = preg_replace('/Event: SuccessfulAuth.*/', '', $Qfile);
	//$Qfile = strtok($Qfile, 'Event: SuccessfulAuth');
	//$Qfile = preg_replace('/\bSuccessfulAuth.*$/', '', $Qfile);
	//$Qfile = preg_replace('/\bResponse: Goodbye.*$/', '', $Qfile);	
	//$Qfile = substr($Qfile, 0, strpos($Qfile, "Event: SuccessfulAut"));
	$text1 = "Event: SuccessfulAuth";
	$text2 = "Response: Goodbye";

	if (strpos($Qfile, $text1) !== false){
	$Qfile = strstr($Qfile,$text1, true);
	}
	else{
	$Qfile = strstr($Qfile,$text2, true);
	}

	print_r($Qfile);
	
	
?>
