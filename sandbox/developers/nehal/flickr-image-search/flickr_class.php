<?php

class Flickr{

    private $base_url = 'http://api.flickr.com/services/rest/';

    private $api_key = '4e43bae16da5393e3177e8c20ae517a4';

    private $image_sizes = array(
        "Square"        => '_s',
        "Large Square"  => '_q',
        "Thumbnail"     => '_t',
        "Small"         => '_m',
        "Small 320"     => '_n',
        "Medium"        => '',
        "Original"      => '_o'
    );

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

    private function makeCall($data){
        $url = $this->prepareURL($data);

        $response = json_decode(file_get_contents($url));

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


    public function search($tags, $license = NULL, $limit = 25){

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
            $result[] = array(
                'url' => $this->getImageURL($photo, $this->image_sizes['Large Square']),
                'title' => addslashes($photo->title),
                'link' => $this->getImageURL($photo, $this->image_sizes['Medium'])
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