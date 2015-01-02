=== MyMail - Email Newsletter Plugin for WordPress ===
Contributors: revaxarts
Tags: mymail, newsletter, email, revaxarts 
Requires at least: 3.3
Tested up to: 3.9
Stable tag: 1.6.6.3
Author: revaxarts.com
Author URI: http://revaxarts.com

== Description ==

= a super simple Email Newsletter Plugin for WordPress to create, send and track your Newsletter Campaigns =

**Track Opens, Clicks, Unsubscriptions and Bounces**
Now it’s easy to keep track of your customers. Who does opened when and where your Newsletter? Track undeliverable mails (bounces), Countries, Cities** and know exactly who opened your mails.

**Auto Responders**
Send welcome messages to new subscribers or special offers to your loyal customers. Limit receivers with conditions or send messages only to certain lists

**Schedule your Campaigns**
Let your subscribers receive your latest news when they have time to read it, not when you have time to create it

**Simple Newsletter Creation**
Creating Newsletters has never been so easy. If you familiar with WordPress Posts you can create your next campaign as easy as you publish a new blog entry. All options are easy accessible via the edit campaign page

**Unlimited Customization**
Use the Option panel to give your newsletter an unique branding, save your color schema and reuse it later. Choose one over 20 included backgrounds or upload your custom one.

**Preflight your Newsletter**
Don’t send unfinished Newsletters to your Customers which possible end up in there SPAM folders and are never been seen. Use isNotSpam.com right from the creation page to check if any content is responsible to get marked as spam.

**Retina Support**
WordPress 3.4 added Retina Support. That means all icons and graphics are optimized for that higher resolution. MyMail Newsletter Plugin includes all graphics for these screens with higher DPI

= Full Feature List =

* Track Opens, Clicks, Unsubscriptions and Bounces
* Track Countries and Cities*
* Schedule your Campaigns
* Auto responders
* Use dynamic and custom Tags (placeholders)
* Webversion for each Newsletter
* embed Newsletter with Shortcodes
* Forward via email
* Share with Social Media services
* Unlimited subscription forms
* Sidebar Widgets
* Single or Double-Opt-in support
* WYSIWYG Editor with code view
* Unlimited Color Variations
* Background Image support
* Quick Preview
* Email test with IsNotSpam.com support
* Revisions support (native)
* Multi language Support (English and German included)
* SMTP support
* Gmail support
* DomainKeys Identified Mail Support
* Import and Export for Subscribers
* Retina support

* This product includes GeoLite data created by MaxMind, available from http://maxmind.com

== Installation ==

1. Upload the entire `mymail` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Templates ==

These Templates are made for the MyMail Newsletter Plugin. They have been fully tested with all major email softwares and providers. They are all available exclusively on ThemeForest.

If you have further questions please visit my [support forum](http://rxa.li/support)

Xaver Birsak – http://revaxarts-themes.com

!(http://static.revaxarts-themes.com/logo.png)


= Linus =
[!(http://static.revaxarts-themes.com/preview/linus/preview.jpg)](http://rxa.li/linus)
= Metro =
[!(http://static.revaxarts-themes.com/preview/metro/preview.jpg)](http://rxa.li/metro)
= My Business =
[!(http://static.revaxarts-themes.com/preview/business/preview.jpg)](http://rxa.li/business)
= Loose Leaf =
[!(http://static.revaxarts-themes.com/preview/looseleaf/preview.jpg)](http://rxa.li/looseleaf)
= Market =
[!(http://static.revaxarts-themes.com/preview/market/preview.jpg)](http://rxa.li/market)
= Skyline =
[!(http://static.revaxarts-themes.com/preview/skyline/preview.jpg)](http://rxa.li/skyline)
= Letterpress =
[!(http://static.revaxarts-themes.com/preview/letterpress/preview.jpg)](http://rxa.li/letterpress)

== Extensions ==

= available Extensions =

* [MyMail AmazonSES Integration](http://wordpress.org/plugins/mymail-amazon-ses-integration) _free_
* [MyMail SendGrid Integration](http://wordpress.org/plugins/mymail-sendgrid-integration) _free_
* [Gravity Forms MyMail Add-On](http://wordpress.org/plugins/gravity-forms-mymail-add-on) _free_
* [MyMail Multi SMTP](http://wordpress.org/plugins/mymail-multi-smtp/) _free_
* [MyMail Mandrill Integration](http://wordpress.org/plugins/mymail-mandrill-integration/) _free_


= MyMail Live! =
[!(http://static.revaxarts-themes.com/preview/mymaillive/preview.jpg)](http://rxa.li/mymaillive)


== Changelog ==

= Version 1.6.6.3 =

* fixed a bug with mysql query in WP 3.9 on some servers

= Version 1.6.6.2 =

* fixed some bugs with the editor in FF
* fixed missing styling on the templates page

= Version 1.6.6.1 =

* fixed a bug in th enew editor in WP 3.9
* fixed a bug with Autosave in WP 3.9

= Version 1.6.6 =

* you can now use post meta values in tags with {post_meta[meta_key]:XX}
* added fix for html mails if used with MyMail
* fixed a bug with double labels on checkboxes
* added mymail-list class to ul tags in forms
* ajax forms have now mymail-ajax-form class
* fixed a bug where form redirects to wrong location after confirmation
* fixed a bug where the settings page doesn't get loaded caused by a corrupt geo db
* fixed a bug while importing with meta values
* send date for autoresponders fixed
* notices are now removed with an ajax request
* changes clickbadge look
* changed internal button class to mymail-btn
* moved System info page
* bug fixes

= Version 1.6.5.3 =

* fixed a bug were certain comments causes layout breaks

= Version 1.6.5.2 =

* added bulk deletion of pending subscribers
* added better handling for background images
* HTML conditional comments are now preserved (required for Outlook hacks)
* improved update class
* fixed title shows {subject} in the web version
* fixed some flickering on the edit screen with certain templates
* fixed some minor bugs

= Version 1.6.5.1 =

* new: redirect user to a dedicate "thank you" page after confirmation (double-opt-in only)
* fixed: bug where emails are empty sometimes on third party plugins
* other small fixes

= Version 1.6.5 =

* double-opt-in options are now form related
* new subscribers get form and page they subscribed from
* new language: Persian
* fixed bugs with wrong content urls or urls located outside of the WordPress directory
* fixed some bugs with rtl languages
* fixed some minor bugs

= Version 1.6.4.2 =

* fixed problem with some characters in images
* fixed problem with google plus URLs in autoresponders
* added video and audio tags in whitelist
* better geo db handling
* improved cron for more server types
* option to select all capabilities at once per role
* fixed some spelling mistakes
* small bug fixes

= Version 1.6.4.1 =

* open to choose meta values for WordPress users import
* fixed a bug for embedded hight DPI images on Apple Mail 7+
* fixed wrong character encoding in subject and from field
* fixed multipart mails in mails with linked images
* small bug fixes

= Version 1.6.4 =

* fully tested with WordPress 3.8 RC2
* new icons for WordPress 3.8
* new edit icons
* new archive function - display newsletters like post in an archive
* reset button in settings
* switched geo db location
* suppress some warnings in invalid html templates
* importing WP users now respects defined roles
* placholder images now work with missing GD library
* added area an map tags in the whitelist
* manually uploads of geo db now works correctly
* fixed - user registration now works on custom registration pages
* fixed - bug when user subscribes and merge lists was active
* lot of small bug fixes

= Version 1.6.3.2 =

* fix a with some third party plugins

= Version 1.6.3.1 =

* fix a bug for PHP < 5.3
* passed headers get now progressed if wp_mail is used

= Version 1.6.3 =

* improved bounce handling
* support for soft bounces
* redesigned settings page
* MyMail now respects 'WP_CONTENT_DIR' and 'WP_CONTENT_URL' if they are defined in the wp-config.php
* bug fix on frontpage with forwarding newsletters via email autosave fixes in WP 3.7+
* able to use WP native local storage backup (WP 3.7+)
* bugfix on dynamic images with wrong height calculation
* updated inline style class
* all external data get now served from bitbucket (was dropbox)
* fix bug were some "Â" show up in some clients in certain emails
* fixed some Strict Standards bugs (WP 3.7+)
* json responses returns now correct header
* embedded images are of by default now
* fixed bug in update class with multiple plugins
* fixed bug with custom background iamges in the editor
* updated language files
* works now with the [MyMail Mandrill Integration](http://wordpress.org/plugins/mymail-mandrill-integration/) Plugin
* lot of small bug fixes

= Version 1.6.2.2 =

* better scrolling behavior
* better placement of the editbar
* fixed: wrong calculation of height in external images
* fixed: error thrown in some third party plugins which use the wp_mail function

= Version 1.6.2.1 =

* fixed: clickmap doesn't show percentage
* fixed: first module lost module wrap after saving

= Version 1.6.2 =

* you can now drag modules within the editor to rearrange them
* updated phpMailer to 5.2.7 ([changelog](https://github.com/PHPMailer/PHPMailer/blob/master/changelog.md))
* added port check for SMTP connections
* custom tags now get campaign ID and subscriber ID if available
* custom tags no longer get replaced by their content on finished campaigns
* user values get only overwritten if defined
* user meta values can now get assigned to custom field during import
* removed deprecative jQuery methods
* better error infos for JS error
* bug fixes

= Version 1.6.1 =

* head part of templates are now respected
* option to change the campaign slug from "newsletter" to a custom value
* better wrapping of URL to prevent 403 errors
* issues with large amount of images solved
* bug fixes

= Version 1.6.0 =

* new template language - [please read for more details](http://mymail.newsletter-plugin.com/new-template-language-in-mymail-1-6/)
* if you have [premium templates](http://rxa.li/mymailtemplates) check them for updates!
* included template updated to 3.0 with new template language
* new: included foreign RSS feed in your campaign
* new: text buttons
* new: syntax highlighting in code view
* new: code view for modules
* custom templates now include all modules by default
* custom templates can now have custom modules
* modules can now get renamed (to save custom modules)
* option to wrap single line elements with links
* user images are now based on WordPress avatars in the first place and Gravatars if the do not exists
* editor now offers paragraphs and headings
* editor now offers color picker for text
* newsletter homepage dropdown on settings page now shows published, private and drafted pages

= Version 1.5.8.1 =

* fixed subscribe button label which was "1" in some cases
* small bug fixes

= Version 1.5.8 =

* new: segmentation based on user values
* new shortcode: [newsletter_list] (display the latest newsletters in as a list)
* change: {post_date}, {post_modified} now displays only the date. use {post_time}, {post_modified_time} to display only the time
* added new option for creating list after campaign (1.5.7): "who has not received" 
* added option to label submit button for each form
* subscribers notification now contains a google map if available
* added option to filter receivers in finished campaigns
* updated minicolors plugin to version 2.0
* renamed metabox "Lists" to "Receivers"
* tags now work correctly within links
* retina ready avatars for subscribers
* fixed wrong redirections
* updated easy pie charts
* fixed bug in Polish translation (was Spanish)

= Version 1.5.7.1 =

* fixed: error in geo ip class

= Version 1.5.7 =

* create new lists on finished (or active) campaigns based on:
	* all recipients
	* who has opened
	* who has opened but not clicked
	* who has opened and clicked
	* who has not opened

* search for subscribers now includes custom field values
* optimized cronjob to use less memory
* updated languages
* added user information to subscriber mail
* new avatars for unknown subscribers
* updated easy piechart plugin
* option to bulk convert subscribers with status "error" back to "subscribed"
* fixed bug where categories doesn't get saved on autoresponders
* fixed google plus share link
* bug fixes

= Version 1.5.6 =

* now works with the [Google Analytics](http://wordpress.org/plugins/google-analytics-for-mymail/) and the [Piwik](http://wordpress.org/plugins/piwik-analytics-for-mymail/) add-on
* don't convert emails to mailto links anymore ([why](http://www.campaignmonitor.com/blog/post/4003/tip-avoid-using-mailto-links-in-html-email))
* fixed a bug with hash tags in links

= Version 1.5.5.2 =

* fixed bugs with third party shortcodes
* fixed bug with geo db

= Version 1.5.5.1 =

* fixed bugs for confirmation messages
* updated update class

= Version 1.5.5 =

* new option to check Spam score (beta)
* option to get notified about new subscribers
* new language: Portuguese (Brazil)
* added '{post_author_name}', '{post_author_email}', '{post_author_url}', '{post_author_nicename}' dynamic tags
* '{post_excerpt}' now uses [wp_trim_words()](http://codex.wordpress.org/Function_Reference/wp_trim_words) on the content if no excerpt is set
* changed pie charts to [easy-piecharts](https://github.com/rendro/easy-pie-chart)
* removed isNotSpam option
* added option to reset limits
* added option to change language of texts if available
* fixed a bug on network activation
* fixed error on to many fallback images on the settings page

= Version 1.5.4.1 =

* bug fixes on delivery meta box

= Version 1.5.4 =

* new - time base autoresponder
* option to change charset and encoding
* optimized translations
* added - forms now get a "loading" classes if the form is progressing
* added - option to define the label of each field of every form
* option to hide the asterisk of required fields in forms
* fixed - form throws error if custom function doesn't return a value
* fixed - issue with the stats on the dashboard widget

= Version 1.5.3.2 =

* new function "mymail_get_subscriber"
* added option to embed form css
* fixed - some not latin characters in url prevent redirections
* fixed - alt text of buttons didn't show up in the editbar

= Version 1.5.3.1 =

* important fix for missing background colors

= Version 1.5.3 =

* auto responder now have full statistics
* added - convert single line texts to images with a click
* improved update class for better performance
* updated some geo location files
* fixed - spelling issue in text after widget
* small bug fixes

= Version 1.5.2 =

* prepared for an upcoming plugin - stay tuned!
* new Twitter integration for Twitter API 1.1 - requires access credentials
* bug fixes

= Version 1.5.1.2 =

* performance improvements
* bug fixes

= Version 1.5.1.1 =

* better behavior of the edit bar
* option to keep status of existing subscribers on import
* editor now insert paragraphs correctly
* cleaned up editor buttons
* DKIM issue fixed - re-save settings if you had issues
* several bug fixes

= Version 1.5.1 =

* fixes some Call-time pass-by-reference errors

= Version 1.5.0 =

* works now on network sites
* better import for WordPress users
* added - option to merge imported contacts with existing ones
* added - bounce server test
* added - import WordPress users via Manage subscribers page
* removed - auto import of WordPress User on plugin activation
* option to define notification template for forms
* option to update geo database
* option to upload custom geo database
* lot of small bug fixes

= Version 1.4.1 =

*  added – allow users to sign up on new comment
*  added – allow users to sign up on register
*  added subscribers avatar to subscribers list
*  updated PHPMailer to verison 5.2.4
* option to add vCard to confirmation mails
*  send test to multiple receivers with comma separated list
*  new text “Newslettersignup” 
* bug fixes

= Version 1.4.0 =

* **Please finish all campaigns before update or you may have wrong stats in running campaigns!**
* NEW dynamic post tags
* NEW automatically send your latest post, pages or custom post types to your subscribers with auto responders
* updated templates
* new improved stats on the campaign detail page for each subscriber with opens and clicks
* added – better mobile preview
* added – insert image from URL
* added – HTML as output form on the export tab
* added – option to duplicate modules
* improved sending queue – now uses up to 60% less resources
* improved cron window with more info
* fixed – problems when importing and exporting with some special characters
* fixed – campaign stopped if subscriber caused the error
* fixed – some CSS issues in gecko browsers
* if you have [premium templates](http://rxa.li/mymailtemplates) check them for updates!

= Version 1.3.6 =

* updated included template to version 2.0:
* responsive
* added more social icons

* updated section for editbar: buttons
* added – welcome page
* removed – my first campaign
* added – option for merge lists via settings

= Version 1.3.5 =

* added – HTML form embedding
* added – redirect after submit to any URL
* added – checkboxes for custom tags
* updated language. now available in:

* German
* English
* French
* Croatian
* Slovak
* Italian


= Version 1.3.4 =

* added – pending tab in manage subscribers for unconfirmed users
* templates are now located in the upload directory
* added – option to uses a custom country/city database
* added – option to resend confirmation notice after a defined time
* fixed – confirmation mails doesn’t effect limits

= Version 1.3.3 =

* Completely rewritten subscriber management with improved upload, export and bulk deletion
* removed – old import/export section
* added – new capability ‘manage subscribers’ to give access to the new page
* added – option to pre-fill known user data in forms if user is logged in
* added – forms in widgets now have a ‘mymail-in-widget’ class
* added – optional text before and after the form in widgets
* performance improvements 
* small bug fixes
* fixed – inline labels are not visible in IE>

= Version 1.3.2.4 =

* Bug fixed for sending problems

= Version 1.3.2.3 =

* small fix

= Version 1.3.2.2 =

* Quick fix for sending problems

= Version 1.3.2.1 =

* small bug fixes

= Version 1.3.2 =

* <strong>Please finish all campaigns before update!</strong>
* added - support for the new Media uploader in WP 3.5
* improved Editbar:

* better preview of posts, images and links
* links includes now all other pages too
* double click on the element you like to edit
* double click on an image in the editbar to insert it instantly


* campaigns now get paused if an error occurs during sending
* fixed - subscribers falsely get marked as "error" 
* fixed - missing HTML tab in the editbar
* fixed - geoip.inc conflicts
* fixed - autoresponder not triggered if duplicated
* a lot of bug fixes and performance improvements

= Version 1.3.1.3 =

* fixed - autoresponder get sent twice in some cases

= Version 1.3.1.2 =

* fixed - send problems in some cases

= Version 1.3.1.1 =

* fixed a small bug
* added mymail_subscribe and mymail_unusbscribe functions

= Version 1.3.1 =

* Better DKIM setup
* Better SPF help
* Fully tested in Wordpress 3.5
* optimized delivery method page
* added - option to enable pagination on frontpage
* added - bulk delete of subscribers
* added - track subscribers IP and signup time (optional)
* added - SSL support for bounce mail server (POP3)
* added - "List-Unsubscribe" header with link to unsubscribe page
* added - Gmail delivery method
* added - optional delay between mails in campaigns
* fixed - empty Form CSS now prevents enqueuing form CSS
* fixed - required asterix always show up for names
* fixed - links didn't work in some cases in Outlook 2007
* many bug fixes

= Version 1.3.0 =

* Track vistors cities
* added - {forwad} tag to allow forwarding your newsletter
* added - inline label for forms (optional)
* images from custom templates in the template directory are now saved with relative path
* added - better feedback for saving templates on the templates page
* fixed - invalid emails are getting imported
* fixed - images are always embedded in notification mails

= Version 1.2.2.1 =

* fixed - headers are not set in some cases

= Version 1.2.2 =

* MyMail Template updated to 1.3
* added - embed your form on another site
* added - new capability "manage capabilities"
* added - campaigns now sortable by status
* fixed - Auto responder not sent if limit reached
* fixed - more loadHTML issues
* small bug fixes and performance improvements 

= Version 1.2.1.4 =

* fixed - loadHTML error in some cases
* fixed - HTML editor not available in some cases
* fixed - HTML doesn't get changed on Firefox in some cases

= Version 1.2.1.3 =

* fixed - small bug in Javascript

= Version 1.2.1.2 =

* added - auto responders now get send on bulk import too
* updated form CSS to better match twenty eleven and twenty twelve theme
* fixed - editor doesn't close if tinymce is disabled

= Version 1.2.1.1 =

* fixed - auto responders get send again after update

= Version 1.2.1 =

* added - better support for custom templates
* added - new option: email limit for a certain period
* better forms now works with JS disabled
* prefix for import and template page
* improved post and image list
* localized number formatting
* fixed - some "Call time passed by reference errors"
* fixed - bug in wp_mail
* fixed - bulk import with "wrong" line breaks
* fixed - auto responders can get activated without permission
* small bug fixes

= Version 1.2.0 =

* new - auto responders
* webversion link now working in test mails
* Dashboard widget settings removed - now only through capabilities
* List descriptions are now included in the form
* WordPress system mails now uses notification template (optional)
* loading graphic updated for retina support

= Version 1.1.1.1 =

* fixed - problems with form CSS

= Version 1.1.1 =

* custom color schemas can now get deleted
* better custom color handling for templates
* active campaigns are not editable anymore (must be paused)
* campaign statistics for active campaigns
* added - texts tab, better text management in settings page
* fixed - Bulk import breaks in some cases
* fixed - wrong click count if cron was running

= Version 1.1.0 =

* new - capabilities
* new - Bulk Import for large subscriber lists
* performance improvements
* lists in forms now optional drop downs
* change value of "First Name", "Last Name" via settings panel
* improved custom fields with support for textfields, drop downs or radio buttons
* fixed - scroll down to the bottom on frontpage not possible

= Version 1.0.1 =

* Different ajax action for exporting subscribers (was not so common)
* small fixes

= Version 1.0 =

* Initial Release

