<?php
$parts = glob(__DIR__ . '/keepote-src/*.b64');
sort($parts, SORT_NATURAL);
$b64 = '';
foreach ($parts as $part) {
    $b64 .= trim((string) file_get_contents($part));
}
$png = base64_decode($b64, true);
if ($png === false || strncmp($png, "\x89PNG\r\n\x1a\n", 8) !== 0) {
    http_response_code(500);
    exit('Invalid Keepote PNG');
}
header('Content-Type: image/png');
header('Cache-Control: public, max-age=31536000, immutable');
header('Content-Length: ' . strlen($png));
echo $png;
