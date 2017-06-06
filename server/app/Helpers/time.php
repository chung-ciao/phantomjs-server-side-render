<?php

	if (!function_exists('timestamp_ms')) {
	    function timestamp_micro() {
	        $time = explode(' ', microtime());
	        $timestamp = $time[1].(integer)($time[0]*1000000);
	        return $timestamp;
	    }
	}