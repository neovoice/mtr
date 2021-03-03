<?php
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

if ( $evt == "Newstate" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "PeerStatus" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "DeviceStateChange" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "ExtensionStatus" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "Hangup" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "QueueCallerJoin" ) {
echo "$evt"." "."$name"." "."$stats";
}

if ( $evt == "QueueCallerLeave" ) {
echo "$evt"." "."$name"." "."$stats";
}

?>
