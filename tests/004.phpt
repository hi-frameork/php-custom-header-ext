--TEST--
验证获取从请求 Header 中过去灰度标识字段

--FILE--
<?php

require __DIR__ . '/stub_server.inc';

$hostname = 'localhost';
$port     = '5678';

stub_cli_server_start($hostname, $port,  'stub_route_label.inc');

$url      = 'http://' . $hostname . ':' . $port;
$trace_id = 'xe-tag-001';

$headers = [
    "Xe-Tag: $trace_id",
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 500);
curl_exec($ch);
curl_close($ch);
?>
--EXPECT--
xe-tag-001