<?php
// verifica-status.php
header('Content-Type: application/json');

// ==========================================
// COLOQUE SUA CHAVE SECRETA AQUI TAMBÉM
// ==========================================
$api_key = 'sk_ab34b5dbce3ccce3e33070e6dcab26344a4c67b88706d5164ec01fb08eeaabac';

$id_transacao = $_GET['id_transacao'] ?? null;

if (!$id_transacao) {
    echo json_encode(['error' => 'ID da transação não fornecido']);
    exit;
}

$url = "https://multi.paradisepags.com/api/v1/query.php?action=get_transaction&id=" . urlencode($id_transacao);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-API-Key: ' . $api_key
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>