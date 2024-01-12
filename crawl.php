<?php
include("classes/DomDocumentParser.php");

function createLink($src, $url) {
		// echo "SRC: $src"; 
		// echo "<br>";
		// echo "URL : $url";
		
}

function followLinks($url) {

	$parser = new DomDocumentParser($url);

	$linkList = $parser->getLinks();

	foreach($linkList as $link) {
		$href = $link->getAttribute("href");

		if(strpos($href, "#") !== false) {
			continue;
		}
		else if(substr($href, 0, 11) == "javascript:") {
			continue;
		}


		createLink($href, $url);


		echo $href . "<br>";
	}

}

$startUrl = "https://www.muglateknopark.com.tr/";
followLinks($startUrl);
?>