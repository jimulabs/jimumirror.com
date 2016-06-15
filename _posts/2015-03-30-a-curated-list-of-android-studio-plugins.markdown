---
author: linton
comments: true
date: 2015-03-30 22:13:37+00:00
layout: post
published: false
slug: a-curated-list-of-android-studio-plugins
title: A curated list of Android Studio plugins
id: 751
categories:
- Features
---

Android Studio makes Android development easier than ever. What makes us developers love it even more? It's the ever-growing [list](https://plugins.jetbrains.com/?androidstudio) of plugins that improve our workflow in many ways.





In this post, I'll share our pick of plugins that have delighted us. My goal is to list only the ones we've had good experience with rather than to make a clone of JetBrains' list. You'll see a mix of my own experience with the plugins, some tips and tricks and a bunch of links. Hope you find it useful.





We use IntelliJ IDEA (instead of Studio) because our project consists of not only an Android app, but also an Android Studio / IDEA plugin. But since Android Studio is based on IDEA and the two are kept fairly in sync, it's safe to assume that the plugins I include here work for both.





## Android Studio or Eclipse?





Like many of you, we started with Eclipse and made the transition over time. I must say switching IDE is not the easiest thing in my career -- different UIs and terminologies (Where's my "workspace" now? What is a "module"?) In my experience, the most difficult part is overcoming my muscle memory to adapt to new key bindings. But as soon as I convinced myself to spend a fair amount of time in IDEA, there was no regret. The interface feels intuitive. The code completion is smart and powerful. No more mysterious [workspace corruption](http://stackoverflow.com/questions/950476/how-to-recover-corrupted-eclipse-workspace). If you just switched from Eclipse or are planning to do so, check out this [complete guide](http://zeroturnaround.com/rebellabs/getting-started-with-intellij-idea-as-an-eclipse-user/).





There is a common issue shared by Studio and Eclipse (and pretty much all IDEs): the UI sometimes freezes due to the heavy-lifting in the background. [Increasing heap size](http://geek.moneylover.me/android-studio-eliminate-shutter-n-lag/) is often an effective cure. Besides, many developers are hesitant to switch to Android Studio because of the performance of Gradle. We wrote a [blog post](/2014/10/speeding-gradle-builds/) to help you tune it up.





Are you still using Eclipse for a legacy project? Fair enough, but it's 2015, why don't you just import it into Studio and give it a try? Studio has made it fairly easy, just "File -> Import Project". You'll do yourself a favour by just trying.





Are you using Xamarin? At least you should try Android Studio to build the layouts and other resource XML files. Besides a better layout editor, you'll get a bonus of "REALLY separating the UI from everything else" (quoting Steff Kelsey at GoodLux Technology, one of our users who did just that).





OK, if you really are an Eclipse die-hard, check out [Andmore](http://projects.eclipse.org/projects/tools.andmore) and you can stop reading this post. It looks like the Eclipse foundation (more specifically BlackBerry) has forked ADT and wants to give it a restart. That's the power of open source.





## Plugins





Below are plugins that I use on a daily basis and therefore recommend. You can find and install these plugins from within Android Studio / IDEA: "Preferences (or Settings on Windows) -> Plugins -> Browse repositories".





### ADB Idea





Developed by Philippe Breault, [ADB Idea](https://github.com/pbreault/adb-idea) makes it easy to run commonly used ADB commands from within Android Studio. Because it knows the package name of your app from the IDE, it'll save you quite bit of typing on the command line for things like `adb uninstall com.mycompany.apppackage`. Plus, you can restart the app or clear app data with just a few keystrokes -- very handy indeed.





![ADB Idea screenshot](https://github.com/pbreault/adb-idea/raw/master/website/find_actions.png)





Philippe also wrote the indispensable [Android Studio tips of the day blog series](http://www.developerphil.com/android-studio-tips-of-the-day-roundup-1/). Lots of tips and tricks for you to get the most out of Studio.





### Kotlin





If you haven't tried [Kotlin](http://kotlinlang.org), you should. Kotlin is a JVM language created by JetBrains that helps us write safe and concise code with modern features such as lambdas, null safety, data classes and extension functions. Its seamless interoperability with Java, first-class IDE support and small footprint make it a great choice for writing Android apps — it’s simply better than Java (even Java 8). In addition, the latest [Kotlin M11](http://blog.jetbrains.com/kotlin/2015/03/kotlin-m11-is-out/) brought us goodies such as multiple constructors (finally, writing custom views in Kotlin!), [an interesting way](http://kotlinlang.org/docs/tutorials/android-plugin.html) to replace the boring `findViewById()` calls (the counterpart for Java is [ButterKnife](http://jakewharton.github.io/butterknife/)), and [Anko](http://blog.jetbrains.com/kotlin/2015/04/announcing-anko-for-android/), an intriguing Kotlin-based DSL for writing type-safe, concise layouts. If you need more reasons to consider writing your next app in Kotlin, read [this comprehensive report](https://docs.google.com/document/d/1ReS3ep-hjxWA8kZi0YqDbEhCqTt29hG8P44aA9W0DM8/edit?hl=en&forcehl=1) by Jake Wharton.





Have I mentioned Kotlin's excellent IDE support? Great thing happens when the company creating the language built the IDE too. Although not 1.0 yet, Kotlin's IDEA plugin already brought an experience on par with what's available for Java. Reference search, refactoring, navigation, quick fixes etc. all work the way as they should (and that's one of the reasons why we could quickly support Kotlin code hot-swapping along with Java support in our plugin).





In addition, the Kotlin plugin includes a few interesting features, such as converting Java code to Kotlin -- even when you paste Java code into a Kotlin editor. I also find the Kotlin bytecode viewer useful for understanding what the Kotlin compiler does behind the scene.





With that being said, there are a few mysterious features that I don't quite understand yet, such as "Kotlin Internal Mode" and "Find Implicit Nothing Class".





### Android Drawable Importer





This [plugin](https://github.com/winterDroid/android-drawable-importer-intellij-plugin) makes it easy to import the awesome icons sets [Android Icons](http://www.androidicons.com/) and Google's [material design icons](https://github.com/google/material-design-icons) into the project. Another interesting (and very useful) feature is being able to import the so-called "Multisource-Drawable". For example, if the assets from your designer look like the following, you can easily import them by dragging the files into the dialog and naming them once.




    
    <code>nice_icon_1_from_designer/ 
      drawable_ldpi.png 
      drawable_mdpi.png 
      drawable_hdpi.png 
      drawable_xhdpi.png 
    </code>





Do I expect more from the plugin? Always. First of all, it'd be nice to merge the two icon sets into one. When adding an icon, in most cases I don't know which icon sets to choose from -- just give me a big list of all the icons! Second, finding an icon from a small dropdown can be quite frustrating. It'd be great to show a grid of icons filterable by keywords. Finally, when importing the "Multisource-Drawable", it'd be nice if the plugin can recognize the naming pattern and import all images without having to repeat the drag&drop for each of them.





### Genymotion





The [Genymotion IDEA plugin](https://www.genymotion.com/#!/download) adds a button on the toolbar that allows you to launch Genymotion VMs without leaving IDEA. There's no new functionality compared to the Genymotion standalone app. In theory, to reach either of them I need to move the mouse about the same distance. But I find myself using the plugin a lot more. Maybe there is a psychological reason?





### Android Parcelable plugin





To pass an object between activities, we need to make the object `Parcelable` or `Serializable` and put it in an `intent` or `bundle`. `Parcelable` is a lot faster than `Serializable` but it involves a lot of boilerplate code.





The [Android Parcelable plugin](https://github.com/mcharmas/android-parcelable-intellij-plugin/) generates the code of `CREATOR`, `writeToParcel()` etc. The plugin is smart enough to create different code according to the type of the field. For example, if you have a `Date` field, it'll write the corresponding milliseconds since Epoch to the `Parcel`:




    
    <code>dest.writeLong(birthDate != null ? birthDate.getTime() : -1);
    </code>





This plugin is indeed a time saver. **However**, whenever looking at a code generator plugin, you might want to check if there's an annotation based solution, which usually results in cleaner and more maintainable code. For `Parcelable`, check out [Parceler](https://github.com/johncarl81/parceler).





### ideaVim





Since 2007, I've been forcing myself to use Vim whenever possible -- this way I'd be effective in text editing virtually anywhere. [ideaVim](https://github.com/JetBrains/ideavim) was literally the first plugin I installed. It adds Vim keybindings to IDEA's editors which allow me to use my muscle memory built up these years. I felt home again.





### Key promoter





The [Key promoter plugin](https://plugins.jetbrains.com/plugin/1003) might be a bit controversial. It'll nag at you and push you to use keyboard shortcuts more whenever it finds otherwise. If a menu item doesn't yet have a shortcut set, it'll ask if you want to set one. Not sure about you but I find it effective in helping me remember the standard key bindings.





As mentioned, I've been using Eclipse key bindings for quite a while. After confusing my co-workers in various ScreenHero sessions, I decided to switch to standard bindings (Mac OSX 10.5+) with the help of Key promoter. Suddenly Philippe Breault's [Android Studio tips of the day](http://www.developerphil.com/android-studio-tips-tricks-moving-around/) became more useful to me.





![key-promoter](/wp-content/uploads/2015/03/key-promoter.png)





### jimu Mirror





_Disclaimer: we are the creator of this plugin, and we use it to build itself, more specifically Mirror's Android client and sample apps._





Mirror helps us quickly build layouts, custom views and animations with live, interactive previews on real devices. You can make a change to your code and verify on the device in seconds. The fast feedback loop has permanently changed our workflow of building the UI of our apps.





I'll refrain from talking about our own thing too much here and leave you with a link: [http://jimulabs.com](/).





## Bonus: Terminal tips





Although I spend a lot of time in IDEA, it's very useful to keep a few terminal windows open. On Mac OSX, I use [iTerm](http://iterm2.com/), [Zsh](http://www.zsh.org/) and [YADR](https://github.com/skwp/dotfiles). What YADR you ask? "YADR is an opinionated dotfile repo that will make your heart sing" -- I'll let you dive into their website to see what that means. (BTW do you know that IDEA has a built-in terminal?)





Here are a couple of Android-specific things I do in iTerm:





### adb logcat





Unfortunately the "Devices | logcat" window in Android Studio still feels buggy to me. It's slow to catch up the latest logs and sometimes the logs would just disappear. In contrast, running it in command line is rock solid. Additionally, you can open multiple terminals to display different logs at the same time.





Tip: if you want to filter the logs by a log tag, you'll need to do `adb logcat -s MyTag:V`. Note the `-s` flag here, without it, it'll print all the logs. This took me quite a while to figure out.





### Killing daemons





Have you ever got this nasty error when you try to run the app? `Unable to locate a Java Runtime to invoke` The solution is simple, run `./gradlew --stop` on the command line to kill the Gradle daemon with no mercy.





The Gradle daemon runs in the background to help make builds faster, but sometimes it'll go into a bad state and it's time to kill it. Android Studio will restart it properly next time when you run a build.





## Conclusion





So here you go, I've covered quite a few plugins that you can download and give a try. How do you like them? What are your favourite plugins? Tell me in the comment box below!





For your convenience, here's a list of all the links mentioned in the post:







  * Websites / blogs



    * [JetBrains's grand list of Android Studio plugins](https://plugins.jetbrains.com/?androidstudio)


    * [Eliminate Lags & Stutters in Android Studio](http://geek.moneylover.me/android-studio-eliminate-shutter-n-lag/)


    * [Speeding up Gradle builds](/2014/10/speeding-gradle-builds/)


    * [Andmore, BlackBerry's ADT fork](http://projects.eclipse.org/projects/tools.andmore)


    * [Getting Started with IntelliJ IDEA as an Eclipse User](http://zeroturnaround.com/rebellabs/getting-started-with-intellij-idea-as-an-eclipse-user/)


    * [Android Studio tips of the day blog series](http://www.developerphil.com/android-studio-tips-of-the-day-roundup-1/)


    * [Kotlin M11 blog post](http://blog.jetbrains.com/kotlin/2015/03/kotlin-m11-is-out/)


    * [Kotlin Android extension plugin tutorial](http://kotlinlang.org/docs/tutorials/android-plugin.html)


    * [Anko for Android](http://blog.jetbrains.com/kotlin/2015/04/announcing-anko-for-android/)




  * Plugins



    * [ADB Idea](https://github.com/pbreault/adb-idea)


    * [Kotlin](http://kotlinlang.org)


    * [Android Drawable importer](https://github.com/winterDroid/android-drawable-importer-intellij-plugin)


    * [Genymotion IDEA plugin](https://www.genymotion.com/#!/download)


    * [Android Parcelable plugin](https://github.com/mcharmas/android-parcelable-intellij-plugin/) and its alternative [Parceler](https://github.com/johncarl81/parceler)


    * [ideaVim](https://github.com/JetBrains/ideavim)


    * [Key promoter](https://plugins.jetbrains.com/plugin/1003)


    * [jimu Mirror](/)




  * Terminal tools



    * [iTerm](http://iterm2.com/)


    * [Zsh](http://www.zsh.org/)


    * [YADR](https://github.com/skwp/dotfiles)







## About the author





Linton Ye is a developer, toolsmith, UI designer, entrepreneur and lifelong learner. He founded jimu Labs to eliminate the gap between UI design and development and created Mirror as the first step into this direction. Back in 2008, Linton built one of the first movie showtimes apps on Android with more than a million downloads. He also built Eclipse plugins and tooling for AspectJ at IBM and University of British Columbia.





Linton writes about Android on [jimu Labs' blog](/posts).  Follow him on Google+ ([+LintonYe](google.com/+LintonYe)) or Twitter ([@lintonye](https://twitter.com/lintonye)).



