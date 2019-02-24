=== Recent Posts Widget With Thumbnails ===
Contributors: Hinjiriyo
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TKZZ3US2R56RY
Tags: images, posts list, recent posts, thumbnails, widget
Requires at least: 2.9
Requires PHP: 5.2
Tested up to: 5.0.3
Stable tag: 6.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

List the most recent posts with post titles, thumbnails, excerpts, authors, categories, dates and more!

== Description ==

List the most recent posts with post titles, thumbnails, excerpts, authors, categories, dates and more!

The plugin is available in English, German (Deutsch), Persian (فارسی), Arabic (العربية), Polish (Polski) Russian (русский), Turkish (Türkçe), Japanese (日本語) and Greek (Ελληνικά).

Although the plugin is build only for widget areas users reported that it **works also in Elementor**. Whether it runs in other page builders is unknown. Please let me know in which **page builder** you were able to use the plugin successfully.

The plugin does not collect any personal data, so it is ready for EU General Data Protection Regulation (GDPR) compliance.

= Lightweight, simple and effective =

No huge widget with hundreds of options. This plugin is based on the well-known WordPress default widget 'Recent Posts' and extended to display more informations about the posts like e.g. thumbnails, excerpts and assigned categories. And it provides more options to build custom-taylored posts lists.

The thumbnails will be built from the featured image of a post or of the first image in the post content. If there is neither a featured image nor a content image then you can define a default thumbnail.

You can set the width and heigth of the thumbnails in the list. The thumbnails appear left-aligned to the post titles in left-to-right languages. In right-to-left languages they appear right-aligned.

= What users wrote =

* **Number 8** in [14 Plugins para Otimizar seu Site](https://ideiasdig.com/14-plugins-para-otimizar-seu-site/#8Recent_Posts_Widget_With_Thumbnails) by Ideias Dig on November 8, 2018
* **"Truly EXCELLENT Plugin!"** in the [reviews](https://wordpress.org/support/topic/truly-excellent-plugin/) by dnuttal on October 11, 2018
* **"BEST of its KIND!!!"** in the [reviews](https://wordpress.org/support/topic/best-of-its-kind-32/) by shirtguy72 on June 3, 2018
* **"Easier than making an egg, seriously."** in the [reviews](https://wordpress.org/support/topic/easier-than-making-an-egg-seriously/) by djackofall on October 2, 2017
* **"This plugin is INCREDIBLE"** in the [reviews](https://wordpress.org/support/topic/do-you-also-have-one-for-most-popular-posts/) by lucio7 on August 25, 2017
* **Number 16** in [20 WordPress Plugins Every Blogger Needs to Increase Engagement](http://nocturnalthrive.com/2017/08/09/20-free-wordpress-plugins-every-blogger-needs/) by Nocturnal Thrive on August 9, 2017
* **Widgets Users Will Love** in [10 Ultra-Useful Free WordPress Widget Plugins](https://speckyboy.com/free-wordpress-widget-plugins/) by Eric Karkovack on June 16, 2017
* **listed** in [20 WordPress Plugins that Steals Attention to Engage Visitors of Your Site](https://wpteamsupport.com/wordpress-plugins-engage-visitors/) by WP Team Support on March 6, 2017
* **listed** in [Most useful  WordPress widget ready plugins](https://themeidol.com/most-useful-wordpress-widget-ready-plugins/) by Themeidol on February 5, 2017
* **Number 1** in [8 essential WordPress widgets to supercharge your website](https://www.nimbusthemes.com/8-essential-wordpress-widgets-to-supercharge-your-website/) by Rafay Ansari on January 31, 2017
* **"Excellent (after trying a few)!"** in the [reviews](https://wordpress.org/support/topic/excellent-after-trying-a-few/) by giorgissimo on January 6, 2017
* **Number 3** in [4 Best Sticky Widget Plugins for WordPress Websites](https://www.bloggerhit.com/sticky-widget-plugins-for-wordpress-websites/) by Purushottam Kadam on November 4, 2016

= What users filmed =

Some users published video tutorials on YouTube:

* [Class 09 - Working with Plugins (Recent Posts Widget With Thumbnails)](https://www.youtube.com/watch?v=dKoqcLBHhkM) by WordPress Learning Bangladesh on March 7, 2017
* [Recent Posts Widget With Thumbnails Setup Tutorial - WordPress Lesson and Tip](https://www.youtube.com/watch?v=qS9WIeaMb6s) by Making a Website on April 17, 2016
* [Add Recent Posts Widget with Thumbnail - WordPress](https://youtu.be/dqzz8NZc99Q) by eMediaCoach on August 15, 2015

= Options you can set =

1. Title of the widget
2. Number of listed posts
3. Open post links in new windows
4. Random order of posts
5. Hide current post in list
6. Show only sticky posts
7. Hide sticky posts
8. Keep sticky posts on top of the list if not hidden
9. Hide post title
10. Maximum length of post title
11. Show post author
12. Show post categories
13. Show post category names as links to their archives
14. Label for categories
15. Show post date
16. Show post excerpt
17. Show number of comments
18. Excerpt length
19. Signs after excerpt
20. Ignore post excerpt field as excerpt source (builds excerpts only from the post content)
21. Ignore post content as excerpt source (builds excerpts only from the excerpt fields)
22. Show posts of selected categories (or of all categories)
23. Show post thumbnail (featured image)
24. Registered thumbnail dimensions
25. Thumbnail width in px
26. Thumbnail height in px
27. Keep aspect ratio of thumbnails
28. Try to take the first post image as thumbnail
29. Only use the first post image as thumbnail
30. Use default thumbnail if no thumbnail is available
31. Default thumbnail URL
32. Print slugs of post categories in class attribute of LI elements
33. Print inline CSS instead of creating a CSS file
34. No CSS generation at all

= Much more options available in the Pro version =

If you want to build your special posts lists with additional options for layout, informations about each post and embedding via shortcode [take a look at the plugin Ultimate Post List Pro](https://shop.stehle-internet.de/downloads/ultimate-post-list-pro/).

= Useful hints for developers: Supported Hooks =

The plugin considers the output of actions hooked on:

1. widget_title
2. rpwwt_widget_posts_args
3. rpwwt_the_excerpt (for manual excerpts only)
4. the_excerpt (for all excerpts, is also applied after 'rpwwt_the_excerpt')
5. rpwwt_excerpt_more
6. rpwwt_excerpt_length
7. rpwwt_list_cats

= Useful hints for developers: Available CSS Selectors =

To design the list and its items you can use these CSS selectors:

The elements which contain the posts lists:
`.rpwwt-widget`

The lists which contain the list items:
`.rpwwt-widget ul`

All list items in the lists:
`.rpwwt-widget ul li`

All list items of sticky posts in the lists:
`.rpwwt-widget ul li.rpwwt-sticky`

All links in the lists; every link contains the image and the post title:
`.rpwwt-widget ul li a`

All images in the lists (use that to set the margins around images):
`.rpwwt-widget ul li a img`

All post titles in the lists:
`.rpwwt-widget ul li a span.rpwwt-post-title`

All post author in the lists:
`.rpwwt-widget ul li div.rpwwt-post-author`

All post categories in the lists:
`.rpwwt-widget ul li div.rpwwt-post-categories`

All post dates in the lists:
`.rpwwt-widget ul li div.rpwwt-post-date`

All post excerpts in the lists: 
`.rpwwt-widget ul li div.rpwwt-post-excerpt`

All numbers of comments in the lists: 
`.rpwwt-widget ul li div.rpwwt-post-comments-number`

= Languages =

The user interface is available in

* Arabic (العربية), kindly drawn up by [Shadi AlZard](https://profiles.wordpress.org/salzard)
* English
* German (Deutsch)
* Greek (Ελληνικά), kindly drawn up by Kostas Arvanitidis
* Japanese (日本語), kindly drawn up by [Kazuyuki Kumai](https://wordpress.org/support/users/kazuyk/)
* Persian (فارسی), kindly drawn up by [Sajjad Panahi](https://profiles.wordpress.org/asreelm)
* Polish (Polski), kindly drawn up by [Marcin Mikolajczyk](https://profiles.wordpress.org/marcinmik)
* Russian (ру́сский), kindly drawn up by [dmitriynn](https://profiles.wordpress.org/dmitriynn)
* Turkish (Türkçe), kindly drawn up by [Mehmet HAKAN](https://profiles.wordpress.org/memomelo)

Further translations are welcome. If you want to give in your translation please leave a notice in the [plugin's support forum](https://wordpress.org/support/plugin/recent-posts-widget-with-thumbnails).

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Recent Posts Widget With Thumbnails'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard
5. Go to 'Appereance' => 'Widgets' and select 'Recent Posts Widget With Thumbnails'

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `recent-posts-widget-with-thumbnails.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard
6. Go to 'Appereance' => 'Widgets' and select 'Recent Posts Widget With Thumbnails'

= Using FTP =

1. Download `recent-posts-widget-with-thumbnails.zip`
2. Extract the `recent-posts-widget-with-thumbnails` directory to your computer
3. Upload the `recent-posts-widget-with-thumbnails` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard
5. Go to 'Appereance' => 'Widgets' and select 'Recent Posts Widget With Thumbnails'

== Frequently Asked Questions ==

= What are the requirements for this plugin? =

The WordPress version should be at least 2.9 to use featured images.

The theme should support `wp_head()` in the HTML header section to print the CSS code for a beautiful alignment of the thumbnails.

= Can I set a default thumbnail? =

Yes. Type in the web address of the thumbnail and click on "Save". That's all.

= Can I set the width and height of the thumbnail? =

Yes. You can enter the desired width and height of the thumbnails or select one of the sizes as set in 'Settings' > 'Media'.

= Can I change the alignment of the thumbnails in the list? =

To keep the plugin lightweight: no. Please set the alignment in the CSS of your theme instead.

= Where can I set the CSS of the list? =

To keep the plugin lightweight: no. Please set the CSS in the Customizer at "Additional CSS".

= Can the plugin take the first image of a post as thumbnail image? =

Yes. It works with images previously uploaded into the media library. You can select to prefer the first image to the featured image or to use the first image only.

= How to keep HTML tags in the excerpts? =

Use the "Excerpt" box below the editor on a post edit page in the backend. The plugin uses those user-defined excerpts unchanged "as is".

If there is no text in the "Excerpt" box the plugin tries to build an excerpt via the post content. Since there is the "maximum length of the excerpt" option shortening the HTML content would lead to severe layout errors. So before shortening all HTML tags and shortcodes are removed.

= Where is the *.pot file for translating the plugin in any language? =

If you want to contribute a translation of the plugin in your language it would be great! You would find the *.pot file in the 'languages' directory of this plugin. If you would send the *.po file to me I would include it in the next release of the plugin.

== Screenshots ==

1. The first screenshot shows the widget in the sidebar with five teasers of current posts. Each list item shows the title, image, date, assigned categories and excerpt of a post.
2. The second screenshot shows the widget on the Widget Management Page in the backend.

== Changelog ==

= 6.5.0 =
* Added option to use only except fields as the source for excerpts
* Updated *.pot file and translations
* Tested successfully with WordPress 5.0.3
* Updated screenshot of widget in the backend

= 6.4.1 =
* Revised image size selection if a registered image size name is used
* Changed variable names in get_first_content_image_id()
* Changed initalization of variables site_protocol and site_url
* Tested successfully with WordPress 5.0.2

= 6.4.0 =
* Added option to omit CSS generation
* Moved option for CSS class names to section "Additional settings"
* Updated *.pot file and translations
* Updated screenshot of widget in the backend

= 6.3.1 =
* Fixed missing "more" links at excerpts from excerpt fields
* Fixed missing line break in the widget form

= 6.3.0 =
* Added option to show only sticky posts
* Added option to print inline CSS instead of writing it in a file
* Updated *.pot file and translations
* Updated screenshot of widget in the backend
* Tested successfully with WordPress 4.9.8

= 6.2.1 =
* Fixed missing sticky posts in category filtered lists
* Tested successfully with WordPress 4.9.7

= 6.2 =
* Added option for category names as links or not
* Added subheadlines in the widget for a more comprehensive appereance
* Updated *.pot file and translations
* Updated screenshot of widget in the backend
* Tested successfully with WordPress 4.9.5

= 6.1 =
* Added new filter hook 'rpwwt_the_excerpt' for manual excerpts
* Removed sanitation of the widget title to allow HTML code as output
* Tested successfully with WordPress 4.9.4

= 6.0 =
* Added option for custom category label
* Improved recognition of first images in post contents (now considers domain relative paths and protocol relative paths)
* Fixed missing deactivation of thumbnails in version 5.3
* Revised checks of variables
* Further refactoring to simplify code management
* Updated *.pot file and translations
* Updated screenshot of widget in the backend

= 5.3 =
* Added option to hide sticky posts
* Changed excerpt filter from 'the_content' to 'the_excerpt'
* Thorough refactoring to simplify code management
* Updated *.pot file and translations
* Tested successfully with WordPress 4.9.2

= 5.2.2 =
* Fixed missing feature opening links in excerpts in new windows
* Revised FAQ

= 5.2.1 =
* Added greek translation. Thank you, Kostas Arvanitidis!
* Tested successfully with WordPress 4.9.1

= 5.2 =
* Added option to set the 'more' text as link
* Updated *.pot file and some translations

= 5.1.2 =
* Added japanese translation. Thank you very much, [Kazuyuki Kumai](https://wordpress.org/support/users/kazuyk/)
* Tested successfully with WordPress 4.8.2

= 5.1.1 =
* Added turkish translation. Thank you very much, [Mehmet HAKAN](https://profiles.wordpress.org/memomelo)
* Added 'Requires PHP' info in readme.txt
* Tested successfully with WordPress 4.8.1

= 5.1 =
* Revised sanitations for texts and URLs on the pages
* Revised translations
* Tested successfully with WordPress 4.8

= 5.0 =
* Removed usage of cache
* Removed usage of extract()
* Improved: Faster check for found first image against being an image
* Tested successfully with WordPress 4.7.2

= 4.13.3 =
* Revised translation of author line

= 4.13.2 =
* Revised widget template for more conformity to WP standard widget output

= 4.13.1 =
* Tested successfully with WordPress 4.7

= 4.13 =
* Added option to print the post category slugs as class names at LI elements
* Fixed outdated URL to reviews
* Updated *.pot file and german translation

= 4.12 =
* Added option to ignore the post excerpt field as source of the excerpt
* Updated *.pot file and german translation

= 4.11 =
* Revised uninstall function for WordPress 4.6 due to the introduction of WP_Site_Query class
* Narrowed down loading of plugin's admin CSS file to Widgets page only
* Tested successfully with WordPress 4.6

= 4.10.2 =
* Fixed wrong length of excerpts

= 4.10.1 =
* Added chmod after creation of public.css to ensure correct file permissions
* Revised excerpt creation

= 4.10 =
* Fixed old-to-new posts sort order in some installations to force new-to-old sort order
* Fixed outdated translation
* Added russian translation. Thank you very much, [dmitriynn](https://profiles.wordpress.org/dmitriynn)
* Tested successfully with WordPress 4.5.2

= 4.9.2 =
* Added polish translation. Thank you very much, [Marcin Mikolajczyk](https://profiles.wordpress.org/marcinmik)
* Improved: Manual excerpts are taken unchanged ("as is")
* I18n description in the backend's plugin list
* Added link to more versatile plugin [Ultimate Post List Pro](https://shop.stehle-internet.de/downloads/ultimate-post-list-pro/)
* Tested successfully with WordPress 4.5
* Updated *.pot file and translations

= 4.9.1 =
* Improved integration of 3rd party plugins for effects on the thumbnail

= 4.9 =
* Added option: Open post links in new windows
* Renamed back: Hook 'rpwwt-widget-title' to 'widget-title' to let 3rd party plugins change the title
* Improved sanitizing of stored variables
* Updated *.pot file and translations
* Updated screenshot of widget in the backend

= 4.8 =
* Added option: Show post author
* Updated *.pot file and translations
* Updated screenshot of widget in the backend

= 4.7 =
* Added option: Random order of posts
* Updated *.pot file and translations
* Updated screenshot of widget in the backend
* Tested successfully with WordPress 4.4.2

= 4.6.2 =
* Renamed the hook names to avoid interferences with other functions of plugins and the theme. If you use these hooks for that plugin please change them: just place 'rpwwt_' before the hook names
* Improved: Last list item has no space anymore to the next widget to keep same spaces between widgets

= 4.6.1 =
* Fixed: widget title. Now if no title is entered no title is displayed (instead of showing the plugin's name)
* Fixed: commas in categories list. Commas are now internationalized (translated)

= 4.6 =
* Added option: Post categories
* Updated *.pot file and translations
* Updated screenshot of widget in the backend

= 4.5.1 =
* Moved comment checkbox to position after form fields for the excerpt options
* Tested successfully with WordPress 4.4

= 4.5 =
* Added option: Post title length
* Updated *.pot file and translations

= 4.4 =
* Added option: Show number of comments
* Updated *.pot file and translations

= 4.3.4 =
* Fixed search stop at more link
* Deleted visual intend of the linklist in some themes
* Refactored thumbnail size variable

= 4.3.3 =
Improved data sanitization

= 4.3.2 =
* Added widget description based on backend language
* Corrected text domain name for translate.wordpress.org
* Renamed translation files

= 4.3.1 =
* Little adaptions for language files, ready for translate.wordpress.org
* Updated *.pot file and translations

= 4.3 =
* Added arabic translation. Thank you very much, [Shadi AlZard](https://profiles.wordpress.org/salzard)
* Tested successfully with WordPress 4.3.1

= 4.2.1 =
* Fixed alignment of text and thumbnail in right-to-left (RTL) languages. Please re-save the widget to get the correct layout in RTL languages.

= 4.2 =
* Added persian translation (Farsi). Thank you very much [Sajjad Panahi](https://profiles.wordpress.org/asreelm)
* Tested successfully with WordPress 4.3

= 4.1 =
* Changed single selection of a category to selection of multiple categories
* Added DIV with id `rpwwt-{widget_id}` and class `rpwwt-widget` around list for available container with ensured attribute for CSS selectors
* Updated admin CSS
* Updated *.pot file and german translation
* Updated screenshot of widget in the backend
* Revised readme.txt

= 4.0 =
* Added category option: widget only lists posts of a selected category, else lists posts of all categories
* Added sticky posts option: widget shows sticky posts on top of the list, else lists them in normal order
* Added hide current post option: widget does not list the post where the user is currently on, else lists it
* Added CSS class names for easy designing of the list and its list items; see Description for details
* Added style sheet for Widget page in the backend
* Fixed missing custom image sizes in frontend
* Formatted the code more readable
* Updated *.pot file and german translation
* Updated screenshots
* Revised readme.txt

= 3.0 =
* Added default image sizes dropdown menu
* Added options to print out excerpts
* Refactored: HTML output moved into include files
* Slight improvements for security and performance
* Updated *.pot file and german translation
* Revised readme.txt

= 2.3.3 =
* Fixed error message on trial to open the CSS file
* Tested successfully with WordPress 4.2.2

= 2.3.2 =
* Fixed bug of wrong path to public.css file
* Changed HTML class names, now they start with 'rpwwt-'

= 2.3.1 =
* Set CSS for the list style to prevent dots in some themes
* Added span element with class "post-title" around the title
* Tested successfully with WordPress 4.2

= 2.3 =
* Added option to keep aspect ratios of the original images
* Added option to hide the post title in the list
* Moved inline CSS to external file
* Revised *.pot file and german translation

= 2.2.2 =
* Successfully tested with WordPress 4.1
* Fixed bug which threw a warning in debug mode when accessing options

= 2.2.1 =
* Fixed bug which prevented to find the first content image
* Slightly revised algorithm for detecting the first image in post content

= 2.2 =
Revised algorithm to detect the first image in post content.

= 2.1.1 =
Successfully tested with WordPress 4.0

= 2.1 =
* Improve uninstall routine
* Tested successfully with WordPress 3.9.2

= 2.0 =
* Added option to set width and height of the thumbnails
* Added option to prefer first content image to featured image
* Added option to use only first content image as thumbnail
* Added option to set a default thumbnail
* Added function to delete plugin's settings in the database if the plugin is deleted
* Improved code for more robustness
* Updated *.pot file and german translation

= 1.0 =
* The plugin was released.

== Upgrade Notice ==

= 6.5.0 =
Added option to use only except fields as the source for excerpts, updated translations, tested with WordPress 5.0.3

= 6.4.1 =
Revised image size selection if a registered image size name is used, small changes, tested with WordPress 5.0.2

= 6.4.0 =
Added option to omit CSS generation, moved option for CSS class names to section Additional settings

= 6.3.1 =
Fixed missing "more" links at excerpts from excerpt fields

= 6.3.0 =
Added options to show only sticky posts and to print inline CSS, tested with WordPress 4.9.8

= 6.2.1 =
Fixed missing sticky posts in category filtered lists, tested with WordPress 4.9.7

= 6.2 =
Added option for category names as links, added subheadlines in the widget, tested with WordPress 4.9.5

= 6.1 =
Added filter hook 'rpwwt_the_excerpt', removed widget title sanitation, tested with WordPress 4.9.4

= 6.0 =
Added custom category label, refactored, updated translations, updated screenshot

= 5.3 =
Added option to hide sticky posts, changed excerpt filter, refactored, tested with WordPress 4.9.2

= 5.2.2 =
Fixed missing feature opening links in excerpts in new windows, revised FAQ

= 5.2.1 =
Added greek translation, tested with WordPress 4.9.1

= 5.2 =
Added option to set the 'more' text as link, updated some translations

= 5.1.2 =
Added japanese translation, tested with WordPress 4.8.2

= 5.1.1 =
Added turkish translation, added Requires PHP info in readme.txt, tested with WordPress 4.8.1

= 5.1 =
Revised sanitations and translations, tested with WordPress 4.8

= 5.0 =
Revised code

= 4.13.3 =
Revised translation of author line

= 4.13.2 =
Revised widget template

= 4.13.1 =
Tested successfully with WordPress 4.7

= 4.13 =
Added category names option, updated german translation

= 4.12 =
Added ignore excerpt field option, updated german translation

= 4.11 =
Revised uninstall function, CSS file in Widgets page only, tested with WP 4.6

= 4.10.2 =
Fixed wrong length of excerpts

= 4.10.1 =
Added chmod, revised excerpt creation. Please readjust the excerpt length if neccessary!

= 4.10 =
Force new-to-old sort order, added russian translation, tested with WP 4.5.2

= 4.9.2 =
Some text improvements, polish translation, tested with WP 4.5

= 4.9.1 =
Improved integration of 3rd party plugins on the thumbnail

= 4.9 =
Added option: Open link in new window; renamed back: hook 'rpwwt-widget-title' to 'widget-title'

= 4.8 =
Added option: Show post author

= 4.7 =
Added option: Random posts order

= 4.6.2 =
Renamed the hook names to avoid interferences: just place 'rpwwt_' before the hook names. Small CSS improvement

= 4.6.1 =
Fixed empty widget title, comma internationalization

= 4.6 =
Added option: Post categories

= 4.5.1 =
Moved comment checkbox, tested with WordPress 4.4

= 4.5 =
Added option: Post title length

= 4.4 =
Added option: Show number of comments

= 4.3.4 =
Fixed search stop at more link

= 4.3.3 =
Improved data sanitization

= 4.3.2 =
Added widget description based on backend language, corrected text domain name

= 4.3.1 =
Little adaptions for language files, updated translations

= 4.3 =
Added arabic translation

= 4.2.1 =
Fixed alignment of text and thumbnail in right-to-left (RTL) languages. Please re-save the widget to get the correct layout in RTL languages.

= 4.2 =
Added persian translation (Farsi)

= 4.1 =
Changed single selection of a category to multiple categories

= 4.0 =
Added options: sticky posts, current post, category filter; revised code

= 3.0 =
Added options: image sizes and excerpt

= 2.3.3 =
Fixed error message on trial to open the CSS file

= 2.3.2 =
Fixed CSS bug

= 2.3.1 =
Slight CSS improvements, tested successfully with WordPress 4.2

= 2.3 =
Refactored. Please update the settings of the widget after upgrading the plugin

= 2.2.2 =
Successfully tested with WordPress 4.1, fixed a minor bug

= 2.2.1 =
Bugfixed and improved algorithm for detecting the first image in post contents

= 2.2 =
Revised algorithm for detecting the first image in post content

= 2.1.1 =
Successfully tested with WordPress 4.0

= 2.1 =
Improved uninstall routine, tested with WordPress 3.9.2

= 2.0 =
More options and improved code

= 1.0 =
First release.
