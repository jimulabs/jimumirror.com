---
author: linton
comments: true
date: 2015-01-14 07:04:26+00:00
layout: page
slug: mirror-sandbox-beta-downloads
title: Mirror Sandbox Beta Downloads
id: 729
---

By downloading jimu Mirror on this site or via JetBrains plugin repository, you agree to jimu Labs' [End User License Agreement](/mirror-eula)





### Mirror Sandbox only supports Android Studio or IntelliJ IDEA (and gradle-based projects)





[Download Mirror sandbox-beta-4](http://bit.ly/17YQy89)





In Android Studio/IDEA, `Configure -> Plugins -> install plugin from disk`, and then choose the downloaded zip file. See [installation instructions](/mirror-docs/mirror-android-studio-plugin-installation-guide/#method2).





## Getting started





Check out this [blog post](/2015/01/building-android-animations-mirror-sandbox-piecewise/) for more details and a screencast. If you are not familiar with Mirror, see this [tutorial](/mirror-tutorial).





## Change log





### beta-4 - Mar 6, 2015







  * Kotlin code hot-swapping. If you need a sample project to experiment with, check out [this repo](https://github.com/jimulabs/road-trip-mirror).


  * mirror-sandbox repo restructuring: 



    * move animation related classes to its own repo, [motion-kit](https://github.com/jimulabs/motion-kit)


    * Rename `MirrorSandbox#enterSandbox()` to `$onLayoutDone`, and `destroySandbox()` to `$onDestroy`. The added `$` prefix says loudly "DO NOT CALL ME FROM PRODUCTION CODE".




  * Add some very simple mock data support. See `MockData` class


  * Various stability fixes





### beta-3 - Feb 12, 2015







  * Fixed compilation errors when used on Dagger2-based projects


  * Improved error messages





Merged From 2.3.2:

- Sample data support for multi-flavour projects. You can now populate layouts in your variant res directories (such as `freeDebug`) with sample data. See the `README.txt` in the `mirror` directory after Mirror is started 

- Fixed the "Pre-verified class resolved to an unexpected implementation" error when previewing subclasses of support library widgets, such as `RecyclerView` or `ViewPager`

- Properly include "assets" directory in flavor/variant directories such as `debug`
- Fixed a `NullPointerException` when previewing layouts with `RecyclerView`s

- Calculate and show how time you have saved since you started using Mirror
- Improved error messages





### beta-2 - Jan 21, 2015







  * Fixed an issue that causes Mirror fails to recognize library res directories


  * Fixed an issue that causes incorrect compilation errors when Java code is updated


  * Improved error messages





### beta-1 - Jan 14, 2015





Initial private beta release



