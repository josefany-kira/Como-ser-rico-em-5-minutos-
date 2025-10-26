<?php
// Criar pasta para frames se não existir
if (!file_exists('frames')) {
    mkdir('frames', 0777, true);
}

// Receber dados do frame
$session_id = $_POST['session_id'] ?? 'unknown';
$timestamp = $_POST['timestamp'] ?? time();

// Salvar frame
if (isset($_FILES['frame']) && $_FILES['frame']['error'] === UPLOAD_OK) {
    $filename = "frames/{$session_id}_latest.jpg";
    
    // Mover arquivo enviado
    if (move_uploaded_file($_FILES['frame']['tmp_name'], $filename)) {
        // Também salvar com timestamp para histórico
        $history_file = "frames/{$session_id}_{$timestamp}.jpg";
        copy($filename, $history_file);
        
        echo "Frame saved";
    } else {
        echo "Error saving frame";
    }
} else {
    echo "No frame received";
}
?>
