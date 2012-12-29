=== Post via Dropbox ===
Contributors: PaoloBe
Tags: dropbox, post via dropbox, remote update, post, posting, remote
Requires at least: 3.0.0
Tested up to: 3.4
Stable tag: 1.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Post via Dropbox allows you to post or edit your blog with text files uploaded via Dropbox.

== Description ==

**Post via Dropbox** is a easy way to update your blog using **Dropbox**, the famous cloud sharing service. It permits to add or edit your posts with text files uploaded via Dropbox.

Once you linked your Dropbox Account, you can upload text files into your Dropbox folder for updating your blog. Inside text files you should use some specific tags, like [title] [/title] and [content] [/content] for adding or modifying informations of the post (please, read faqs for more information).

Everything happens automatically and without further actions on your part.

Post via Dropbox requires **Wordpress 3.0 (and above), PHP 5.3.0 (and above) and a Dropbox account**.


== Installation ==

1. Upload the contents of post-via-dropbox.zip to the /wp-content/plugins/ directory or use WordPress's built-in plugin install tool.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to 'Settings' -> 'Post via Dropbox' menu, link your Dropbox account and configure the plugin.

== Frequently Asked Questions ==

= How it works? =

Post via Dropbox checks automatically, through built-in cron function of WordPress, the existance of new files in your Dropbox folder and then it proceeds to update your blog. 

= Where do I upload my text files? =

Text files must be uploaded inside **Dropbox/Apps/Post_via_Dropbox/** . Once posted, the text files is moved into subidirectory "posted", if you have not selected "delete" option.


= How should be the text files? =

The text file may have whatever extensions you want (default .txt) and it is strongly recommended that it has UTF-8 encoding. Why WordPress is able to read informations in proper manner, you must use some tags like [title] [/title] and [content] [/content].

= Which are tags that can be used inside text files? =

* **[title]** post title **[/title]** (mandatory)
* **[content]** the content of the post **[/content]** (mandatory)
* **[category]** category, divided by comma **[/category]**
* **[tag]** tags, divided by comma **[/tag]**
* **[status]** post status (publish, draft, private, pending, future) **[/status]**
* **[excerpt]** post excerpt **[/excerpt]**
* **[id]** if you want to modify an existing post, you should put here the ID of the post **[/id]**
* **[date]** the date of the post (it supports english date format, like 1/1/1970 00:00 or 1 jan 1970 and so on, or UNIX timestamp) **[/date]**
* **[sticky]** stick or unstick the post (use word 'yes' / 'y' or 'no' / 'n') **[/sticky]**
* **[customfield]** custom fields (you must use this format: field_name1=value & field_name2=value ) **[/customfield]**
* **[taxonomy]** taxonomies (you must use this format: taxonomy_slug1=term1,term2,term3 & taxonomy_slug2=term1,term2,term3) **[/taxonomy]**
* **[slug]** the name (slug) for you post **[/slug]**
* **[comment]** comments status (use word 'open' or 'closed') **[/comment]**
* **[ping]** ping status (use word 'open' or 'closed') **[/ping]**

The only necessary tags are [title] and [content]


= How can I edit an existing post? =

You need to specify the ID of the post, there're two ways: 1) using [id] tag or 2) prepend to filename the ID (example: 500-filename.txt).
The quickest way to edit an existing post, already posted via Dropbox, is move the file from the subfolder 'posted' to the principal folder.

== Screenshots ==

1. Options page

== Changelog ==

=1.10=
* Fixed minor bugs
* Added new features (Date, Custom fields, Taxonomies, Sticky, Comment/Ping status, Slug name support)



=1.00=
* Initial release
