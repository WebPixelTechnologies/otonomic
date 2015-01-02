=== BWL Advanced FAQ Manager ===

Contributors: Md Mahbub Alam Khan
Donate link: http://www.bluewindlab.com/
Tags: faq manager, faq plugins, css3 faq plugins, advanced faq manager
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 1.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/Licenses/gpl-2.0.html

BWL Advanced FAQ Manager is a cool FAQ Management plugin that offers custom post type for adding unlimited FAQ in your WordPress website.

== Description ==

BWL Advanced FAQ Manager Plugin makes it easy to create FAQ sections on your WordPress powered blog. Simply activate, add FAQ items, then display them on a post or page by using a shortcode.
Also you can show your faq items in sidebar as widget. Cool sorting features gives you sort FAQ items according to your need.

Features:

- Unlimited FAQ.
- FAQ Option Panel.
- 7 different FAQ Themes.
- Front End FAQ Ask Form.
- Shortcode Available.
- FAQ Widget.
- Sorting FAQ.
- Rating FAQ.
- FAQ Categories.
- FAQ Topics.
- Pure CSS3 Accordion.
- Responsive Layout.
- Only 21Kb In Size.
- Ready for localization.
- Support WP Latest Version.
- Well Documentation.

== Installation ==

= Using The WordPress Dashboard  =

1. Navigate to the 'Add New' Plugin Dashboard.
2. Select 'bwl-advanced-faq-manager.zip' from your computer.
3. Upload.
4. Activate the plugins on the WordPress Plugins dashboard.

= Using FTP =

1. Extract 'bwl-advanced-faq-manager.zip' to your computer.
2. Upload 'bwl-advanced-faq-manager' directory to your 'wp-content/plugins' directory.
3. Activate the plugins on the WordPress Plugins dashboard.

== Frequently Asked Questions ==

= Do I use this Plugins as widget?
Yes, you can. Go to widget dashboard and there you will found a widget called "BWL Advanced FAQ Manager Widget". Drag and drop 
it right panel and add short codes inside text box and you are done.

= How to integrate short codes?
It's very simple. Follow the steps.
1. Go to pages>Add new and then in text editor write [bwla_faq]. Save it and you are done.
2. You can also add parameters in shortcodes.
Show 5 faqs then add -
[bwla_faq limit=5]

Show 5 faqs with ascending order depends on menu order then add -
[bwla_faq orderby='menu_order' limit=5 order= 'ASC']

Show faq by categories then add -

[bwla_faq faq_category='your-category-name']

Show faq by topics then add -

[bwla_faq faq_topics='your-topics-name']

You can also add limit, order, orderby shortcodes in topics and categories.
3. Available Shortcodes:

Show All FAQs: [bwla_faq]
Show FAQs By Category: [bwla_faq faq_category='your-category-slug']
Show FAQs By Topics: [bwla_faq faq_topics='your-topic-slug']
Show 5 FAQs (SET LIMIT): [bwla_faq limit='5']
Add FAQ Form: [bwla_form]
Show Search Form in FAQ: [bwla_faq sbox=1/]
Hide Search Form in FAQ: [bwla_faq sbox=0 /]

== Changelog ==

= 2013, July, 01 - v 1.2 =
* Front-end "FAQ question add FORM" using Shortcode.
* Add email & log In Settings feature in admin panel.
* Shortcode for show/hide search form.
* Accordion improved for Internet explorer 7/8/9
* Integrate Modernizr.
* Documentation Improved.

= 2013, June, 24 - v 1.1 =
* Add Live Search Feature.
* Enable/Disable features for live search.
* Add settings section in admin panel.

= 2013, June, 22 - v 1.0 =
* Initial release


