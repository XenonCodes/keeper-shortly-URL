<?php
require_once './classes/UrlShortener.php';
if (isset($_SERVER['REQUEST_URI'])) {
    $shortURL = trim($_SERVER['REQUEST_URI'], '/');

    if (!empty($shortURL)) {
        $shorten = new UrlShortener();
        $originalURL = $shorten->getOriginalURL($shortURL);

        if ($originalURL) {
            header("Location: $originalURL");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div>
        <h1>URL Shortener</h1>
        <form id="shortenForm">
            <input type="text" id="url" name="url" placeholder="Введите ссылку для сокращения">
            <button type="submit">Сократить</button>
        </form>
        <div>
            Ваша короткая ссылка: <span id="shortenedUrl"></span>
        </div>
    </div>
    <script src="./assets/js/main.js"></script>
</body>

</html>