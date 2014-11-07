<?php

class Flickr{

    private $base_url = 'http://api.flickr.com/services/rest/';

    private $api_key = '4e43bae16da5393e3177e8c20ae517a4';

    private $image_sizes = array(
        'S'     => '_s',        //square
        'LS'    => '_q',        //large square
        "TH"    => '_t',        //thumbnail
        "SM"    => '_m',        //small
        "SM320" => '_n',        //small 320
        "M"     => '',          //medium
        "O"     => '_o'         //original
    );

    private $_check_meta = true;
    private $_required_meta = array('photo' => array( 'id','dateuploaded','license','owner','title','description','tags','urls'));

    private function prepareURL($data){

        $default = array(
            'api_key'   => $this->api_key,
            'format'    => 'json',
            'nojsoncallback'=> '1'
        );

        $arguments = array_merge($default, $data);
        $url = $this->base_url . '?'. http_build_query($arguments);

        return $url;
    }

    private function makeCall($data, $format = false){
        $url = $this->prepareURL($data);

        $response = json_decode(file_get_contents($url), $format);

        if(empty($response))
            return false;

        return $response;
    }

    private function getImageURL($photo, $image_size = '_m'){
        $farm_id = $photo->farm;
        $server_id = $photo->server;
        $photo_id = $photo->id;
        $secret_id = $photo->secret;

        return 'https://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.$image_size.'.'.'jpg';
    }

    private function getImageMetaData($image_id){
        $data = array(
            'method' => 'flickr.photos.getInfo',
            'photo_id' => $image_id
        );

        $meta = $this->makeCall($data, true);

        if(!$this->_check_meta)
            return $meta;

        $result = array();
        foreach($this->_required_meta['photo'] as $key){
            if(isset($meta['photo'][$key]))
                $result['photo'][$key] = $meta['photo'][$key];
        }

        return $result;
    }

    public function search($tags, $license = NULL, $limit = 25, $size = 'M', $meta = 1){

        $data = array(
            'method' => 'flickr.photos.search',
            'tags' => $tags,
            'per_page' => $limit
        );

        $response = $this->makeCall($data);

        if($response->stat == 'fail'){
            echo $response->message;
            return false;
        }


        $photos = $response->photos->photo;
        $result = array();
        foreach($photos as $photo){
            $meta_data = array();
            if($meta)
                $meta_data  = $this->getImageMetaData($photo->id);

            $result[] = array(
                'url' => $this->getImageURL($photo, $this->image_sizes['LS']),
                'title' => addslashes($photo->title),
                'link' => $this->getImageURL($photo, $this->image_sizes[$size]),
                'meta' => $meta_data
            );
        }

        return $result;
    }

    public function getLicenseInfo(){
        $data = array(
            'method' => 'flickr.photos.licenses.getInfo'
        );

        $response = $this->makeCall($data);

        if(empty($response))
            return false;

        return $response->licenses->license;
    }
}