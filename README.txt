=== Dispensary Tinctures ===
Contributors: deviodigital
Donate link: https://www.wpdispensary.com
Tags: dispensary, cannabis, marijuana, wp-dispensary, tinctures
Requires at least: 3.0.1
Tested up to: 4.9.4
Stable tag: 1.0.0
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
