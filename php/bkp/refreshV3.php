<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 

$peerstatus = file_get_contents('../json/PeersStatus.json');
$queuestatus = file_get_contents('../json/QueuesStatus.json');

$strp = str_replace(']]', ']',$peerstatus);
$strp = str_replace('[[','[',$strp);

//$strp = str_replace(']]','',$peerstatus);
//$strp = str_replace('[[','',$strp);
//$strp = str_replace('[','',$strp);
//$strp = str_replace(']','',$strp);

$strq = str_replace(']]', ']',$queuestatus);
$strq = str_replace('[[','[',$strq);

$dtpeers = json_decode($strp, true);
$dtqueues = json_decode($strq, true);

print_r($dtqueues);
//print_r($strq);

/*
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
