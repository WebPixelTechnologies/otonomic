<?php
/**
 *
 * This class scrapes the reviews from any facebook page that has review.
 * Class YelpScrape
 */
include('simple_html_dom.php');

function addslashes_array($value, $key) {
    return addslashes($value);
}

class YelpScrape {
    var $url;

     public function __construct(){
     }

    function getReviews($url) {
        if(!$url) { return ""; }
        if($this->url == $url) {
            die; // Weird bug causes it to rerun - die so we don't have infinite loop
        }
        $this->url = url;

        $html = file_get_html($url);

        $result = [];

        // Find all links
        foreach($html->find('div.review') as $element) {
            $record = [];
            $meta_elements = $element->find('meta');

            foreach($meta_elements as $meta) {
                $key = $meta->itemprop;
                $value = $meta->content;
                $record[$key] = $value;
            }

            $text_containers = $element->find('p');
            foreach($text_containers as $text_container) {
                if ($text_container->itemprop == "description") {
                    $record['text'] = $text_container->innertext;
                    break;
                }
            }

            array_walk($record, 'addslashes_array');
            $result[] = $record;
        }

        return $x = 0;
    }
}




$url = $_GET['url'];
$scraper = new YelpScrape();
print_r($scraper->getReviews($url));

/*
echo json_encode([
    'url' => $url,
    'result' => $scraper->getResultsHtml($url)
]);
die; exit;
*/