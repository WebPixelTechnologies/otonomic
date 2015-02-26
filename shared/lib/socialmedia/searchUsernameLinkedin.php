<?php

$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$token = 'AQXZ8OuqgJtrk4D-CDDUuisXrZvxk7rqUKQstEcmeYD2Ml-PAn3dhKbjnfnnnsYq4cWMV1ClMew7pLnwcABXvVkEQrieDIIvUMaomX0yW_Xef1Sf5gWxuLaNEJ2z0__kyylBTPHokS-h4tm952a3zUETmoPI6U0_pMOB_LImptVNR5vJVzA';
$reqdata = urlencode(strtolower($_GET['search_box']));

$url = "https://api.linkedin.com/v1/people-search?format=json&keywords=".$reqdata."&oauth2_access_token=".$token;
$google_user = @file_get_contents($url);
//die();
$content = json_decode($google_user);

if($format == 'json') {
    echo($google_user);
    return;

} else {
    $result = "";
    if(isset($content->people->values)){
    foreach($content->people->values as $item):
        
        $profile_url = "https://api.linkedin.com/v1/people/id=".$item->id."?format=json&keywords=".$reqdata."&oauth2_access_token=".$token;
        $profile = json_decode(@file_get_contents($profile_url));
//        print_r($profile);
        $result .= <<<E
            <div class="media selectable" data-value="{$profile->firstName} {$profile->lastName}">
                <a class="pull-left"
                    data-analytics-label: "{$profile->firstName} {$profile->lastName}">
                    
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$profile->firstName} {$profile->lastName}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$profile->firstName} {$profile->lastName} </span>
                    </h4>
                    <span>{$profile->headline}</span>
                </div>
            </div>
E;

    endforeach;
    }
    echo $result;
}
?>
