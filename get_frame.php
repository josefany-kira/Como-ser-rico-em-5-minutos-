<?php
header('Content-Type: application/json');

$session_id = $_GET['session_id'] ?? 'default';
$frame_file = "frames/{$session_id}_latest.jpg";

if (file_exists($frame_file)) {
    $image_data = base64_encode(file_get_contents($frame_file));
    echo json_encode([
        'status' => 'success',
        'frame' => $image_data,
        'timestamp' => filemtime($frame_file)
    ]);
} else {
    echo json_encode([
        'status' => 'no_frame',
        'message' => 'No frame available'
    ]);
}
?>
