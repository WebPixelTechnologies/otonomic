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
        $from_owner = $this->getTextFromOwner();

        return json_encode([
            'url' => $url,
            'reviews' => $reviews,
            'from_owner' => $from_owner
        ]);
    }

    private function getReviews() {
        $result = [];

        if(!$this->html) { $this->html = file_get_html($this->url); }

        // Find all links
        foreach($this->html->find('div.review') as $element) {
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
                array_walk($record, 'addslashes_array');
                $result[] = $record;
            }
        }

        return $result;
    }

    private function getTextFromOwner() {
        $result = [];

        if(!$this->html) { $this->html = file_get_html($this->url); }

        // Find all links
        foreach($this->html->find('div.from-biz-owner-content') as $element) {
            $record = trim($element->innertext);
            $result[] = $record;
        }
        array_walk($result, 'addslashes_array');

        return $result;
    }
}


$url = $_GET['url'];
$scraper = new YelpScrape();
print_r($scraper->getData($url));