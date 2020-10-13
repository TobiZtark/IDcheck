<?php

	function to_up($data){

		$data = strtoupper($data);
		return $data;
	}

 $dispatch = to_up(substr(base_convert(md5(67123456789), 16,32), 0, 12));
 echo $dispatch;

?>