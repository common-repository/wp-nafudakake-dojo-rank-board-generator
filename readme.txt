=== WP-Nafudakake Dojo Rank Board Generator ===
Plugin Name: WP-Nafudakake Dojo Rank Board Generator
Version: 1.0
Plugin Homepage: http://tampaaikido.com/resources/wp-nafudakake/
Author Homepage: http://tampaaikido.com/instructors/sensei-guy-hagen/
Contributors: ghagen
Tags: shortcode, rank, dojo, martial art, school, members, students, nafudakake
Requires at least: 4.0.1
Tested up to: 4.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generates an attractive, traditional Japanese rank board (nafudakake) for your dojo or school website using shortcodes.

== Description ==

A ‘[nafudakake](https://en.wikipedia.org/wiki/Nafudakake)‘ is a traditional Japanese rank board, where members of a martial art school (Karate, Judo, Aikido, etc.) have their names displayed on wooden slats in order of seniority and divided by rank. These rank boards were used to show how large and respected a school is, to recognize the accomplishments of its students and the renown of its instructors, and to create a sense of community and belonging among a school's members.

This plugin generates an easily-managed and attractive virtual nafudakake which can be displayed using a shortcode.  It provides a simple drag-and-drop interface for creating and reordering name slats, and options for customizing the rank board's appearance to best match your site.  

== Installation ==
Like any other WordPress plugin, simply “add new” via the WordPress control panel “Plugins” control panel, or a) download the plugin archive directly from the link below; b) decompress the archive; c) upload the wp-nafudakake folder in its entirety to the wp-content>plugins folder of your WordPress installation.  Once it is installed, simply activate it using the Plugins control panel.

== Frequently Asked Questions ==

= What happens if I set up my board with 3 rows of slats, then reduce the number of rows to "2" in the settings menu? =

All the slats that were previously in the third row will be moved to the second row.

= Will the names on the slats be searchable by Google? =

Yes, the vertical orientation of the slat text is managed via CSS trickery, and the content is readable by search engines.

== Screenshots ==

1. Example live rank board.
2. Settings menu.
3. Rank Board “Drag-and-Drop” Editor.

== Changelog ==

= 1.0 =
First stable release

== Getting Started (Quick Start) ==
Before you will be able to add a new rank board to your website, you’ll need to create one.  Navigate to the “Rank Board” control panel menu, and select the “Editor”.  There you will see three rows – two empty rows and a “trash” row.  Simply add slats one at a time using the input field at the top of the editor, and drag them to the row where you want them displayed.  You can also change the order of slats by dragging them at any time.  If you wish to remove a slat or make a mistake, simply drag it into the “trash” row.  Be sure to save your changes!  Once you have created the rank board to your liking, you can adjust its appearance to your preference using the “Settings” menu, or insert the [rank board] shortcode into any of your WordPress pages or posts.

== Using the Drag-and-Drop Rank Board Editor ==
* *Adding New Slats*:	At the top of the Editor, you will find an input field and a dropdown menu. Simply type the text that you would like to appear in the new slat, select the type of slat you want it to be, and hit the “add” button. Most of your slats will be “name slats”, like “D Jones” or “M Ueshiba”, but you can structure the slat text to be whatever you like. You have three slat type options in the drop down: “name slat” for member names, “black belt divider” to create a black-themed slat to divide upper level ranks like “shodan”, “nidan”, “instructor”, “shihan” etc.; and “white belt divider” to create a differently themed slat to divide white belt (mudansha and unranked) student ranks.
* *Drag-and-Drop*:  Any new slats you create will be appended to the end of the top row. Simply click on the slat you want to move and arrange, and drag it to the location you want it to be; the other slats will automatical reorder and move out of the way. You can also drag slats between rows. Unfortunately, the first item in each row can sometimes be a little finicky about having a slat inserted in front of them, but if you try reordering the first item instead it should work fine for you (sorry, this is an artifact of the code library I’m using, and we’re stuck with this “feature”).
*  *Removing Slats*:  If you made a mistake or wish to delete a slat, just drag it to the “Trash” row. Slats in the Trash row will be removed when you save and exit, else otherwise you can empty the trash any time you like using the “Empty Trash” button at the top of the editor.

== Shortcodes ==
Once you have built your Rank Board in the editor to suit your liking, just insert the *[rank-board]* shortcode anywhere in your site’s posts or pages where you want your Rank Board to appear, and the plugin will do the rest!

== Shortcodes ==
Super thanks to [Ali Farhadi](http://farhadi.ir/projects/html5sortable/) for creating a great, minimal javascript drag-and-drop library!