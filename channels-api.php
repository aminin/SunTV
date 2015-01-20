<?php

$data = "";

$url = "http://u1.st65.ru/tv/playlist.xml?fastVideo=true&deviceclass=31&platformclass=15&brand=SunTV";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

$xml = simplexml_load_string($data);
// $json = json_encode($xml, JSON_PRETTY_PRINT);
// echo '<pre>'.$json.'</pre>';

echo '(function () { "use strict"' . "\r\n";
echo 'window.App.videos = [' . "\r\n";

$sessionid= $xml->define[0]['value'];
	
$count = count($xml->channel);
for ($i = 1; $i < $count; $i++)
{
	echo '{' . "\r\n";
	echo '"title": "' . (string)$xml->channel[$i - 1]->name . '",' . "\r\n";
	echo '"url": "' . str_replace(['iphone', '$S$'], ['http', ''], $xml->channel[$i - 1]->url) . "&notadaptive=true&tsremux=true&$sessionid" . '",' . "\r\n";
	echo '"type": "hls"' . "\r\n}";
	echo ($i < $count - 1 ? "," : "") . "\r\n";
}

echo '];';
echo '})();';