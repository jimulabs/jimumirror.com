---
author: linton
comments: false
date: 2013-08-24 05:04:57+00:00
layout: page
redirect_from: 
- /mirror-1-x-change-log
slug: mirror-1-x-change-log
title: Mirror 1.x Change Log
id: 258
---

### 1.3 - March 5, 2014





*Make sure to use version 1.3 of both Mirror Server and the Android app.*{: style="color: red"}






    
  * Share previews with other Mirror users by email, Dropbox, etc.

    
  * Populate ViewPagers using sample data

    
  * Faster refreshes when editing sample data

    
  * Generated sample data files are much more useful

    
  * Server-side resource errors are highlighted in the Mirror app

    
  * Mark screens as favourites to keep them at the top of the list

    
  * Enforced compatibility between Mirror and Mirror Server to avoid errors

    
  * Better organization of mirror directory

    
  * Improved error reporting

    
  * Various bug fixes and minor improvements





### 1.2 - January 29, 2014





*Make sure to use version 1.2 of both Mirror Server and the Android app.*{: style="color: red"}





    
  * [Support for populating fragments]( /2014/01/fragments-transparent-overlay-and-mirrorres-directory) (Premium only)

    
  * [Transparent overlay]( /2014/01/fragments-transparent-overlay-and-mirrorres-directory) (Premium only)

    
  * Better error message for parse errors

    
  * Support for units in sample data dimensions

    
  * Sample data support for WebView

    
  * Support for snake_case custom attribute names

    
  * New resource directory "mirror/res"

    
  * Other small improvements and bug fixes





### 1.1.2 - January 10, 2014 (Happy new year!)





*Make sure to use version 1.1.2 of both Mirror Server and the Android app.*{: style="color: red"}





    
  * Fix ClassCastException when clicking on overflow menu, and other broken action bar behaviour

    
  * Store Mirror configuration outside of app bundle on OS X so projects don't need to be reconfigured after upgrading

    
  * Display proper error message when target SDK version can't be determined

    
  * Add support for string resources (instead of just string literals) in the "text" sample data attribute

    
  * Other small bug fixes and stability improvements





### 1.1.1 - December 16, 2013





*Make sure to use version 1.1.1 of both Mirror Server and the Android app.*{: style="color: red"}





    
  * Fix resource not found errors on some 4.4 devices

    
  * Fix out of memory errors

    
  * Fix error when previewing WebViews

    
  * Upgrade button on screen list for premium features

    
  * New privacy policy (see website or About page in app)

    
  * Other minor fixes and improvements





### 1.1 - December 3, 2013





*Make sure to use version 1.1 of both Mirror Server and the Android app.*{: style="color: red"}




Mirror 1.1 is finally ready!





#### All the Mirror 1.0 features are now free





All the functionality from previous releases, plus a bunch of bug fixes and minor improvements are available in the free Mirror app on the app store. Mirror Server (the bit that runs on your computer) is also free to download and use. Mirror 1.0 was already an extremely useful tool, and we want as many people as possible to enjoy it.





#### Premium features





Mirror 1.1 adds a couple of very useful premium features, available as an in-app purchase:





##### Custom views





We've put a lot of effort into stable support for custom views, and we're really excited to release this feature. Let us know how it works for you!






    
  * Mirror will correctly load custom views that are referenced in layouts

    
  * Custom attributes for custom views can be used in sample data

    
  * Works with views from your project and from library projects

    
  * Exceptions thrown from custom views are caught and displayed to help with debugging





##### Action bars





We've also added support for previewing action bars, so your app can look _exactly_ like it will in production.






    
  * Each sample data screen file can define an action bar

    
  * Set the title, icon, and menu items





### 1.0.4 - October 8, 2013





*Make sure to use version 1.0.4 of both Mirror Server and the Android app.*{: style="color: red"}





    
  * Putting an invalid theme name in a screen file is now handled better by the Mirror app

    
  * The Mirror Server application no longer hangs on OSX for some file paths in the "Project Path" field

    
  * Added support for multiple user profiles on Android 4.3 devices

    
  * Temporary files for unsaved Emacs files no longer cause an error when packaging resources

    
  * Fixed error that caused an "SD card almost full" message to appear on devices with a large amount of free space

    
  * Some other small UI improvements





### 1.0.3 - September 13, 2013





*Make sure to use version 1.0.3 of both Mirror Server and the Android app.*{: style="color: red"}






    
  * **Much better theme support**: Theme changes update automatically, no need to restart the preview manually!

    
  * Fixed a crash when a theme isn't specified or invalid in manifest.

    
  * Better error report on MirrorServer: errors will display in red.

    
  * Show a warning if the SD card is almost full.

    
  * Added check for missing layout directory.

    
  * Support setting visibility for all view types.

    
  * Ignore changes on files prefixed with "."

    
  * Try to read target version from project.properties if missing from manifest file.

    
  * Don't push changes or update version when resource packaging fails.





1.0.2 - September 6, 2013





*Make sure to use version 1.0.2 of both Mirror Server and the Android app.*{: style="color: red"}






    
  * **Initial theme support**

    
    * Mirror now uses the theme specified in manifest by default, and a different theme can be specified in the screen file using the new "theme" attribute. See [sample file spec](/sample-data-specifications/) and [tutorial](/mirror-tutorial/) for details.

    
    * At this point, the action bar and window attributes (background etc.) aren't updated until the preview is re-opened. We are working on an improvement.




    
  * **Free demo**: a free demo app is available that works with sample projects

    
  * Fixed a crash caused by invalid closing tag in screen files.

    
  * Fixed crash when using non-android themes

    
  * Server: watch file changes in specified library res directories.

    
  * Server: fixed bug: adding valid library does not enable the "OK" button

    
  * Server: ignore Vim .swp file changes

    
  * Server: add Google+ community link

    
  * Better error message when SD card not writable.

    
  * Populate: do not change original text when empty tags are used, e.g. <someView visibility="gone" />

    
  * New launcher icons





### 1.0.1 - August 23, 2013






    
  * Included required DLL files for Adb to run on Windows. This fixes a few issues that Windows users have reported so far, including devices not being found and DLL missing errors.

    
  * Fixed an issue that possibly prevents the Android app from receiving resource updates.

    
  * Fixed an issue in how the "count" attribute is interpreted.

    
  * Mirror Server to launch Google Play Store page of Mirror on devices without Mirror installed.

    
  * UI tweaks





1.0 - August 20, 2013






    
  * First release



