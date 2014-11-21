<?php

Class FbSearch {
    var $country_phone_prefix = array(
        "Uzbekistan" => "998",
        "Kyrgyzstan" => "996",
        "Georgia" => "995",
        "Azerbaijan" => "994",
        "Turkmenistan" => "993",
        "Tajikistan" => "992",
        "Iran" => "98",
        "Nepal" => "977",
        "Mongolia" => "976",
        "Bhutan" => "975",
        "Qatar" => "974",
        "Bahrain" => "973",
        "Israel" => "972",
        "United Arab Emirates" => "971",
        "Gaza Strip" => "970",
        "West Bank" => "970",
        "Oman" => "968",
        "Yemen" => "967",
        "Saudi Arabia" => "966",
        "Kuwait" => "965",
        "Iraq" => "964",
        "Syria" => "963",
        "Jordan" => "962",
        "Lebanon" => "961",
        "Maldives" => "960",
        "Burma (Myanmar)" => "95",
        "Sri Lanka" => "94",
        "Afghanistan" => "93",
        "Pakistan" => "92",
        "India" => "91",
        "Turkey" => "90",
        "Taiwan" => "886",
        "Bangladesh" => "880",
        "Pitcairn Islands" => "870",
        "China" => "86",
        "Laos" => "856",
        "Cambodia" => "855",
        "Macau" => "853",
        "Hong Kong" => "852",
        "North Korea" => "850",
        "Vietnam" => "84",
        "South Korea" => "82",
        "Japan" => "81",
        "Kazakhstan" => "7",
        "Russia" => "7",
        "Marshall Islands" => "692",
        "Micronesia" => "691",
        "Tokelau" => "690",
        "French Polynesia" => "689",
        "Tuvalu" => "688",
        "New Caledonia" => "687",
        "Kiribati" => "686",
        "Samoa" => "685",
        "Niue" => "683",
        "Cook Islands" => "682",
        "Wallis and Futuna" => "681",
        "Palau" => "680",
        "Fiji" => "679",
        "Vanuatu" => "678",
        "Solomon Islands" => "677",
        "Tonga" => "676",
        "Papua New Guinea" => "675",
        "Nauru" => "674",
        "Brunei" => "673",
        "Antarctica" => "672",
        "Norfolk Island" => "672",
        "Timor-Leste" => "670",
        "Thailand" => "66",
        "Singapore" => "65",
        "New Zealand" => "64",
        "Philippines" => "63",
        "Indonesia" => "62",
        "Australia" => "61",
        "Christmas Island" => "61",
        "Cocos (Keeling) Islands" => "61",
        "Malaysia" => "60",
        "Netherlands Antilles" => "599",
        "Uruguay" => "598",
        "Suriname" => "597",
        "Paraguay" => "595",
        "Ecuador" => "593",
        "Guyana" => "592",
        "Bolivia" => "591",
        "Saint Barthelemy" => "590",
        "Venezuela" => "58",
        "Colombia" => "57",
        "Chile" => "56",
        "Brazil" => "55",
        "Argentina" => "54",
        "Cuba" => "53",
        "Mexico" => "52",
        "Peru" => "51",
        "Haiti" => "509",
        "Saint Pierre and Miquelon" => "508",
        "Panama" => "507",
        "Costa Rica" => "506",
        "Nicaragua" => "505",
        "Honduras" => "504",
        "El Salvador" => "503",
        "Guatemala" => "502",
        "Belize" => "501",
        "Falkland Islands" => "500",
        "Germany" => "49",
        "Poland" => "48",
        "Norway" => "47",
        "Sweden" => "46",
        "Denmark" => "45",
        "Isle of Man" => "44",
        "United Kingdom" => "44",
        "Austria" => "43",
        "Liechtenstein" => "423",
        "Slovakia" => "421",
        "Czech Republic" => "420",
        "Switzerland" => "41",
        "Romania" => "40",
        "Italy" => "39",
        "Holy See (Vatican City)" => "39",
        "Macedonia" => "389",
        "Bosnia and Herzegovina" => "387",
        "Slovenia" => "386",
        "Croatia" => "385",
        "Montenegro" => "382",
        "Kosovo" => "381",
        "Serbia" => "381",
        "Ukraine" => "380",
        "San Marino" => "378",
        "Monaco" => "377",
        "Andorra" => "376",
        "Belarus" => "375",
        "Armenia" => "374",
        "Moldova" => "373",
        "Estonia" => "372",
        "Latvia" => "371",
        "Lithuania" => "370",
        "Hungary" => "36",
        "Bulgaria" => "359",
        "Finland" => "358",
        "Cyprus" => "357",
        "Malta" => "356",
        "Albania" => "355",
        "Iceland" => "354",
        "Ireland" => "353",
        "Luxembourg" => "352",
        "Portugal" => "351",
        "Gibraltar" => "350",
        "Spain" => "34",
        "France" => "33",
        "Belgium" => "32",
        "Netherlands" => "31",
        "Greece" => "30",
        "Greenland" => "299",
        "Faroe Islands" => "298",
        "Aruba" => "297",
        "Eritrea" => "291",
        "Saint Helena" => "290",
        "South Africa" => "27",
        "Comoros" => "269",
        "Swaziland" => "268",
        "Botswana" => "267",
        "Lesotho" => "266",
        "Malawi" => "265",
        "Namibia" => "264",
        "Zimbabwe" => "263",
        "Mayotte" => "262",
        "Madagascar" => "261",
        "Zambia" => "260",
        "Mozambique" => "258",
        "Burundi" => "257",
        "Uganda" => "256",
        "Tanzania" => "255",
        "Kenya" => "254",
        "Djibouti" => "253",
        "Somalia" => "252",
        "Ethiopia" => "251",
        "Rwanda" => "250",
        "Sudan" => "249",
        "Seychelles" => "248",
        "Guinea-Bissau" => "245",
        "Angola" => "244",
        "Democratic Republic of the Congo" => "243",
        "Republic of the Congo" => "242",
        "Gabon" => "241",
        "Equatorial Guinea" => "240",
        "Sao Tome and Principe" => "239",
        "Cape Verde" => "238",
        "Cameroon" => "237",
        "Central African Republic" => "236",
        "Chad" => "235",
        "Nigeria" => "234",
        "Ghana" => "233",
        "Sierra Leone" => "232",
        "Liberia" => "231",
        "Mauritius" => "230",
        "Benin" => "229",
        "Togo" => "228",
        "Niger" => "227",
        "Burkina Faso" => "226",
        "Ivory Coast" => "225",
        "Guinea" => "224",
        "Mali" => "223",
        "Mauritania" => "222",
        "Senegal" => "221",
        "Gambia" => "220",
        "Libya" => "218",
        "Tunisia" => "216",
        "Algeria" => "213",
        "Morocco" => "212",
        "Egypt" => "20",
        "Canada" => "1",
        "Puerto Rico" => "1",
        "United States" => "1",
        "Jamaica" => "1 876",
        "Saint Kitts and Nevis" => "1 869",
        "Trinidad and Tobago" => "1 868",
        "Dominican Republic" => "1 809",
        "Saint Vincent and the Grenadines" => "1 784",
        "Dominica" => "1 767",
        "Saint Lucia" => "1 758",
        "American Samoa" => "1 684",
        "Guam" => "1 671",
        "Northern Mariana Islands" => "1 670",
        "Montserrat" => "1 664",
        "Turks and Caicos Islands" => "1 649",
        "Saint Martin" => "1 599",
        "Grenada" => "1 473",
        "Bermuda" => "1 441",
        "Cayman Islands" => "1 345",
        "US Virgin Islands" => "1 340",
        "British Virgin Islands" => "1 284",
        "Antigua and Barbuda" => "1 268",
        "Anguilla" => "1 264",
        "Barbados" => "1 246",
        "Bahamas" => "1 242",
        "British Indian Ocean Territory" => "",
        "Jersey" => "",
        "Svalbard" => "",
        "Western Sahara" => ""
    );

    /*
    var $columns = array(
        'Keyword',
        '#',
        'Name',
        'Phone',
        'Country',
        'Country code',
        'City',
        'Category',
        'Likes',
        'Talking about',
        'Facebook Page',
    	'P2S Website'
    );
*/
    var $columns = array(
        'Keyword',
        '#',
        'Name',
        'Phone',
        'Website',
        'Country',
        'Phone code',
        'City',
        'Category',
        'Sub Category',
        'Likes',
        'Talking about',
        'Facebook ID',
        'Facebook Url',
        'Facebook Page Link',
        'Oto Website',
        'Community Page',
        'Parent Page',
        'Has Website'
    );

    var $csv_file;

    function __construct($keywords = null) {
        $this->keywords = $keywords;
    }

    function run() {
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 600000); //increase max_execution_time to 10 min if data set is very large

        $keywords = $this->get_keywords();

        $filename = isset($_GET['filename']) ? $_GET['filename'] : 'p2s_leads.csv';

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        //header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$filename}");
        header("Expires: 0");
        header("Pragma: public");

        echo "\xEF\xBB\xBF"; // UTF-8 BOM

        $this->csv_file = fopen('php://output', 'a');

        // fputcsv($this->csv_file, $this->columns, ',', '"');
        fputcsv($this->csv_file, $this->columns, "\t", '"');

        foreach($keywords as $keyword) {
            if(!trim($keyword)) { continue;}
            $data = $this->return_keyword_results($keyword);
            $this->append_data_to_csv($data);
        }

        fclose($this->csv_file);
    }

    private function clearDataFolder(){
        $files = glob('.\\tmp\\data\\*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
    }

    private function generateCSVFile($keyword, $synonym){
        $filename = $keyword.'__'.str_replace(' ', '_', $synonym).'_batch.csv';
        try{
            if (file_exists('tmp\\data\\' . $filename))
                $fh = fopen('tmp\\data\\' .$filename, 'a');
            else{
                $fh = fopen('tmp\\data\\' .$filename, 'w');
                // fputcsv($fh, $this->columns, ',', '"');
                fputcsv($fh, $this->columns, "\t", '"');
            }
            fclose($fh);

            return $filename;
        } catch(Exception $ex){
            fclose($fh);
            echo $ex->getMessage();die();
        }
    }

    private function writeToFile($filename, $words){
        try{
            $fh = fopen('tmp\\data\\' .$filename, 'a');
            fputcsv($fh, $words, "\t");
            fclose($fh);
        } catch(Exception $ex){
            fclose($fh);
            echo $ex->getMessage();die();
        }
    }


    public function initialize(){
        // $this->clearDataFolder();
    }

    public function createBatchFiles($keywords, $filename = null, $additional_fields = []){
        try{
            foreach($keywords as $key => $keyword) {
                if(!trim($keyword)) { continue;}
                $result = $this->return_keyword_results($keyword, $additional_fields);

                if(!$filename) {
                    $filename = $this->generateCSVFile($key, $keyword);
                }

                foreach($result as $record) {
                    $this->writeToFile($filename, $record);
                }
            }
        }catch (Exception $ex){
            echo $ex->getMessage();die();
        }
    }

    public function createBatchFile($keyword, $synonym, $filename = null, $additional_fields = [], $additional_data){
        try{

            if(!$filename) {
                $filename = $this->generateCSVFile($keyword, $synonym);
            }

            $result = $this->return_keyword_results($synonym, $additional_fields);

            foreach($result as $record) {
                $this->writeToFile($filename, $record);
            }

            return array('file' => $filename, 'data_count' => count($result));

        } catch (Exception $ex) {
            echo $ex->getMessage(); die();
        }
    }

    public function Zip($source, $destination) {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file)
            {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;

                //$file = realpath($file);

                if (is_dir($file) === true)
                {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }
                else if (is_file($file) === true)
                {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }

    function get_keywords() {
        return $this->keywords;
    }

    function append_data_to_csv($data) {
        if(!$data) { return; }
        foreach($data as $record) {
            $record = array_map( "nl2br", $record);
            // fputcsv($this->csv_file, $record, ',', '"');
            fputcsv($this->csv_file, $record, "\t", '"');
        }
    }

    function return_keyword_results($keyword, $additional_fields = [], $additional_data = "") {
        $max_num_results = 2000;
        $fb_results = $this->get_fb_results($keyword, $additional_data, $max_num_results);
        if(!is_array($fb_results)) { return false;}

        $result = array();
        $ii = 0;

        foreach($fb_results as $page):
            $arr = array($keyword, $ii);
            $arr = array_merge($arr, $additional_fields);
//            if(empty($page->website) && !empty($page->phone)) {

            $record_arr = $this->get_record($page);

            if($record_arr) {
                $arr = array_merge(
                    $arr,
                    $record_arr
                );

                $result[] = $arr;
                $ii++;
            }
        endforeach;

        return $result;
    }

    function get_record($data) {
        $temp = new stdClass();
        if(empty($data->location->country)) {
            $temp->country = '';
            $data->location = $temp;
        }
        if(empty($data->location->city)) {
            $temp->city = '';
            $data->location = $temp;
        }

        if(empty($data->likes)) {
            $data->likes = '';
        }
        if(empty($data->talking_about_count)) {
            $data->talking_about_count = '';
        }
        if(empty($data->category_list)) {
            $data->category_list = '';
        }
        if(is_array($data->category_list)) {
            $data->category_list = json_encode($data->category_list);
        }
        if(empty($data->phone)) {
            $data->phone = '';
        }
        if(empty($data->website)) {
            $data->website = '';
        }
        if(!empty($data->cover)) {
            $data->cover = json_encode($data->cover);
        } else {
            $data->cover = "";
        }
        $data->parent_page = empty($data->parent_page) ? "" : json_encode($data->parent_page->id);

        // Ignore community pages
        if(!empty($data->is_community_page)) {
            return false;
        }
        // Ignore pages with a parent page
        if($data->parent_page) {
            return false;
        }

        return array(
            $data->name,
            $data->phone,
            str_replace(array("\r", "\n"), ' ', $data->website),
            $data->location->country,
            $this->get_country_phone_prefix($data->location->country),
            $data->location->city,
            $data->category,
            $data->category_list,
            $data->likes,
            $data->talking_about_count,
            $data->id,
            "http://www.facebook.com/".$data->id,
            '=HYPERLINK("http://www.facebook.com/'.$data->id.'/?sk=info", "'.$data->id.'")',
            '=HYPERLINK("http://wp.otonomic.com/migration/index?page_id='.$data->id.'", "Create")',
            isset($data->is_community_page) ? $data->is_community_page : 0,
            $data->parent_page,
            empty($data->website) ? "" : 1,
            $data->cover
        );
    }

    function get_country_phone_prefix($country) {
        return isset($this->country_phone_prefix[$country]) ? $this->country_phone_prefix[$country] : '';
    }

    function get_fb_results($keyword, $latlong, $num_results = 0) {
        $access_token = '389314351133865|O4FgcprDMY0k6rxRUO-KOkWuVoU';
        $limit = 100;
        $url = 'https://graph.facebook.com/search/?q='.urlencode($keyword).'&type=location&center='.$latlong.'distance=50000&access_token='.$access_token.
            '&fields=id,name,username,category,category_list,likes,website,phone,location,talking_about_count,is_community_page,parent_page,cover&limit='.$limit;
        $response = json_decode(file_get_contents($url));
        $result = $response->data;

        while($num_results > $limit && !empty($response->paging->next)) {
            $num_results -= $limit;
            $url = $response->paging->next;
            $response = json_decode(file_get_contents($url));
            $result = array_merge($result, $response->data);
        }
        return $result;
    }
}

function makeclickable($str, $link_text = null) {
    if(!$link_text) { $link_text = $str; }
    return '=HYPERLINK("'.$str.'", "'.$link_text.'")';
}
?>