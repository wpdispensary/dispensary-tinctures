=== Dispensary Tinctures ===
Contributors: wpdispensary, deviodigital
Donate link: https://www.wpdispensary.com
Tags: dispensary, cannabis, marijuana, wp-dispensary, tinctures
Requires at least: 3.0.1
Tested up to: 5.1
Stable tag: 1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a Tinctures menu type to the WP Dispensary menu plugin.

== Description ==

This plugin adds a Tinctures menu type to the [WP Dispensary](https://www.wpdispensary.com) menu plugin.

**Release Notes**

You can read full details in our [blog post](https://www.wpdispensary.com/dispensary-tinctures-add-on/).

**Requirements**

When using the Dispensary Tinctures plugin, [WP Dispensary](https://www.wpdispensary.com) version 1.9.18+ needs to be installed and activated in order display the `Tinctures` menu type's pricing and details on individual item pages.

**Shortcode**

You can display your Dispensary Tinctures by adding the following shortcode:

`[wpd-tinctures]`

Full list of options:

`[wpd-tinctures title="" posts="100" info="show" image="show" imgsize="dispensary-image" class="" viewall=""]`

You can also display your Tinctures items by using the Dispensary Tinctures widget that this plugin adds.

**Contribute**

Want to help this plugin get better? Head over to [Github](https://github.com/wpdispensary/dispensary-tinctures) and open an issue or submit a pull request.

== Installation ==

1. In your WordPress admin dashboard, go to `Plugins` -> `Add New` and search for **Dispensary Tinctures**
3. Activate the plugin and enjoy!

== Changelog ==

= 1.7 =
* Added tinctures prices to `get_wpd_all_prices_simple` filter in `admin/wpd-tictures-functions.php`
* Added tinctures to `wpd_menu_types` helper function in `admin/wpd-tinctures-functions.php`
* Added tinctures to `wpd_top_sellers_metabox` filter in `admin/class-wpd-tinctures-metaboxes.php`
* Updated widget to use the `wpd_product_image` helper function in `admin/class-wpd-tinctures-widgets.php`
* Updated code to escape `$_POST` metabox data in `admin/class-wpd-tinctures-metaboxes.php`
* Updated tinctures category taxonomy `show_in_rest` value to `true` in `admin/class-wpd-tinctures-taxonomies.php`
* Updated shortcode to use `get_wpd_product_image` helper function in `admin/class-wpd-tinctures-shortcodes.php`
* Updated product title to use `get_the_title` function in `admin/class-wpd-tinctures-shortcodes.php`
* Updated tinctures pricing variable in `admin/class-wpd-tinctures-shortcodes.php`
* Updated text strings for localization in `admin/class-wpd-tinctures-post-type.php`
* WordPress Coding Standards updates in `admin/class-wpd-tinctures-shortcodes.php`

= 1.6.1 =
* Removed custom REST API codes for Gear category endpoint in `admin/class=wpd-tinctures-rest-api.php`

= 1.6.0 =
* Added Tinctures category to the eCommerce add-on's single item display in `admin/wpd-tinctures-functions.php`
* Removed extra `}` in the Tinctures helper functions in `admin/wpd-tinctures-functions.php`
* Updated text strings for localization in `admin/wpd-tinctures-functions.php`
* Updated `.pot` file with new text strings for localization in `languages/wpd-tinctures.pot`
* WordPress Coding Standards updates and General code cleanup

= 1.5.0 =
* Added 2 helper functions `get_wpd_tinctures_prices_simple` and `wpd_tinctures_prices_simple` in `admin/wpd-tinctures-functions.php`
* Added 2 action hooks `wpd_tinctures_widget_inside_loop_before` and `wpd_tinctures_widget_inside_loop_before` in `admin/class-wpd-tinctures-widgets.php`
* Updated shortcode to use the new prices helper functions in `admin/class-wpd-tinctures-shortcode.php`
* Updated text for admin `post_updated_messages` in `admin/class-wpd-tinctures-post-type.php`

= 1.4.0 =
* Added shortcode atts filter name to the Tinctures shortcode in `admin/class-wpd-tinctures-shortcodes.php`
* Added Allergens taxonomy for Edibles in `admin/class-wpd-tinctures-taxonomies.php`
* Added Allergens taxonomy to data output in `admin/class-wpd-tinctures-data-output.php`
* Added REST API endpoint for Allergens in `admin/class-wpd-tinctures-rest-api.php`
* Fixed bug to only display details if in Tinctures menu type in `admin/class-wpd-tinctures-data-output.php`
* Updated `Tinctures` display text to change based on custom permalink base in `admin/class-wpd-tinctures-post-type.php`
* Updated `Tinctures` display text to change based on custom permalink base in `admin/class-wpd-tinctures-shortcodes.php`
* Updated `Tinctures` display text to change based on custom permalink base in `admin/class-wpd-tinctures-widgets.php`
* Updated translatable text to work with variable in `admin/class-wpd-tinctures-post-type.php`
* Updated translatable text to work with variable in `admin/class-wpd-tinctures-post-type.php`
* Updated shortcode to use the `wpd_currency_code` function in `admin/class-wpd-tinctures-shortcodes.php`
* Updated Price/Donation display option updates in `admin/class-wpd-tinctures-shortcodes.php`
* Updated various text strings to be translatable in `admin/class-wpd-tinctures-data-output.php`
* Updated various text strings to be translatable in `admin/class-wpd-tinctures-metaboxes.php`
* Updated various text strings to be translatable in `admin/class-wpd-tinctures-shortcodes.php`
* Updated various text strings to be translatable in `admin/class-wpd-tinctures-taxonomies.php`
* Updated `.pot` file with new text strings for localization in `languages/wpd-tinctures.pot`

= 1.3.0 =
* Added `.pot` file for localization in `languages/wpd-tinctures.pot`
* Added permalink settings option for `tinctures` base in `admin/class-wpd-tinctures-post-type.php`
* Updated permalink base codes for `tinctures` custom post type in `admin/class-wpd-tinctures-post-type.php`

= 1.2.0 =
* Add div wrappers to metabox input in `admin/class-wpd-tinctures-taxonomies.php`
* Add admin screen thumbnails to Tinctures menu type in `admin/class-wpd-tinctures-post-type.php`
* Add `categories` endpoint to the REST API in `admin/class-wpd-tinctures-rest-api.php`
* Remove `wpd_tinctures_category` endpoint in `admin/class-wpd-tinctures-post-type.php`
* Update wording for Tinctures post type in `admin/class-wpd-tinctures-post-type.php`
* Update Tinctures category wording in `admin/class-wpd-tinctures-taxonomies.php`
* Update `tinctures_category` endpoint name in `admin/class-wpd-tinctures-rest-api.php`

= 1.1.1 =
* Added better alignment of `Prices` and `Details` metabox input `admin/css/wpd-tinctures-admin.css`
* Added filter for the new table placement in **WP Dispensary v2.0+** in `admin/class-wpd-tinctures-data-output.php`
* Updated admin submenu order number in `admin/wpd-tinctures-post-type.php`

= 1.1 =
* Added filter to add `ingredients` taxonomy to Tinctures in `admin/class-wpd-tinctures-taxonomies.php`
* Added filter to add `vendors` taxonomy to Tinctures in `admin/class-wpd-tinctures-taxonomies.php`
* Added Tinctures `ingredients` to the Details table in `admin/class-wpd-tinctures-data-output.php`
* Added Tinctures `vendors` to the Details table in `admin/class-wpd-tinctures-data-output.php`
* Fixed depreciated string value in get_bloginfo function in `admin/class-wpd-tinctures-shortcodes.php`
* Fixed display bug for pricing output in shortcodes in `admin/class-wpd-tinctures-shortcodes.php`
* Fixed nonce error for `tincturespricesmeta_noncename` in `admin/class-wpd-tinctures-metaboxes.php`
* Fixed bug with Tinctures categories display in `admin/class-wpd-tinctures-data-output.php`
* Fixed `WP_DEBUG` notice by adding a default value for $rewrite variable in `admin/class-wpd-tinctures-post-type.php`
* Fixed `WP_DEBUG` notice by adding `global $post` to Tinctures vendors and categories in `admin/class-wpd-tinctures-data-output.php`
* Fixed ingredient and vendor display by adding a check to make sure post type is Tinctures in `admin/class-wpd-tinctures-data-output.php`
* Updated default widget title from `Recent Tinctures` to `Dispensary Tinctures` in `admin/class-wpd-tinctures-widgets.php`

= 1.0 =
* Initial release
