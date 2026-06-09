=== Reading Progress Bar ===
Contributors: Saad
Plugin URI: [https://sitecroftdev.vercel.app/plugins/reading-progress-bar](https://sitecroftdev.vercel.app/plugins/reading-progress-bar)
Tags: reading progress, scroll indicator, scroll progress, reading bar, user experience
Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)

A sleek, ultra-lightweight, and fully customizable reading progress bar that visually tracks scroll depth through your articles and pages.

== Description ==

Reading Progress Bar is a highly optimized, production-ready WordPress plugin designed to elevate user engagement and improve reading experiences on your website. As a visitor scrolls through an article or page, a clean visual indicator fills up smoothly in real time to indicate how much of the content has been read. It works instantly upon activation using standard defaults, requires zero external libraries, and runs on pure vanilla JavaScript.

= Main Features =

* **Real-Time Scroll Depth Tracking:** Accurately measures viewport offsets relative to target content.
* **No Library Dependencies:** Built entirely with native CSS3 transitions and vanilla JavaScript—completely independent of jQuery.
* **Performance Tuned:** Leverages `requestAnimationFrame` window scroll event throttling to eliminate layout shifts and maximize page rendering speeds.
* **Responsive Architecture:** Adapts perfectly out of the box to mobile devices, tablets, and desktop displays.
* **Native Admin Integration:** Configured entirely via the standard WordPress Settings API.
* **Strict Security Guardrails:** Every setting field is rigorously sanitized, validated, and safely escaped to keep your database protected.
* **Translation Ready:** Completely localized and prepared for internationalization hooks using the `reading-progress-bar` text domain.

= Global Configuration Options =
You can easily fine-tune the progress bar directly from your native WordPress Dashboard (**Settings → Reading Progress Bar**):

* **Enable Plugin:** Turn the visual progress bar tracking engine on or off globally.
* **Bar Position:** Anchor the primary global tracking layout to either the exact **Top of screen** or **Bottom of screen**. It automatically handles offsets for logged-in users with active admin bars.
* **Bar Height:** Select a custom thickness from 1px up to 50px.
* **Progress Bar Color:** Match your brand identity with a custom hexadecimal color picker for the filled indicator.
* **Background Track Color:** Control the base color layer that fills in behind the scrolling progress bar line.
* **Post Type Scope Visibility:** Toggle global sticky tracking independently for standard **Posts**, static **Pages**, or **Custom Post Types**. Note: Global tracking intentionally skips index loops like your home page or main posts feed to optimize readability.

=== Shortcodes ===

The plugin includes a dedicated shortcode that allows you to embed localized inline progress bars directly anywhere within your template markup, page builders, or theme widget regions.

`[reading_progress_bar]`

= Usage Examples =

* Standard embedded implementation: `[reading_progress_bar]`

When wrapped inside your content, the inline shortcode adopts your central admin height and color rules, mapping its completion width relative to the visitor's global page scroll position.

=== Gutenberg Block ===

Reading Progress Bar includes a native, custom block block for the WordPress Block Editor (Gutenberg), allowing you to manually place contextual indicators directly into post grids or individual narrative columns.

= How to use the Gutenberg Block =

1. Launch the block editor on any compatible Post or Page layout.
2. Click the **(+)** inserter icon or type `/reading-progress-bar` inline.
3. Select the **Reading Progress Bar** block from the widgets panel.
4. An placeholder block labeled `📖 [Reading Progress Bar Placeholder Element]` will render within your workspace layout.
5. Save or publish the document. On the frontend, the block automatically initializes a localized progress component styled according to your dashboard settings.

== Installation ==

= Minimal Requirements =

* WordPress version 6.0 or higher
* PHP version 8.0 or higher

= Automated Dashboard Installation =

1. Navigate to **Plugins → Add New** inside your WordPress admin dashboard.
2. Click the **Upload Plugin** button located at the top of the interface.
3. Choose the compressed `reading-progress-bar.zip` archive file from your computer.
4. Click **Install Now**, wait briefly for the decompression step, and click **Activate Plugin**.

= Manual FTP Installation =

1. Safely decompress the raw `.zip` archive to extract the clean `reading-progress-bar` source folder.
2. Establish an active SFTP/FTP server connection to your remote website environment.
3. Transfer the uncompressed directory into your public file structure under `/wp-content/plugins/`.
4. Log into your dashboard workspace, access the **Plugins** menu grid, locate **Reading Progress Bar**, and click **Activate**.

== Frequently Asked Questions ==

= Does this plugin affect my Google PageSpeed or Core Web Vitals scores? =
No. The frontend relies exclusively on native vanilla JavaScript that is execution-throttled using browser-native `requestAnimationFrame` loops. It avoids heavy third-party framework wrappers, uses minimal CSS assets, and guarantees zero layout shifts (CLS), keeping performance footprint practically invisible.

= Does the global progress bar display on my primary homepage feed? =
No. The plugin includes structural template checks that intentionally disable the sticky tracking bar across home pages, post indexes, and front page archive grids. Tracking loads automatically on specific singular templates matching your designated settings panel choices.

= What happens if I completely uninstall the plugin? =
The plugin follows strict clean-uninstallation procedures via an automated `uninstall.php` script. The moment you click delete within your plugins interface, all configuration values saved within the `rpb_settings` option array are instantly wiped from your database, leaving behind no digital footprint.

= Is the global sticky layout compatible with the WordPress admin toolbar? =
Yes. The plugin stylesheet includes specific fallback style rules targeting the `.admin-bar` utility selector. If a logged-in operator scrolls through a monitored entry, the top progress bar repositions its anchor coordinate to clear the admin bar area on both mobile layouts and desktop resolutions.

== Changelog ==

= 1.0.0 =

* Initial public production release.
* Added native Settings API dashboard control panel under Settings -> Reading Progress Bar.
* Introduced vanilla JavaScript core scroll depth algorithm with performance optimization via requestAnimationFrame.
* Created standalone layout template blocks with native clean CSS transition states.
* Added standard block editor registration framework and programmatic shortcode rendering support.
* Integrated strict clean data cleanup hooks via uninstall.php.

== Upgrade Notice ==

= 1.0.0 =
Initial deployment release version. Enjoy clean, fast, and secure reading progress tracking on your WordPress articles.