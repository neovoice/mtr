<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 

$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');

$dtqueues = json_decode($queuestatus, true);
$dtpeers = json_decode($peerstatus, true);

//Fixed Error JSON
//$statusDtPeer = var_dump($dtpeers);
//$statusDtQueue = var_dump($dtqueues);
//$statusDtQueue = var_dump(empty($dtqueues)); 
//echo $statusDtQueue;
//if ($statusDtPeer == 'NULL')  {	
//	shell_exec('cp /var/www/html/mtr/json/PeersStatusTemplate.json /var/www/html/mtr/json/PeersStatus.json');
//	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
//	$dtpeers = json_decode($peerstatus, true);
//}

//if (is_null($statusDtQueue) !== false){
if ($dtqueues == ''){
//	shell_exec('cp /var/www/html/mtr/json/QueuesStatusTemplate.json /var/www/html/mtr/json/QueuesStatus.json');
//	$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
//	$dtqueues = json_decode($queuestatus, true);
	echo "QUEUESTATUS ATUALIZADO\n";
}

/*
//CODE
if (is_array($dtpeers)) {
	foreach ($dtpeers as $key => $etr) {
		$peername = $dtpeers[$key]['Peer'];
		$peerstats =  $dtpeers[$key]['Status'];
		$peerdnd = $dtpeers[$key]['DND'];
		$datap = array(
			"evento"=>"peerstatus",
			"peer"=>"$peername",
			"status"=>"$peerstats",
			"dnd"=>"$peerdnd"
		);
		$strp = json_encode($datap);
		echo "data: {$strp}\n\n";
		flush();
	}

}

if (is_array($dtqueues)) {
	foreach ($dtqueues as $key => $etr) {
		$queuename = $dtqueues[$key]['Queue'];
		$queuecount = $dtqueues[$key]['Count'];
		$dataq = array(
			"evento"=>"queuestatus",
			"queue"=>"$queuename",
			"count"=>"$queuecount"
		);
		$strq = json_encode($dataq);
		echo "data: {$strq}\n\n";
		flush();
	
	}
}
*/
?>
