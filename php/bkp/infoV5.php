<?php
//Autor: Wagner Bizarro
$type = $_POST['type'];
$name = $_POST['name'];

//$name = "1001";
//$type = "peer";

//Info Queues
if ($type == "queue") { 
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

		$file = fopen("/var/www/html/mtr/php/Qinfo.txt", "w+");
		fwrite($file,'');
		while (!feof($socket)) {
			$return = fgets($socket);
			fwrite($file, $return."\r\n");
		}
	} 
 	fclose($file);
 	fclose($socket);
	
	$Qfile = file_get_contents('/var/www/html/mtr/php/Qinfo.txt');
	//$Qfile = strstr($Qfile, 'Output:    Members:');
	//$text3 = "Event: SuccessfulAuth";
	//$text4 = "Response: Goodbye";
	$text1 = "Output:    No Callers";
	$text2 = "Output:    Callers:"; 
	$text3 = "Event: SuccessfulAuth";
	$text4 = "Response: Goodbye"; 
	
	if (strpos($Qfile, $text1) !== false){
		$Qfile = strstr($Qfile,$text1);
		 if (strpos($Qfile, $text3) !== false) {
		 	$Qfile = strstr($Qfile,$text3, true);					
		 } else { $Qfile = strstr($Qfile,$text4, true); }
		
	}
	
 	else {
		$Qfile = strstr($Qfile,$text2);
		if (strpos($Qfile, $text3) !== false) {
			$Qfile = strstr($Qfile,$text3, true);
		} else { $Qfile = strstr($Qfile,$text4, true); }	
	}
	
	//$Qfile = str_replace('Output:    Members:', '', $Qfile);		
	//i$Qfile = str_replace('Output:       ', '', $Qfile);
	print_r($Qfile);
}

//Info Peers
if ($type == "peer") {
	$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, 10);
	if (!$socket) {
		echo "$errstr ($errno)\n";
	} else {//Connection
		fputs($socket, "Action: Login\r\n");
		fputs($socket, "UserName: monitor\r\n");
		fputs($socket, "Secret: monitor@4dyln3t\r\n\r\n");
		fputs($socket, "Action: Command\r\n");
		fputs($socket, "Command: sip show peer $name\n\r\n");
		fputs($socket, "Action: Logoff\r\n\r\n");
		
		$file = fopen("/var/www/html/mtr/php/Pinfo.txt", "w+");	
		fwrite($file,'');
		while (!feof($socket)) {
			$return = fgets($socket);
			fwrite($file, $return."\r\n");
		}
	}
	fclose($file);
	fclose($socket);
	
	$text3 = "Status";
	$Pfile = file("/var/www/html/mtr/php/Pinfo.txt");
	$Pstatus = $Pfile[178];
	if (strpos($Pstatus,$text3) !== false){	
		$Pstatus = str_replace('Output:   Status       :', '', $Pstatus);
		print_r($Pstatus);
	
	}
}

?>
