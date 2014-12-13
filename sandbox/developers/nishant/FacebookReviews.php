<?php
include('simple_html_dom.php');

function addslashes_array($value, $key) {
    return addslashes($value);
}

/**
 *
 * This class scrapes the reviews from any facebook page that has review.
 * Class FacebookReviewsScrape
 */
class FacebookReviewsScrape {
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

		$facebookreview = $this->getFacebookReviews();
		
        return json_encode([
            'url' => $url,
			'facebook_reviews' => $facebookreview,
        ]);
    }
	
    private function getUsername($element) {
        foreach($element->find('a') as $a){
            // Get link to recommender's profile
            if(!empty($a->attr['href'])) {
                $href = ltrim($a->attr['href'], '/');
                $username = substr($href, 0, strpos($href, '/activity'));
                return $username;
            }
        }

        return "";
    }

	private function getFacebookReviews() {
        $result = [];
		if(!$this->html) { $this->html = file_get_html($this->url); }

        // Find all review
		$i=0;
		$stars=[];

        foreach($this->html->find('div.bj') as $element) {
            $name = $user_image = $text = $username = '';

            $elements = $element->find('span > text');
            $name = trim(strip_tags($elements[0]->plaintext));
            $text = trim(strip_tags($elements[2]->plaintext));

			foreach($element->find('img') as $img){
                $stars = [];

                // Get star rating
				$alttxt = html_entity_decode($img->alt);

				preg_match_all('!\d+!', $alttxt, $matches);
                if(isset($matches[0][0])) {
				    $st = $matches[0][0];
				    $stars[] = $st;
                }
			}
			
			// $d = trim($element->children(1)->children(0)->children(0)->children(0)->children(0)->innertext);
            if($stars) {
			    $t = $stars[0];
            } else {
                $t = "";
            }

            $username = $this->getUsername($element);

            $record = array(
                'user_name'     => $name,
                'rating'        => $t,
                'rank'        => $t,
                'text'          => $text,
                'user_picture'  => 'http://graph.facebook.com/'.$username.'/picture',
                'user_link'     => 'http://facebook.com/'.$username,
                'user_social_id' => $username
                // 'date'=>$d
            );

            array_walk($record, 'addslashes_array');
            $result[$i] = $record;
			$i++;
        }
        return $result;
    }
}

if(isset($_GET['url'])) {
    $url = urldecode($_GET['url']);
    // $url = 'https://m.facebook.com/MiamiXHairNailBar/reviews';
    $scraper = new FacebookReviewsScrape();
    echo ($scraper->getData($url));
    die;
}
