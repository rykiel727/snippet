<?php
/* ---------------------------------------------------------------------------
 ファイルサイズ取得
--------------------------------------------------------------------------- */
function DownloadSize($filename) {
	$file = $_SERVER["DOCUMENT_ROOT"] . $filename;
	if (file_exists($file)) {
		$size = filesize($file);
		$sizes = Array('バイト', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
		$ext = $sizes[0];
		for ($i=1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
			$size = $size / 1024;
			$ext = $sizes[$i];
		}
		return round($size, 2).$ext;
	} else {
		return '';
	}
}