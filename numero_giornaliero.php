<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$file = "daily_numbers.json";
$today = date("Y-m-d");

// Se il file non esiste lo crea
if (!file_exists($file)) {
    $data = [
        "day" => $today,
        "num1" => str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT),
        "num2" => str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT)
    ];
    file_put_contents($file, json_encode($data));
}

// Legge i dati attuali
$data = json_decode(file_get_contents($file), true);

// Se è un nuovo giorno → genera nuovi numeri
if ($data["day"] !== $today) {
    $data["day"] = $today;
    $data["num1"] = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $data["num2"] = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    file_put_contents($file, json_encode($data));
}

// Risponde col JSON
echo json_encode([
    "num1" => $data["num1"],
    "num2" => $data["num2"]
]);
