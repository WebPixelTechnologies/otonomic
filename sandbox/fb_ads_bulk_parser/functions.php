<?php
ini_set("auto_detect_line_endings", true);

function csv_to_array($filename='', $merge_array) {
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        $ii = 0;
        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
        {
            if(!$header){
                $header = array();
                foreach ($row as $key_name) {
                    $val = "";
                    switch(trim($key_name)){
                        case "Campaign name":
                            $val = "Campaign Name"; break;
                        case "Country":
                            $val = "Countries"; break;
                        case "ad image":
                            $val = "Image"; break;
                        case "URL":
                            $val = "Link"; break;
                        case "":
                            break;
                        default:
                            $val = trim($key_name);
                            break;
                    }
                    if($val) {
                        $header[$ii] = $val;
                    }
                    $ii++;
                }
                $c = count($header);
            }

            else {
                if(empty($row)) { continue;}
                $data_temp = [];
                // $row = array_slice($row, 0, $c);

                foreach($header as $num => $header_name) {
                    if($header_name) {
                        $data_temp[$header_name] = $row[$num];
                    }
                }
                // $data_temp = array_combine($header, $row);
                // unset($data_temp['']);
                $data[] = array_merge($merge_array, $data_temp);
            }
        }
        fclose($handle);
    }
    return $data;
}


function print_array($rows) {
    $exclude_keys = array('NF Description','utm source','utm medium','utm term','utm content','utm campaign');

    foreach($rows as $row){
        $row = array_diff_key($row, array_flip($exclude_keys));
        var_dump($row);
    }
    return true;
}

function array_to_csv($rows){
    // Facebook file requires tabs and not csv
    $delimiter = chr(9); // ",";
    // $delimiter = ",";
    $exclude_keys = array('NF Description','utm source','utm medium','utm term','utm content','utm campaign','Image');

    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename=bulk.txt');
    $fp = fopen('php://output', 'w');

    $header_printed = false;
    foreach($rows as $row){
        $row = array_diff_key($row, array_flip($exclude_keys));

        if(!$header_printed){
            $header = array_keys($row);
            fputcsv($fp, $header, $delimiter);
            $header_printed = true;
        }
        fputcsv($fp, $row, $delimiter);
    }
    fclose($fp);
}

function get_default_row_for_bulk_csv(){
    $bulk_csv_header = "
Campaign ID,
Campaign Name,
Campaign Status,
Campaign Objective,
Campaign Buying Type,
Tags,
Ad Set ID,
Buying type,
Ad Set Run Status,
Ad Set Daily Impressions,
Ad Set Lifetime Impressions,
Ad Set Name,
Ad Set Time Start,
Ad Set Time Stop,
Ad Set Daily Budget,
Ad Set Lifetime Budget,
Ad Set Type,
Rate Card,
Ad ID,
Ad Status,
Preview Link,
Bid Type,
Max Bid,
Clicks,
Reach,
Social Imps,
Actions,
Max Bid Clicks,
Max Bid Reach,
Max Bid Social,
Max Bid Conversions,
Ad Name,
Title,
Body,
Link,
Conversion Tracking Pixels,
Related Page,
Image Hash,
Icon Image Hash,
Creative Type,
[OBSOLETE] Mobile Store,
[OBSOLETE] Mobile Store Content ID,
Link Object ID,
Application ID,
Story ID,
URL Tags,
Query JSON,
Tracking Specs,
Conversion Specs,
Ad Objective,
Countries,
Cities,
Regions,
Zip,
Radius,
Locations,
Excluded Locations,
Gender,
Age Min,
Age Max,
Education Status,
Education Networks,
Education Majors,
Workplaces,
Fields of Study,
Education Schools,
Work Job Titles,
Work Employers,
College Start Year,
College End Year,
Interested In,
Relationship,
Family Statuses,
Industries,
Life Events,
Politics,
Income,
Net Worth,
Home Type,
Home Ownership,
Home Value,
Ethnic Affinity,
Generation,
Household Composition,
Moms,
Office Type,
Behaviors,
Connections,
Excluded Connections,
Friends of Connections,
Locales,
Site Category,
User Device,
User Operating System,
User OS Version,
Wireless Carrier,
Likes and Interests,
Unified Interests,
Excluded User AdClusters,
Broad Category Clusters,
Targeting Categories - ALL OF,
Custom Audiences,
Excluded Custom Audiences,
Page Types,
Targeting Action Spec,
Mobile App Video,
Mobile App Deep Link,
[OBSOLETE] Mobile App Deep Link Title,
Product Link,
Call to Action,
Optimized Conversion Tracking Pixels,
Additional Custom Tracking Specs,
Spent,
Clicks Count,
Impressions,
Actions Count,
Image,
Icon Image";

    /*

        "Campaign ID, Campaign Name, Campaign Status, Campaign Objective, Campaign Buying Type,
        Tags, Ad Set ID, Buying type, Ad Set Run Status, Ad Set Daily Impressions, Ad Set Lifetime Impressions,
        Ad Set Name, Ad Set Time Start, Ad Set Time Stop, Ad Set Daily Budget, Ad Set Lifetime Budget, Ad Set Type
        Campaign Daily Impressions, Campaign Lifetime Impressions,
        Ad Set Run Status, Ad Set Time Start, Ad Set Time Stop, Ad Set Daily Budget, Ad Set Lifetime Budget, Ad Set Type, Ad Set Name,
        Ad ID, Ad Status, Ad Name, Title, Body,Link, URL Tags, Ad Objective,
        Demo Link, Bid Type, Max Bid, Clicks, Reach, Social Imps, Actions, Max Bid Clicks, Max Bid Reach, Max Bid Social, Max Bid Conversions,
        Buying type, Call to Action,

        Tags, Rate Card, Conversion Tracking Pixels, Related Page, Image Hash, Icon Image Hash, Image, Icon Image, Creative Type, Mobile Store, Mobile Store Content ID, Link Object ID, Application ID, Story ID, Auto Update, Query JSON, Tracking Specs, Conversion Specs, Additional Custom Tracking Specs,
        Objective, Countries, Cities, Regions, Zip, Locations, Excluded Locations, Gender, Age Min, Age Max,Education Status,Education Networks,Education Majors,Workplaces,College Start Year,College End Year,Interested In,Relationship,Radius,Connections,Excluded Connections,Friends of Connections,Locales,Site Category,User Device,User Operating System,User OS Version,Wireless Carrier,Likes and Interests,Unified Interests,Excluded User AdClusters,Broad Category Clusters,Custom Audiences,Excluded Custom Audiences,Page Types,Targeting Action Spec,Spent,Clicks Count,Impressions,Actions Count";


            Broad Age,

    */

    $bulk_csv_header_array = explode(",", $bulk_csv_header);

    $default_row = array();

    $default_values = [
            "Campaign Name"	        => "TEST Campaign name",
            "Campaign Buying Type"	=> "Auction",
            "Campaign Objective"	=> "Clicks to Website",
            "Campaign Status"	    => "Active",
            "Ad Set Run Status"	    => "Active",
            "Ad Set Type"	        => "Auction",
            "Ad Objective"	        => "Clicks to Website",
            "Bid Type"	            => "CPC",
            "Buying type"	        => "AUCTION",
            "Related Page"	        => "409731479080509",
            "Creative Type Page"    => "Post Ad",
            "Query JSON"	        => "{}",
            "Conversion Specs"	    => "N/A",
            "Countries"	            => "US",
            "Gender"	            => "Women",
            "Age Min"	            => "24",
            "Age Max"	            => "64",
            "Education Status"	    => "Anyone",
            "Interested In"	        => "All",
            "Relationship"	        => "All",
            "Radius"	            => "0",
            "Page Types"        	=> "News Feed Desktop",
            "Targeting Action Spec"	=> "{}"
    ];

    foreach($bulk_csv_header_array as $key){
        $key = trim($key);

        if( isset($default_values[$key])) {
            $default_row[$key] = $default_values[$key];
        } else {
            $default_row[$key] = "";
        }

        /*
        switch( strtolower($key)) {
            case strtolower('Campaign Status'):
                $default_row[$key] = "Active";
                break;

            case strtolower('Campaign buying type'):
                $default_row[$key] = "Auction";
                break;
            case strtolower('Campaign Objective'):
                $default_row[$key] = "Clicks to Website";
                break;

            case strtolower('Ad Set Run Status'):
                $default_row[$key] = 'Active';
                break;
            case strtolower('Ad Set Type'):
                $default_row[$key] = 'Auction';
                break;

            case strtolower('Ad Status'):
                $default_row[$key] = 'Active';
                break;
            case strtolower('Ad Objective'):
                $default_row[$key] = "Clicks to Website";
                break;

            case strtolower('Education Status'):
                $default_row[$key] = 'Anyone';
                break;
            case strtolower('Interested in'):
                $default_row[$key] = 'All';
                break;
            case strtolower('Relationship'):
                $default_row[$key] = 'All';
                break;
            case strtolower('Radius'):
                $default_row[$key] = '0';
                break;
            case strtolower('Broad Age'):
                $default_row[$key] = 'No';
                break;
            case strtolower('Age Max'):
                $default_row[$key] = "64";
                break;
            case strtolower('Age Min'):
                $default_row[$key] = "24";
                break;
            case strtolower('Behaviors'):
                $default_row[$key] = "6002714898572:Small business owners";
                break;
            case strtolower('Bid Type'):
                $default_row[$key] = "cpc";
                break;
            case strtolower('Conversion Tracking Pixels'):
                $default_row[$key] = "";
                break;

            case strtolower('Optimized Conversion Tracking Pixels'):
                $default_row[$key] = '[]';
                break;
            case strtolower('Targeting Action Spec'):
                $default_row[$key] = '{}';
                break;
            case strtolower('Query JSON'):
                $default_row[$key] = '{}';
                break;
            case strtolower('Related Page'):
                $default_row[$key] = PAGE_ID;
                break;
            case strtolower('Link Object Id'):
                $default_row[$key] = 'o:'.PAGE_ID;
                break;

            case strtolower('Buying type'):
                $default_row[$key] = 'AUCTION';
                break;

            case strtolower('Conversion Specs'):
                $default_row[$key] = 'N/A';
                break;


            default:
                $default_row[$key] = '';
        }
        */
    }
    return $default_row;
}

// to read from CSV file
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle);
    }
    fclose($file_handle);
    return $line_of_text;
}


/*
function create_facebook_posts_org($csvFile, $facebook) {
    $fb_accounts = $facebook->api('/me/accounts?access_token='.$facebook->getAccessToken());
    $access_token = $fb_accounts['data'][0]['access_token'];

    $csv = readCSV($csvFile);

    $final_arr[] = array('Message', 'Link name', 'Link description', 'Link url', 'Link image', 'post ID');

    for($i=1;$i<count($csv);$i++){
        if(!empty($csv[$i])){
            $post_message = $csv[$i][0];
            $post_name = $csv[$i][1];
            $post_desc = $csv[$i][2];
            $post_link = $csv[$i][3];
            $post_image = $csv[$i][4];

            if($post_image && strpos($post_image, 'http')===false) {
                $post_image = BASE_IMAGE_URL . $post_image;
            }
            $post_data = array(
                'message'         => $post_message,
                'link'            => $post_link,
                'description'     => $post_desc,
                'cb'              => '',
                'published'       => 0,
                'access_token'    => $access_token,
            );
            if($post_image) {
                $post_data['picture'] = $post_image;
            }

            $ret_obj = $facebook->api('/'.PAGE_ID.'/feed', 'POST', $post_data);

            $final_arr[] = array($post_message, $post_name, $post_desc, $post_link, $post_image, $ret_obj['id']);
        }
    }

    // to write to CSV file
    $fp = fopen($csvFile, 'w');
    foreach ($final_arr as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
}
*/

function get_page_access_token($fb_accounts, $page_id) {
    foreach($fb_accounts['data'] as $account) {
        if ($account['id'] == PAGE_ID) {
            return $account['access_token'];
        }
    }
    return false;
}

function create_facebook_posts($data, $facebook) {
    $fb_accounts = $facebook->api('/me/accounts?access_token='.$facebook->getAccessToken());
    $access_token = get_page_access_token($fb_accounts, PAGE_ID);
    // $access_token = $fb_accounts['data'][0]['access_token'];
    // $access_token = $facebook->getAccessToken();

    $c = count($data);

    // $data = array_slice($data, 0, 2);

    foreach($data as &$row){
        if(empty($row['Link'])) { continue; }

        $post_message = $row['Title'];
        $post_name = $row['Body'];
        $post_desc = $row['NF description'];
        $post_link = $row['Link'];
        $post_image = $row['Image'];

        $post_data = array(
            'message'         => $post_message,
            'link'            => $post_link,
            'description'     => $post_desc,
            'caption'              => '',
            'published'       => 0,
            'access_token'    => $access_token,
            // TODO: Remove this
            // 'picture'         => 'http://www.hdwallpapers.in/walls/blue_eyes_cute_baby-wide.jpg'
        );
        if($post_image) {
            if(strpos($post_image, 'http')===false) {
                $post_image = BASE_IMAGE_URL . $post_image;
            }oto
            $post_data['picture'] = $post_image;
        }

        try {
            $ret_obj = $facebook->api('/'.PAGE_ID.'/feed', 'POST', $post_data);
            //$ret_obj['id'] = '12345';
            $ret_obj_arr = explode('_', $ret_obj['id']);
            $row['Story ID'] = 's:'.$ret_obj_arr[1];
            $row['Link Object ID'] = 'o:'.$ret_obj_arr[2];

            // var_dump($post_data);

        } catch(FacebookApiException $e) {
            echo 'Received the following error for a post: '.($e->getType()). " ".$e->getMessage()."<br/>";
            echo "Post details: <br/>";
            var_dump($post_data);

            error_log($e->getType());
            error_log($e->getMessage());
        }
    }

    return $data;
}