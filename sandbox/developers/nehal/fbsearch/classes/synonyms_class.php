<?php
class Synonyms{

    private $upload_dir = 'tmp/upload/';
    private $file_dir = 'tmp/';

    private $csv_file;

    function __construct(){

    }

    private function parse_keywords($keywords = array()){
        if(empty($keywords))
            return array();

        if(($key = array_search('NOUNS', $keywords)) !== false) {
            unset($keywords[$key]);
        }

        if(($key = array_search('VERBS', $keywords)) !== false) {
            unset($keywords[$key]);
        }

        return array($keywords[0] => array_unique($keywords));
    }

    function read_csv($csv_file = NULL){
        if(!$csv_file)
            return false;

        $result = array();

        $file = $this->upload_dir . $csv_file;
        try{
            $fh= fopen($file,"r");
            while(!feof($fh))
            {
                $keywords =fgetcsv($fh);
                if(empty($keywords))
                    continue;

                $data = $this->parse_keywords($keywords);

                $result = array_merge($result, $data);

            }
            fclose($fh);

        }catch (Exception $ex){
            fclose($fh);
            return false;
        }

        return $result;
    }

    function generate_csv($keyword, $data){

    }

    function create_bundle(){

    }
}