<?php
	$sharedSecret = "pzsEqD5qGwhoh0orAs8ivNhh4b6ocFmc";
	$post = file_get_contents('php://input');
	$out=hash_hmac("sha256", $post, $sharedSecret);
	
	header('Content-Type: application/json');
	echo '{"signature":"'.$out.'"}';
?>