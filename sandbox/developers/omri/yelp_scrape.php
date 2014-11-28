<?php
/**
 *
 * This class scrapes the reviews from any facebook page that has review.
 * Class Scrape
 */
class Scrape {

    private $response;
    private $respond;

     public function __construct(){
     }

     public function getResults($url){
         $this->response = $this->getHTML($url);

         $this->getDomObject();
     }

     /**
      * Returns the HTML section that need to be scraped
      * @param $url
      * @return DOMNodeList
      */
     private function getHTML($url){

         $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36';
//         $opts = array(
//             'http'=>array(
//                 'method'=>"GET",
//                 'user_agent'=>$userAgent
//             )
//         );
//         $context = stream_context_create($opts);
//         $response = file_get_contents($url, false, $context);


         $ch = curl_init();
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Accept-Encoding: gzip',
             'user_agent: '. $userAgent ,
             'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
             'Accept-Language: he,he-IL;q=0.8,en-US;q=0.5,en;q=0.3',
             'Connection: keep-alive',
             'Cookie: datr=zKR5U1BknSnDm0-bsatr-_MC; fr=0BRfA8jLgPEqghfSC.AWU8OVd_BqKAye1y39rqMKODEQw.BTkYc6.tn.FOp.AWXyf2q_; lu=TApjse2VsABYGSYhTAdU48rw; locale=en_US; reg_fb_gate=https%3A%2F%2Fwww.facebook.com%2F%3Fstype%3Dlo%26jlou%3DAffhU5y3JKC7OsceZgbucWDytBDeTeHEEaBeBRwe4zUvP8OgI_Be1np3ruWhRaqP9IpgGt3ZRrjgFKC0Sco89AXG%26smuh%3D58956%26lh%3DAc-2GUma-3fcgyYH; reg_fb_ref=https%3A%2F%2Fwww.facebook.com%2FPlaytimePizzaLR; noscript=1'
         ));
         curl_setopt($ch,CURLOPT_ENCODING , "gzip");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch, CURLOPT_URL,$url);
         $response=curl_exec($ch);
         curl_close($ch);
         return $response;
     }

    function getDomObject() {
        $dom = new DOMDocument();
        @$dom->loadHTML($this->response);
        $xpath     = new DOMXPath($dom);

        //1376899755889899
        $results = $xpath->query("//meta[@itemprop]");

        foreach ($results as $element) {
            echo 1;
        }
        return $results;
    }

    /**
      * returns User's name
      * @param $html
      * @return string
      */
     private function getname($html){

         $dom = new DOMDocument();
         @$dom->loadHTML($html);
         $xpath = new DOMXPath($dom);


        // $results = $xpath->query("//div[contains(@class, 'fwb')]");
         $results = $xpath->query('//strong/a');

         if($results->length == 0){
             $results = $xpath->query('//strong/span');
         }

         if($results->length == 0){
             $results = $xpath->query("//div[contains(@class, 'fsm fwn fcg')]");
         }


         foreach($results as $key=>$result){
             return strip_tags($result->c14n());

         }
     }

     /**
      * Returns content of the review message
      * @param $html
      * @return string
      */
     private function getreview($html){
         $dom = new DOMDocument();
         @$dom->loadHTML($html);
         $xpath = new DOMXPath($dom);

         // look for ranked review
         // $results = $xpath->query('//div[@class="text_exposed_root"]');
         $results = $xpath->query('(//span)[last()]');

         foreach($results as $key=>$result){
             // removes the last child that is "read more" link
             // $result->removeChild($result->lastChild);

             $review = strip_tags($result->c14n());

             return $review;
         }

         return "";
     }

     /**
      * returns timestamp of the review by UTC time
      * @param $html
      * @return mixed
      */
     private function gettimestamp($html){
         $dom = new DOMDocument();
         @$dom->loadHTML($html);
         $xpath = new DOMXPath($dom);

         $results = $xpath->query('//abbr[@title]');

         foreach($results as $key=>$result){
             $review = $result->getAttribute('data-utime');
             return $review;
         }
     }

     /**
      * Returns stars rating for the review
      * @param $html
      * @return int
      */
     private function getstars($html){
         $dom = new DOMDocument();
         @$dom->loadHTML($html);
         $xpath = new DOMXPath($dom);

         $results = $xpath->query('//i/u');

         foreach($results as $key=>$result){
             return $this->rescuestars($result->c14n());
         }
     }


     /**
      * Calculates the stars, its a helper function for the getstars
      * @param $txt
      * @return int
      */
     private function rescuestars($txt){

         $txt = trim(str_replace('star', '', strip_tags($txt)));
         return $txt;




         $tmp = explode(",", $txt);
         $size = (int) $tmp[1];

         return $size / 20;
//         $stars = 5;
//         if($size >= 65)
//             $stars = 5;
//         else if($size >= 52 && $size < 64)
//             $stars = 4;
//         else if($size >= 40 && $size < 54)
//             $stars = 3;
//         else if($size >= 26 && $size < 40)
//             $stars = 2;
//         if($size < 26)
//             $stars = 1;
//
//         return $stars;
     }

     /**
      * Returns users ID
      * @param $html
      * @return int
      */
     private function getuserid($html){
         $dom = new DOMDocument();
         @$dom->loadHTML($html);
         $xpath = new DOMXPath($dom);

         $results = $xpath->query('//input[@name="feedback_params"]');

         foreach($results as $key=>$result){

             $basicinfo = json_decode($result->getAttribute('value'));

             // we can also get the timestamp from here by using $basicinfo->content_timestamp, its good to know for backup if the other function fails.
             return (int) $basicinfo->actor;
         }
     }

     /**
      * Returns users image
      * @param $uid
      * @return string
      */
     private function getuserimage($uid){
         $imageurl = "http://graph.facebook.com/". $uid ."/picture";
         return $imageurl;
     }

 }

$page_id = $_GET['page_id'];
$scraper = new Scrape();
$url = "http://www.yelp.com/biz/rouge-nails-and-spa-rego-park";
echo json_encode([
    'page_id' => $page_id,
    'result' => $scraper->getResults($url)
]);
