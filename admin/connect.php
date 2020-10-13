<?php
$conn = oci_connect('n', 'Stardawn3000', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	exit;
}
else {
}

?>