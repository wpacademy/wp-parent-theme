<?php

	/**
	 * Check if a remote file exists.
	 * Source: http://goo.gl/aZ1h8v
	 * @param $url
	 * @return bool
	 */
	function remoteFileExists($url) {
		$file_headers = @get_headers($url);
		if ($file_headers[0] == 'HTTP/1.0 404 Not Found') {
			return false;
		}
		return true;
	}