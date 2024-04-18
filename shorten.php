<?php
require_once './classes/UrlShortener.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $originalURL = $data['url'];

    $shortnener = new UrlShortener();
    $shortURL = $shortnener->shorten($originalURL);

    echo json_encode(['shortURL' => $shortURL]);
}
