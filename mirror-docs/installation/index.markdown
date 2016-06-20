---
author: linton
comments: true
date: 2013-11-01 15:55:44+00:00
layout: page
slug: installation
redirect_from:
 - /installation
title: 'Mirror Standalone: Installation & System Resquirements'
id: 337
---

### System Requirements


Mirror has been tested on the following systems:



	
  * Android 4.2.2 (API level 17)

	
  * Mac OSX 10.8.4

	
  * Windows 7 64-bit

	
  * Ubuntu 13.04 64-bit


If your OS isn’t listed here, Mirror might still work for you!

Development environment requirements:

	
  * Java SE 6+

	
  * Android SDK 22+

	
  * Android platform 17 (download from Android SDK Manager): this is needed to run the sample project.




### Installing and Running Mirror





1. On your computer, [download ](/mirror-downloads)the .zip file of Mirror Server, and extract it to a directory.

2. Mac OSX
   1. Copy the resulting "Mirror Server" app to your "Applications" folder.
   2. Run the app.




	
3. Linux (or Windows):
  
   1. Find the "mirror" (or "mirror32bit.bat" or "mirror64bit.bat" on Windows) script in the "bin" directory.
   2. Run the script.




	
4. Follow the on-screen instructions to set up the path to your Android SDK (or [download one](http://developer.android.com/sdk/installing/studio.html) if you don't have it yet).

	
5. Connect your devices to your computer and enable ADB debugging on them.

	
6. Hit "Start" in Mirror Server.

	
7. See the live previews start flowing!




### Eclipse Setup


You may want to **disable** the following eclipse option in order to take full advantage of custom view previewing:

Window -> Preferences -> Android -> Build -> Skip packaging and dexing until export or launch

This will allow Mirror to take advantage of Eclipse's incremental build process and display the latest version of your custom view classes as you modify your project.
