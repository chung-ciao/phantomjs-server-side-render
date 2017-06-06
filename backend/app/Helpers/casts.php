<?php

	if (!function_exists('boolean2tinyint')) {
    function boolean2tinyint($data) {
      if($data == 'true' || $data == true) $result = 1;
      if($data == 'false' || $data == false) $result = 0;
      return $result;
    }
	}