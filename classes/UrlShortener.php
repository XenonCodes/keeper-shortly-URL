<?php

class UrlShortener
{
    private $PDO;

    public function __construct()
    {
        $this->PDO = new PDO('sqlite:database.db');
        // Устанавливается режим исключений (exceptions mode), который означает, что PDO будет выбрасывать исключения при возникновении ошибок в запросах.
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->PDO->exec('CREATE TABLE IF NOT EXISTS urls (id INTEGER PRIMARY KEY AUTOINCREMENT, original_url TEXT, short_url TEXT)');
    }

    public function shorten($originalURL)
    {
        $stmt = $this->PDO->prepare('SELECT short_url FROM urls WHERE original_url = ?');
        $stmt->execute([$originalURL]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['short_url'];
        } else {
            $shortURL = $this->generationShotURL();
            $stmt = $this->PDO->prepare('INSERT INTO urls (original_url, short_url) VALUES(?, ?)');
            $stmt->execute([$originalURL, $shortURL]);
            return $shortURL;
        }
    }

    private function generationShotURL()
    {
        return substr(md5(uniqid(rand(), true)), 0, 8);
    }

    public function getOriginalURL($shortURL)
    {
        $stmt = $this->PDO->prepare('SELECT original_url FROM urls WHERE short_url = ?');
        $stmt->execute([$shortURL]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['original_url'];
        } else {
            return false;
        }
    }
}
