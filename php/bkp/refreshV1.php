<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 

$peerstatus = file_get_contents('../json/PeersStatus.json');
$queuestatus = file_get_contents('../json/QueuesStatus.json');

$datapeers = json_decode($peerstatus, true);
$dataqueues = json_decode($queuestatus, true);

//print_r($dataqueues);

if (is_array($datapeers)) {
	foreach ($datapeers as $key => $etr) {
		$peername = $datapeers[$key]['Peer'];
		$peerstats =  $datapeers[$key]['Status'];
		$peerdnd = $datapeers[$key]['DND'];
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

if (is_array($datapeers)) {
	foreach ($dataqueues as $key => $etr) {
		$queuename = $dataqueues[$key]['Queue'];
		$queuecount = $dataqueues[$key]['Count'];
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
?>
