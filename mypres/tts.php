<?php
header('Content-Type: application/json');
require("../konek/koneksi.php");
require("../konek/function.php");
require("../konek/crud.php");

if (!isset($_GET['text']) || trim($_GET['text']) == '') {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter text diperlukan']);
    exit;
}

$text_raw = trim($_GET['text']);
$text = urlencode($text_raw);
$lang = 'id'; // Bahasa Indonesia

$url = "https://translate.google.com/translate_tts?ie=UTF-8&q=$text&tl=$lang&client=tw-ob";

$options_http = [
    "http" => [
        "header" => "User-Agent: Mozilla/5.0\r\n"
    ]
];

$context = stream_context_create($options_http);
$audio = file_get_contents($url, false, $context);

if ($audio === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil audio TTS']);
    exit;
}

$folder = __DIR__ . '/tts_files/';
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$fileName = 'tts_' . time() . '_' . rand(1000,9999) . '.mp3';
$filePath = $folder . $fileName;

file_put_contents($filePath, $audio);

// Simpan ke database MySQLi dengan prepared statement
$stmt = $koneksi->prepare("INSERT INTO tts_files (text_input, filename) VALUES (?, ?)");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare statement gagal: ' . $koneksi->error]);
    exit;
}
$stmt->bind_param("ss", $text_raw, $fileName);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal simpan ke database: ' . $stmt->error]);
    exit;
}

$stmt->close();
$$koneksi->close();

echo json_encode([
    'file' => 'tts_files/' . $fileName,
    'text' => $text_raw,
    'status' => 'success'
]);
?>