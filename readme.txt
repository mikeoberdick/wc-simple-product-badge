=== WC Simple Product Badge ===
Contributors: Mike_Oberdick
Tags: woocommerce, e-commerce, product, badge, new product, new product badge, on sale, on sale badge, sale, sale badge, product badge
Requires at least: 3.5
Tested up to: 4.5
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays a personalized text badge overlay on the WooCommerce product image with the ability to include a custom css class and duration.

== Description ==

WC Simple Product Badge creates three new custom fields in the WooCommmerce product meta admin panel.  One is for the message you'd like displayed on the badge, the second is for an optional css class, and the third is the number of days the badge will be displayed. On the site, the text is displayed as a badge overlay on the WooCommerce store product image for the amount of time determined by the user.  Some basic styling for the badge is included by default as well as some optional classes (e.g. orange, yellow, blue, green, purple, and black) to change the background color of the badge.

== Installation ==

1. Upload `wc-simple-product-badge` to the `/wp-content/plugins/wc-simple-product-badge` directory or install the plugin through the WordPress plugins screen.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. WooCommerce Product Details section will now include a field for the badge title, badge class, and duration.
4. Done!

== Frequently Asked Questions ==

= How do I style the badge? =

Out of the box, there are only a few styles applied to the badge using the 'wc_simple_product_badge' class.  If you'd like to add to those styles you can create your own css rules using that class or use your own class by adding it using the "Badge Class" field.

= How do I set the duration for the badge? =

Include the number of days that you'd like to display the badge in the custom field titled "Duration" within the product details.  Please note that the duration timeframe is based off of the date and time that the product was published.

== Screenshots ==

1. WC Simple Product Badge new fields added to the Product Details panel.
2. WC Simple Product Badge displayed on a WooCommerce product.
3. WC Simple Product Badge built in css colors.


== Changelog ==

= 1.0 =
Initial release

= 1.1 =
Defined an absolute path for use when loading the stylesheet

= 1.2 =
Added the ability for a user to choose whether or not to display the badge on the single product page as well as shop page