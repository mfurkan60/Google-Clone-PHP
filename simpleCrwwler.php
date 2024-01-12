<?php

class SimpleWebCrawler {

    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function crawl() {
        $html = file_get_contents($this->url);

        if ($html === false) {
            return false;
        }

        $dom = new DomDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $links = $dom->getElementsByTagName('a');

        $result = [];

        foreach ($links as $link) {
            $result[] = $link->getAttribute('href');
        }

        return $result;
    }
}

// Kullanım örneği:
$crawler = new SimpleWebCrawler('https://www.muglateknopark.com.tr');
$links = $crawler->crawl();

if ($links !== false) {
    echo "Bağlantılar:\n"; 
    echo "<br>";
    foreach ($links as $link) {
        echo $link . "\n";echo "<br>";
        
    }
} else {
    echo "Web sayfasına erişim sağlanamadı.";
}

?>
