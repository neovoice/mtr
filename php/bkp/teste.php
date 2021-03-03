<?php
$evt = "Newstate" ;
$name = "1001";
$stats = "Registered";

if ( $evt == "Newstate" ) {
$PeersAdylnet = file_get_contents('../json/PeersStatus.json');
$data = json_decode($PeersAdylnet, true);

foreach ($data as $key => $entry) {
	if($entry['Peer'] == $name ) {
		$data[$key]['Status'] = $stats;
		echo $entry['Peer'];
		echo "\n";
		echo  $data[$key]['Status'];
		echo "\n";
	}
    }
    $newJsonString = json_encode($data);
    file_put_contents('../json/PeersStatus.json', $newJsonString);  
}


?>
