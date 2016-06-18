---
author: linton
date: 2014-08-27 15:36:02+00:00
layout: page
slug: mirror-docs
title: Documentation
id: 591
---






## Documentation








[[ Release Notes ]]({{site.baseurl}}/mirror-downloads/#change-log)  |  [[ Tutorial ]]({{site.baseurl}}/mirror-tutorial)  |  [[ Sample Data Specification ]]({{site.baseurl}}/sample-data-specifications) | [[ Custom Attributes ]]({{site.baseurl}}/sample-data-attributes/)




**Mirror Android Studio plugin:**




[[ Installation Guide ]]({{site.baseurl}}/mirror-android-studio-plugin-installation-guide/) | [[ Mirror.js guide for designers ]]({{site.baseurl}}/mirror-js-designer-guide)




**Mirror Standalone:**




[[ Installation & System Requirements ]]({{site.baseurl}}/installation) |  [[ Project Setup ]]({{site.baseurl}}/project-configuration-in-mirror-server)








* * *





### FAQ






    

#### Does Mirror preview my entire app, or just the layouts?


    

The answer is somewhere in between. Mirror makes use of your apps resources, meaning its layouts, drawables, animations, styles, colours, assets (typically custom fonts when used in custom views), etc. It also previews your custom views in layouts if a dex or apk file is specified, which is often automatically picked up when the project is added in MirrorServer. Mirror does not, however, use your Java code in activities, fragments or any other classes not referenced in your custom views.









    

#### How does it work?


    

Mirror has two components: a server program that runs on your computer and an app that runs on each preview device. The server watches your project directory and detects changes to resource files, sample data files and dex/apk files. When something is changed, the server packages up the resources for your project and sends them to the attached devices. The Mirror app renders the UI using the standard Android resource system, so the displayed preview will look exactly how it will when you run your app.











