<?php
// router.php
$path = pathinfo($_SERVER["SCRIPT_FILENAME"]);
if ($path["extension"] == "xml") {
    header("Content-Type: text/xml");
    readfile($_SERVER["SCRIPT_FILENAME"]);
}
else if($path["extension"] == "zip"){
	$file = $_SERVER["SCRIPT_FILENAME"];
    if (file_exists($file)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        ob_clean();
        flush();
        readfile($file);
        exit;
    } 
}
// else if($path["extension"] == "php"){
// 	require $_SERVER['SCRIPT_FILENAME'];
//     exit;
// }
else{
    return false;
}