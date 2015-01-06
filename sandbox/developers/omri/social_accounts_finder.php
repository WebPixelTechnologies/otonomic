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

class GoogleSearchScrape {
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

        $data = $this->getSiteUrl();

        return json_encode([
            'url' => $url,
            'results' => $data,
        ]);
    }

    private function getSiteUrl() {
        $result = [];

        if(!$this->html) { $this->html = file_get_html($this->url); }

        foreach($this->html->find('cite') as $element) {
            $keys = $element->find('text');
            $values = $element->find('b');

            if($keys && $values) {
                $key = $keys[0]->innertext;
                $value = $element->plaintext;
                $value = str_replace($key, '', $value);
                $result[$key] = $value;
            }
        }
        array_walk($result, 'addslashes_array');

        return $result;
    }
}


// $url = $_GET['url'];
$url = 'https://www.google.com/search?q='.rawurlencode($_GET['q']).'&gbv=1&num=20&gws_rd=cr&ei=3UGoVL-qDIKtUaGtgKgL';
$scraper = new GoogleSearchScrape();
echo ($scraper->getData($url));
