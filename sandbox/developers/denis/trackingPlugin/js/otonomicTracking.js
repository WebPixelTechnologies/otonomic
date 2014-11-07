// Tracking json
var gaTagsJson = [
        {'id':'1','name':'buttonMain', 'category': 1, 'event': 'Click on Main', 'label': 'buttonMain', 'value':3, 'ajax_track':1, 'action_type':'click'},
        {'id':'2','name':'buttonMain', 'category': 1, 'event': 'Hover on Main', 'label': 'buttonMain', 'value':3, 'ajax_track':1, 'action_type':'hover'},
        {'id':'3','name':'button1', 'category': 2, 'event': 'Click on button', 'label': 'button-1', 'value':4, 'ajax_track':1, 'action_type':'click'},
        {'id':'4','name':'button2', 'category': 2, 'event': 'Click on button', 'label': 'button-2', 'value':5, 'ajax_track':1, 'action_type':'click'},
        {'id':'5','name':'button3', 'category': 2, 'event': 'Click on button', 'label': 'button-3', 'value':'', 'ajax_track':1, 'action_type':'click'},
        {'id':'6','name':'radio1', 'category': 3, 'event': 'User Made Choice', 'label': 'Radio buttons', 'value':'', 'ajax_track':1, 'action_type':'click'},
        {'id':'7','name':'select1', 'category': 3, 'event': 'User Made selection', 'label': 'Selection', 'value':'', 'ajax_track':1, 'action_type':'change'},
        {'id':'8','name':'input1', 'category': 3, 'event': 'User Made Input', 'label': 'email address', 'value':'', 'ajax_track':1, 'action_type':'blur'}
    ];

var gaTags = {};
// Store Json to Local Storage & convert to assotive object
storeJson(gaTagsJson);


$(".track.click").click(function(e) {
    default_category = default_label = '';
    default_event = 'Click';
    default_value = null;
    default_log_to_db = 1;
    default_action_type = 'Click';

    var $this = $(this);
    var tag_id = $this.attr("data-tag-id");
    if( tag_id ) {
        tags = get_tags(tag_id,'click');
        console.log(tags);
        category    = tags['category']      || default_category;
        gaEvent     = tags['event']         || default_event;
        label       = tags['label']         || default_label;
        ajax_track  = tags['ajax_track']    || default_log_to_db;
        action_type = tags['action_type']   || default_action_type;
        value       = $this.attr('value')   || (tags['value'] || default_value);
       
    } else {
        var category    = $this.attr("data-ga-category")  || default_category;
        var gaEvent     = $this.attr("data-ga-event")     || default_event;
        var label       = $this.attr("data-ga-label")     || default_label;
        var value       = $this.attr("data-ga-value")     || default_value;
        var ajax_track  = $this.attr("data-ajax-track")   || default_log_to_db;
        var action_type = $this.attr("data-action-type")  || default_action_type;
    }

    //trackEvent(category, gaEvent, label, value);
    console.log('trackEvent('+category+', '+gaEvent+', '+label+', '+value+');');
    if(ajax_track == 1){
        //p2sTrack(category, gaEvent, label, value);
        console.log('p2sTrack('+category+', '+gaEvent+', '+label+', '+value+');');
    }
});

$(".track.hover").hover(function(e) {
    default_category = default_label = '';
    default_event = 'Click';
    default_value = "default value";
    default_log_to_db = 1;
    default_action_type = 'Click';

    var $this = $(this);
    var tag_id = $this.attr("data-tag-id");
    if( tag_id ) {
        tags = get_tags(tag_id,'hover');
        console.log(tags);
        category    = tags['category']      || default_category;
        gaEvent     = tags['event']         || default_event;
        label       = tags['label']         || default_label;
        value       = $this.attr('value')   || (tags['value'] || default_value);
        ajax_track  = tags['ajax_track']    || default_log_to_db;
        action_type = tags['action_type']   || default_action_type;
    } else {
        var category    = $this.attr("data-ga-category")  || default_category;
        var gaEvent     = $this.attr("data-ga-event")     || default_event;
        var label       = $this.attr("data-ga-label")     || default_label;
        var value       = $this.attr("data-ga-value")     || default_value;
        var ajax_track  = $this.attr("data-ajax-track")   || default_log_to_db;
        var action_type = $this.attr("data-action-type")  || default_action_type;
    }

    //trackEvent(category, gaEvent, label, value);
    console.log('trackEvent('+category+', '+gaEvent+', '+label+', '+value+');');
    if(ajax_track == 1){
        //p2sTrack(category, gaEvent, label, value);
        console.log('p2sTrack('+category+', '+gaEvent+', '+label+', '+value+');');
    }
});

$(".track.focus").focus()

// good for <input> tags 
$(".track.blur").blur(function(e) {
    default_category = default_label = '';
    default_event = 'Click';
    default_value = "default value";
    default_log_to_db = 1;
    default_action_type = 'Click';

    var $this = $(this);
    var tag_id = $this.attr("data-tag-id");
    if( tag_id ) {
        tags = get_tags(tag_id,'blur');
        console.log(tags);
        category    = tags['category']      || default_category;
        gaEvent     = tags['event']         || default_event;
        label       = tags['label']         || default_label;
        value       = $this.val()           || default_value;
        ajax_track  = tags['ajax_track']    || default_log_to_db;
        action_type = tags['action_type']   || default_action_type;
    } else {
        var category    = $this.attr("data-ga-category")  || default_category;
        var gaEvent     = $this.attr("data-ga-event")     || default_event;
        var label       = $this.attr("data-ga-label")     || default_label;
        var value       = $this.attr("data-ga-value")     || default_value;
        var ajax_track  = $this.attr("data-ajax-track")   || default_log_to_db;
        var action_type = $this.attr("data-action-type")  || default_action_type;
    }

    //trackEvent(category, gaEvent, label, value);
    console.log('trackEvent('+category+', '+gaEvent+', '+label+', '+value+');');
    if(ajax_track == 1){
        //p2sTrack(category, gaEvent, label, value);
        console.log('p2sTrack('+category+', '+gaEvent+', '+label+', '+value+');');
    }
});

// good for <select> tags
$(".track.change").change(function(e) {
    default_category = default_label = '';
    default_event = 'Click';
    default_value = "default value";
    default_log_to_db = 1;
    default_action_type = 'Click';

    var $this = $(this);
    var tag_id = $this.attr("data-tag-id");
    if( tag_id ) {
        tags = get_tags(tag_id,'change');
        category    = tags['category']      || default_category;
        gaEvent     = tags['event']         || default_event;
        label       = tags['label']         || default_label;
        ajax_track  = tags['ajax_track']    || default_log_to_db;
        action_type = tags['action_type']   || default_action_type;
        value       = $this.attr('value')   || ($this.find("option:selected").val() || (tags['value'] || default_value));
    } else {
        var category    = $this.attr("data-ga-category")  || default_category;
        var gaEvent     = $this.attr("data-ga-event")     || default_event;
        var label       = $this.attr("data-ga-label")     || default_label;
        var value       = $this.attr("data-ga-value")     || default_value;
        var ajax_track  = $this.attr("data-ajax-track")   || default_log_to_db;
        var action_type = $this.attr("data-action-type")  || default_action_type;
    }

    //trackEvent(category, gaEvent, label, value);
    console.log('trackEvent('+category+', '+gaEvent+', '+label+', '+value+');');
    if(ajax_track == 1){
        //p2sTrack(category, gaEvent, label, value);
        console.log('p2sTrack('+category+', '+gaEvent+', '+label+', '+value+');');
    }
});

function storeJson(gaTagsJson){
    if(lsTest() === true){
        // check if tag id is present
        if (localStorage.getItem('gaTagsJson') === null) {
            console.log('Notice: No Local Storage Found');
            console.log('Notice: Storing');
            localStorage.setItem('gaTagsJson',JSON.stringify(gaTagsJson));
        }// else
        else{ 
            //console.log(JSON.parse(localStorage['gaTagsJson']));
            gaTags = JSON.parse(localStorage['gaTagsJson']); 
        }
    }else{
        console.log('Error: "localStorage" NOT supported!');
        return false;
    }
}

function get_tags(tag_name,action_type){
    $.each(gaTags, function (index,value) {
        if(gaTags[index]['name'] === tag_name && gaTags[index]['action_type'] === action_type){
            result = gaTags[index];
        }
    });
    console.log('Found: '+ result['name'] +' - '+ result['action_type']);
    return result;
}

// check browser localStorage support
function lsTest(){
    var test = 'test';
    try {
        localStorage.setItem(test, test);
        localStorage.removeItem(test);
        return true;
    } catch(e) {
        return false;
    }
}