<?php
$url = "https://httpbin.org/get";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
if ($output === FALSE) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo $output;
}
curl_close($ch);
?>
