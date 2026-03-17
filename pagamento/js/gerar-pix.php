<?php
// gerar-pix.php
header('Content-Type: application/json');

// ==========================================
// COLOQUE SUA CHAVE SECRETA AQUI
// ==========================================
$api_key = 'sk_ab34b5dbce3ccce3e33070e6dcab26344a4c67b88706d5164ec01fb08eeaabac'; 

// Recebe os dados enviados pelo JavaScript
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(['error' => 'Nenhum dado recebido']);
    exit;
}

// Inicia o cURL para a API da Paradise
$ch = curl_init('https://multi.paradisepags.com/api/v1/transaction.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-API-Key: ' . $api_key,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Retorna a resposta da Paradise de volta para o seu HTML
http_response_code($http_code);
echo $response;
?>