<?php
/**
 *
 * This class scrapes the reviews from any facebook page that has review.
 * Class FacebookScrape
 */
include('simple_html_dom.php');

function addslashes_array($value, $key) {
    return addslashes($value);
}

class FacebookScrape {
    public $url = null;
    public $html;

     public function __construct() {
     }

    function getData($url) {
        if(!$url) { return ""; }

        if($this->url == $url) {
            die; // Weird bug causes it to rerun - die so we don't have infinite loop
        }
        $this->url = $url;

        $this->html = file_get_html($url);

        $reviews = $this->getReviews();

        return json_encode([
            'url' => $url,
            'reviews' => $reviews,
        ]);
    }

    private function getReviews() {
        $result = [];

        if(!$this->html) { $this->html = file_get_html($this->url); }

        // Find all links
        foreach($this->html->find('div.bw') as $element) {
            $record = [];
            $review_images = $element->find('img');

            foreach($review_images as $review_image) {
                $stars = $review_image->alt;
            }

            $text_containers = $element->find('p');
            foreach($text_containers as $text_container) {
                if ($text_container->itemprop == "description") {
                    $record['text'] = $text_container->innertext;
                    break;
                }
                array_walk($record, 'addslashes_array');
                $result[] = $record;
            }
        }

        return $result;
    }
}


$url = $_GET['url'];
$scraper = new FacebookScrape();
print_r($scraper->getData($url));
