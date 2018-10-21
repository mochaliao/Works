<?php
/**
 * This is just an example of how a file could be processed from the
 * upload script. It should be tailored to your own requirements.
 */

// Only accept files with these extensions
$whitelist = array('jpg', 'jpeg', 'png', 'gif');
$name      = null;
$error     = '沒有檔案被上傳';
$uploads_dir = 'member_data/chat_files';

if (isset($_FILES)) {
	if (isset($_FILES['file'])) {
		$tmp_name = $_FILES['file']['tmp_name'];
		$name     = basename($_FILES['file']['name']);
		$error    = $_FILES['file']['error'];
		
		if ($error === UPLOAD_ERR_OK) {
			$extension = pathinfo($name, PATHINFO_EXTENSION);

			if (!in_array($extension, $whitelist)) {
				$error = 'Invalid file type uploaded.';
			} else {
				static $name = uniqid();
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
		}
	}
}

echo json_encode(array(
	'name'  => $name,
	'error' => $error,
));
die();
