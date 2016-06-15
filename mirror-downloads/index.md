---
layout: page
author: linton
comments: true
date: 2014-06-03 19:02:55+00:00
title: Mirror Downloads(Free 30-day trial)
id: 512
permalink: /mirror-downloads/
---


By downloading jimu Mirror on this site or via JetBrain's plugin repository, you agree to jimu Labs' [End User License Agreement](/mirror-eula)





### If you use Android Studio 1.4, 1.5 or 2.0





##### Method 1: from JetBrains plugin repository





In Android Studio/IDEA, `Configure -> Plugins -> Browse repositories... -> Search "jimu Mirror" -> Install`





<p><a class="button blue medium" href="/mirror-android-studio-plugin-installation-guide/">See installation guide</a></p>




##### Method 2: install the plugin zip file:





<p><a class="button green medium" href="http://bit.ly/1YdU439">Download Mirror 2.5.9 for Android Studio 1.4+</a></p>





In Android Studio/IDEA, `Configure -> Plugins -> install plugin from disk`, and then choose the downloaded zip file.





### If you use Android Studio 1.3 / IntelliJ IDEA 





<p><a class="button green medium" href="http://bit.ly/1VDPMPR">Download Mirror 2.5.7 for Android Studio 1.3 / IDEA</a></p>





### If you use other IDEs or editors





Tip: if your projects are gradle-based, but you want to edit the files using other editors, just start the Mirror Android Studio plugin and it will pick up changes you made outside of Android Studio too.





**If your project uses third-party libraries and library projects, Mirror tries its best to detect library locations but manual configuration may still be needed. See [this page](/project-configuration-in-mirror-server/) for details. The Android Studio plugin does a much better job detecting project configuration because of the information available in Studio.**





##### Download Mirror Standalone:





[[ Mac OSX ]](http://bit.ly/1U0DKT2) [[ Windows ]](http://bit.ly/1U0DJyc) [[ Linux ]](http://bit.ly/1YdU43d)





##### Docs:





[[ Installation & System Requirements ]](/installation)  [[ Project Setup ]](/project-configuration-in-mirror-server)





##### [Older versions](mirror-older-versions/)





* * *









# Getting started





See this [tutorial](/mirror-tutorial) that will help you create realistic app previews with Mirror. More detailed documentation can be found [here](/mirror-docs/).





* * *













# Change log





## 2.5.9 - Mar 4, 2016







  * Support Android Studio 2.0 beta 6


  * Support devices running Android Marshmallow (6.0)


  * Removed SD card permissions


  * Fixed the "Unknown device" error


  * Improved search in layout list of the Mirror client





## 2.5.8 - Jan 12, 2016







  * Support for previewing layouts with Databinding attributes


  * Fixed the issue when Android Gradle plugin 1.5 or higher is used


  * Fixed the issue on Android Studio 2.0


  * Fixed the issue when Retrolamda is used





## 2.5.7 - Oct 6, 2015







  * Fixed a `FileNotFoundException` when appcompat v7-23 is used but targetSdkVersion is set to 22 or lower


  * Fixed a "Failed to copy dex file" error when starting Mirror the first time


  * Fixed the errors when hot-reloading classes that use Butterknife





## 2.5.6 - Oct 2, 2015







  * Support for Android Studio 1.4


  * Enable debug mode -- you can now use features of the Android Studio debugger (e.g. breakpoints) on sandbox classes and view classes used in the layout


  * Support for nested `<content>` tags


  * Fixed a `ClassNotFound` error when multidex is enabled and the min sdk is 21 or above


  * Properly retrieve build tools version when it's defined as a property


  * Fixed an issue that complains about a non-existent resources directory





## 2.5.5 - June 18, 2015







  * Fixed an issue that prevented Mirror from working with the Design Support Library (Existing users: click "Reload custom views" button)


  * Fixed an error when build tools "23.0.0 rc2" is used


  * Fixed an issue that prevented Mirror from properly restarting in some cases


  * Feature: Three-finger tap to restart a preview screen on a device -- particular useful for [debugging animations](https://www.youtube.com/watch?v=uUNDPo7VJSI)





## 2.5.4 - June 3, 2015







  * Fixed an error on Android Studio 1.3


  * Fixed the error which occurred when targetSdkVersion is set to "MNC"





## 2.5.3 - May 21, 2015







  * Better support for previewing layouts in library modules


  * Fixed an issue that caused the "isn't an Android module" error


  * Fixed an issue caused Mirror to fail when a lib module is inside a sub-directory that happens to have the same name as another module


  * Fixed an issue that disabled start/stop button when the toolbar is turned off





## 2.5.2 - April 29, 2015







  * Support for appcompat 22.1.x and older appcompat libraries (If you have used Mirror for your project, click "Reload custom views" to fix any potential NoClassDefFoundErrors)


  * Fixed an issue that prevented the screen overlay from working properly when AppCompat themes are used


  * Fixed an issue when migrating mirror files generated by older versions of Mirror





## 2.5.1 - April 8, 2015







  * Mirror now calls the static method `$init(Context)` in your sandbox class. In this method, you can put initialization code that needs to run before views are created. This makes it possible to run Mirror together with Stetho. See [the mirror-sandbox README](/mirror-sandbox/) for more details.


  * Fixed an issue that prevents reflections from running properly on Lollipop devices


  * Improved the method that picks up JDK location as specified in Studio/IDEA.


  * Fixed an issue that causes errors in Android Studio / IDEA


  * Fixed an issue that breaks IDEA's update function in some situations


  * Improved error messages





## 2.5 - March 24, 2015







  * Beta features (you can turn them off in "Tools -> Mirror"



    * Java and Kotlin code hot-swapping! - See [this post](/2015/01/building-android-animations-mirror-sandbox-piecewise/) for more information.


    * An REPL-esque environment for UI development with the "mirror-sandbox" library - See [this post](/2015/01/building-android-animations-mirror-sandbox-piecewise/) for more information.




  * Previewing projects built with the [multi-dex](https://developer.android.com/tools/building/multidex.html#avoid) option


  * Previewing projects with [Flavour Dimensions](http://tools.android.com/tech-docs/new-build-system/user-guide#TOC-Multi-flavor-variants)


  * Bug fixes and UI improvements





## 2.3.3 - Mar 6, 2015







  * Fix a bug that prevents Mirror from working correctly when there are no layouts in the "res" directory of a build flavour or build type


  * Properly calculate time saved





## 2.3.2 - Feb 11, 2015







  * Sample data support for multi-flavour projects. You can now populate layouts in your variant res directories (such as `freeDebug`) with sample data. See the `README.txt` in the `mirror` directory after Mirror is started


  * Fixed the "Pre-verified class resolved to an unexpected implementation" error when previewing subclasses of support library widgets, such as `RecyclerView` or `ViewPager`


  * Properly include "assets" directory in flavor/variant directories such as `debug`


  * Fixed a `NullPointerException` when previewing layouts with `RecyclerView`s


  * Calculate and show how time you have saved since you started using Mirror


  * Improved error messages





## 2.3.1 - Dec 18, 2014






            
  * The value of isInEditMode can now be toggled in a mirror file by adding an attribute: `<screen inEditMode="false">`

            
  * Changes to the manifest file are now properly picked up.

            
  * Fixed "No resource found" issue for resources purely generated by gradle, such as resValue "string", "foo", "bar" in build.gradle

            
  * Fixed a crash when GridLayout is used

            
  * Removed unnecessary resource refreshes when Mirror starts. This should fix a "Class Not Found" issue even when the dex file is present.

            
  * Fixed an issue that prevented Mirror Standalone from finding connected devices





## 2.3 - Dec 4, 2014







  * Support for Material themes (Theme.AppCompat etc) and view tinting


  * Support for populating AppCompat Toolbars with menu attribute in mirror sample data. For example, 
    <div id="crayon-575fbf96dd73e893822860" class="crayon-syntax crayon-theme-arduino-ide crayon-font-droid-sans-mono crayon-os-mac print-yes notranslate" data-settings=" minimize scroll-mouseover" style=" margin-top: 12px; margin-bottom: 12px; font-size: 12px !important; line-height: 15px !important;">
  	<div class="crayon-toolbar" data-settings=" mouseover overlay hide delay" style="font-size: 12px !important;height: 18px !important; line-height: 18px !important;"><span class="crayon-title"></span>
  	<div class="crayon-tools" style="font-size: 12px !important;height: 18px !important; line-height: 18px !important;"><div class="crayon-button crayon-nums-button" title="Toggle Line Numbers"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-plain-button" title="Toggle Plain Code"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-wrap-button" title="Toggle Line Wrap"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-expand-button" title="Expand Code"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-copy-button" title="Copy"><div class="crayon-button-icon"></div></div><div class="crayon-button crayon-popup-button" title="Open Code In New Window"><div class="crayon-button-icon"></div></div><span class="crayon-language">Ruby</span></div></div>
  	<div class="crayon-info" style="min-height: 16.8px !important; line-height: 16.8px !important;"></div>
  	<div class="crayon-plain-wrap"><textarea wrap="soft" class="crayon-plain print-no" data-settings="dblclick" readonly style="-moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4; font-size: 12px !important; line-height: 15px !important;">
&lt;toolbar title="Title" menu="@menu/main"/&gt;</textarea></div>
	<div class="crayon-main" style=" max-height: 800px;">
	<table class="crayon-table">
	<tr class="crayon-row">
	<td class="crayon-nums " data-settings="show">
	<div class="crayon-nums-content" style="font-size: 12px !important; line-height: 15px !important;"><div class="crayon-num" data-line="crayon-575fbf96dd73e893822860-1">1</div></div>
	</td>
	<td class="crayon-code"><div class="crayon-pre" style="font-size: 12px !important; line-height: 15px !important; -moz-tab-size:4; -o-tab-size:4; -webkit-tab-size:4; tab-size:4;"><div class="crayon-line" id="crayon-575fbf96dd73e893822860-1"><span class="crayon-o">&lt;</span><span class="crayon-i">toolbar</span><span class="crayon-h"> </span><span class="crayon-v">title</span><span class="crayon-o">=</span><span class="crayon-s">"Title"</span><span class="crayon-h"> </span><span class="crayon-v">menu</span><span class="crayon-o">=</span><span class="crayon-s">"@menu/main"</span><span class="crayon-o">/</span><span class="crayon-o">&gt;</span></div></div></td>
	</tr>
	</table>
	</div>
	</div>


  * Performance improvement. It's now faster to preview projects with lots of images.


  * Fixed an issue that might cause Mirror Standalone to report 0 connected devices.


  * Improved error messages





## 2.2.1 - Nov 5, 2014







  * Made Mirror compatible with Android Studio 0.9


  * Fixed bug that prevent CardView styling from working correctly


  * Improved generation of sample data files


  * Added support for View#isInEditMode -- will return true in custom views being previewed with Mirror


  * Added a toolbar action to reload custom views





## 2.2 - Oct 29, 2014







  * Initial support for RecyclerView in sample data


  * Fixed an error when using v21 support library custom views


  * Fixed an error that sometimes prevented the trial from starting properly





## 2.1.4 - Oct 1, 2014







  * Fixed bug that prevented Mirror from working correctly in IntelliJ IDEA Ultimate Edition


  * Improved detection of system build tools


  * Minor improvements in MirrorMail sample project for users of Mirror standalone version





## 2.1.3 - Sep 22, 2014







  * Fixed incorrect "resource is already defined" errors when the same resource is declared in multiple dependencies


  * Fixed bug where the standalone version of Mirror wouldn't start properly if the target SDK version is not set





## 2.1.2 - Sep 17, 2014







  * Fixed critical bug that prevented fresh installs from working correctly


  * Fixed bug where generated sample data files were sometimes not monitored for changes





## 2.1.1 - Sep 10, 2014







  * Fixed crash when using Mirror on an emulator with no SD card


  * Fix confusing sample data elements that were previously generated


  * Keep smaller error logs, and remove old error logs





## 2.1 - Aug. 26, 2014







  * Empty "tools" attributes now have the effect of removing the corresponding "android" attribute, to be consistent with Android Studio


  * A number of bugs regarding multiple project windows and the module selection dropdown have been fixed


  * Error report dialog contains a new, optional field for including the Mirror console content


  * Mirror no longer needs to be restarted when the targetSdkVersion is changed





## 2.0.8 - Aug. 19, 2014






  
  * Android Studio plugin improvements
    
      
    * Fixed bug where library projects in sub-directories were not recognized

      
    * Adjusted precedence of library project resources to be consistent with Android Studio

      
    * Added an error report function that can be accessed from the Mirror console

      
    * Added a link to the Mirror Google+ community

    
  





## 2.0.7 - Aug. 12, 2014






  
  * Mirror now works with Android Studio 0.8.5

  
  * Custom views are now supported when mirroring a library module

  
  * The Android Studio plugin is now distributed via [JetBrains plugin repository](http://plugins.jetbrains.com/plugin/7517?pr=). The old update popup is removed in favor of IDEA's update system. (**Note:** As of this writing, Android Studio Beta appears to have issues checking updates even for Studio itself. Studio Canary seems to work better.)





## 2.0.6 - Aug. 6, 2014






  
  * Generated sample data files no longer create "text" and "src" attributes by default. This overrode layout files and was confusing.

  
  * Comments and examples in generated sample data have been improved

  
  * The Android Studio plugin now uses HTTP proxy settings from the IDE settings (**Note:** you'll need to restart Android Studio/IDEA after changing the HTTP proxy settings)

  
  * Library project assets are now monitored for changes, in the same way resources already were

  
  * The Android Studio plugin is now distributed via [JetBrains plugin repository](http://plugins.jetbrains.com/plugin/7517?pr=). The old update popup is removed in favor of IDEA's update system. (**Note:** As of this writing, Android Studio Beta appears to have issues checking updates even for Studio itself. Studio Canary seems to work better.)




## 2.0.5 - July 29, 2014







  * Support for previewing "tools" namespace attributes
  
  
    * These will override "android" namespace attributes but will be overridden by attributes set in sample data

  
    * The tools attributes that are not normal layout attributes are **not** supported at this time (namely those found on [this page](http://tools.android.com/tech-docs/tools-attributes).

  



  * Fixed how library projects are handled to avoid "resource already defined" errors when a library project is indirectly depended on multiple times





## 2.0.4 - July 23, 2014







  * Initial support for 'tools' namespace attributes
  
  
    * 'tools' attributes in layout files will be active when the layout is previewed with Mirror

  
    * Attributes specified in sample data will override 'tools' attributes

  
    * **Limitation:** currently only 'tools:text', 'tools:src', and 'tools:visiblity' are supported; expect general support in the next release (July 29)

  



  * Fixed bug where Mirror would keep running after switching projects in Android Studio


  * Fixed bug where the Mirror "Start/Stop" button in Android Studio would sometimes stay greyed out


  * Fixed MirrorMail sample project to work properly with Android Studio 0.8




## 2.0.3 - July 15, 2014







  * Support for L Developer Preview and Material themes
  
  
    * **Note:** Apps with a targetSdkVersion of 'L' can only be previewed on devices running the L preview

  



  * Added a toggle option for whether or not Mirror console opens when there's an error
  
  
    * Tools > Mirror > Show Mirror console when errors occur

  



  * Improved error reporting





## 2.0.2 - July 7, 2014







  * Mirror should work on both Android Studio 0.8 (and 0.8.1) and IntelliJ IDEA 13.1.3 now. Thanks for the patience!


  * Very initial Android Wear support:


    * connect Android Wear devices via USB cable (adb)


    * tap the watch face to wake it up (otherwise the Mirror preview app wouldn't open)


    * start Mirror and use it normally





  * Mirror console in Android Studio will now be automatically brought up when there is an error.


  * 
**Note:** the Android L preview is NOT supported at this point. If you try to preview a project with target SDK version "L", you'll get an error. We'll get it working in the next release!





## 2.0.1 - June 23, 2014






  
  * Fixed a bug that might cause issues when starting a trial or activating Mirror.

    
      
    * **If you have activated Mirror before**, you might see an "Invalid license" error, just enter the license key and activate Mirror again and everything will be normal. Sorry for the inconvenience!

      
    * **If you have started a trial before**, you might be taken to the welcome screen again, just start a new trial and you'll get a few more days to try Mirror.

    
  
  * Allowed `items` and `_item` to be nested. This is useful to have a horizontal list inside a vertical list.

  
  * Improved some error messages





## 2.0 - June 16, 2014





Mirror 2.0 is easy to get started with and integrates with you and your team’s workflow.







  * **Android Studio plugin** makes Mirror more convenient and more useful. One-click to start preview, no configuration needed.


  * **Auto-install** — Mirror preview app automatically installs from your machine. From 2.0, Mirror no longer requires a separate download from Google Play. This means you can use it on Genymotion, SDK emulators and other custom devices with ease.


  * **Hi-fidelity prototypes** — As always, you can create high-quality “app previews” using Android resources and Mirror sample data, and share them with coworkers or clients. Mirror lets you populate list views, fragments, view pagers and more with sample data and preview the UI long before the app is finished.





## [Older versions](/mirror-1-x-change-log/)


