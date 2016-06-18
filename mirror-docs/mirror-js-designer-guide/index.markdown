---
author: matt
comments: true
date: 2014-09-03 19:06:54+00:00
layout: page
redirect-from:
- /mirror-js-designer-guide
slug: mirror-js-designer-guide
title: Mirror.js Setup Guide for Designers
id: 643
---

## Note: We have stopped the development of Mirror.js and put what we've learned into Mirror Sandbox, a set of new features based on Java code hot-swapping. See [this post]({{site.baseurl}}/2015/01/building-android-animations-mirror-sandbox-piecewise/) for details.





* * *





## Mirror.js for the Intrepid Designer





This guide is intended to make it easier for Android designers to get started with Mirror.js, even with little or no Android development experience. We think Mirror has the potential to transform Android design, and even though it's early days we're keen to get started.





[Watch Mirror.js video]({{site.baseurl}}/mirrorjs-preview)





### Why try Mirror.js?





Building Android apps requires a complex coordination between designers and developers. This isn't a bad thing, but we can use tools to make this coordination more efficient and more successful. Mirror, and the experimental features in Mirror.js, is our attempt. Our tools make it easier and faster for developers to quickly implement and experiment with designs. As well, they empower designers to create extremely high-fidelity prototypes while producing assets that are directly usable in production.





Without going into detail, you should use Mirror.js to create high-fidelity prototypes because prototypes are better when







  * they run on _real devices_


  * they _look and feel_ exactly as the production app will


  * they _move_


  * you can _touch them_


  * they're made with assets that can be _used in production_





Mirror.js prototypes do this.





### Why this guide?





Mirror started as a development tool, but we quickly realized that it could also be valuable for designers. We're figuring out how best to serve both designers and developers, but for now using Mirror still requires some use of tools that designers might not be familiar with. This guide aims to get designers up to speed with the required tools so they can get started with Mirror more easily.





### Who do we think you are?





This guide assumes that you have some familiarity with XML (some experience with HTML is more than enough), and have used JavaScript before (Mirror.js doesn't require much JavaScript, but it does require some). We also assume that you're familiar with Android design principles; this guide doesn't describe how Android apps should look and behave. Finally, we assume that you want to play a broader role in app development and work a little bit more closely with native Android.





We are **not** assuming that you have any programming experience beyond a small amount of JavaScript. In particular, it's not necessary to write any Java code to build prototypes with Mirror. We also don't assume that you know anything about Android layouts and resources, although we _do_ assume that you want to learn about them. Being able to easily express your design in the language of Android resources is one of the primary benefits of using Mirror!





### Setting up your device for debugging





In order to see your UI in real time on a phone or tablet, you need to enable USB debugging on your device. This is an easy (if a bit strange) procedure that generally looks like this:







  1. In the device's settings, find the build number of the device. This is usually under a category like "About Phone" or "Software information" in the settings


  2. Click on the build number repeatedly (seriously) until you see a message like "You are now a developer!"


  3. There will now be a "Developer options" category in your settings. Check the "USB debugging" option in this section





The exact location and names of the settings vary depending on the device. You can usually search for something like "[device name] enable usb debugging" to find specific instructions, or send us an email at support@jimulabs.com if you're running into problems.





### Installing Android Studio





Mirror is currently distributed as a plugin for Android Studio, so you'll need to install that first. Android Studio is the Android development environment built and distributed by Google. It's the easiest way to get started creating Android resources and user interfaces.





[Download Android Studio here](https://developer.android.com/sdk/installing/studio.html), and install it according to the instructions on the developer site. For OS X, this just means unzipping and copying the application to your Applications folder.





### Installing Mirror and opening the sample project





First let's install Mirror. You can download Mirror from [this page]({{site.baseurl}}/mirrorjs-preview/) (click the "Download Android Studio plugin" button). Once Mirror has finished downloading, start up Android Studio. You'll see this screen, which shows up when you have no open projects:





![Welcome screen]({{site.baseurl}}/wp-content/uploads/2014/09/00_Welcome.png)





Click on "Configure", and then "Plugins". You'll see a list of installed plugins. Near the bottom of the window, click "Install plugin from disk...". Find the Mirror zip file you downloaded and select it. In the plugins window, click "Apply" and restart Android Studio when prompted.





![Mirror Plugin setup]({{site.baseurl}}/wp-content/uploads/2014/09/01_Configure_Plugins.png)





Now that Mirror is installed let's open a project. We've prepared a sample project with lots of examples of what you prototype with Mirror.js. It's stored on Github, and can be automatically imported from there into Android Studio. On the Android Studio welcome screen, click "Check out from Version Control", and select "Git" (_not_ Github):





![Checking out samples from Git]({{site.baseurl}}/wp-content/uploads/2014/09/02_Git_Checkout_Screen.png)





In the "Vcs repository URL" field, put `git@github.com:jimulabs/mirror-samples.git` (this is the URL of our repository of sample projects). Choose whatever parent directory is convenient for you; this is the folder where the mirror-samples repository will be downloaded. Cloning the repository will take a few seconds.





![Configuring the Git clone]({{site.baseurl}}/wp-content/uploads/2014/09/03_Git_Project_Window.png)





Once the repository has been cloned, click "Yes" when when asked if you would like to create an Android Studio project from the downloaded files. On the "Import Project" screen, select "Import project from external model". Make sure "Gradle" is selected, and click "Next". Gradle is a tool that's used by Android Studio to build Android apps; you don't need to know how Gradle works to use Mirror so we won't be saying much about it here.





![Importing the sample project]({{site.baseurl}}/wp-content/uploads/2014/09/04_Import_Project.png)





We only want to import one of the sample projects for now, so click the "..." button next to the "Gradle Project" field to change the imported project. Select the "settings.gradle" file inside the "MirrorJSExamples" project.





![Import project window highlighting the "..." button]({{site.baseurl}}/wp-content/uploads/2014/09/05_Import_Gradle_Project.png)





![Choosing the correct gradle file]({{site.baseurl}}/wp-content/uploads/2014/09/06_Choose_gradle_project.png)





Make sure "Use default gradle wrapper" is selected, and that your configuration looks like the one below. Click "Finish" to import the project.





![Completed project import screen]({{site.baseurl}}/wp-content/uploads/2014/09/07_Configured_Import.png)





Importing the project will take a bit of time, as Android Studio will need to build the project. After importing the project you might see an error notification in the top right of the screen saying "Invalid Vcs root mapping". You can safely click "Ignore VCS root errors"; this won't affect your use of Mirror.





Now you're ready to try out Mirror. Make sure you have a device plugged in with USB debugging enabled, then click the "Start Mirror" button:





![Showing Start Mirror button]({{site.baseurl}}/wp-content/uploads/2014/09/08_Opened_AS.png)





On your device you'll see a list of each of the screens in the sample project. Let's do a quick test to make sure everything is working. On the device, select the first screen in the list, "animator_resource". Navigate to the file "slide_up_appear.xml" in the Project outline, as shown below:





![Project outline slide_up_appear]({{site.baseurl}}/wp-content/uploads/2014/09/09_AS_slide_up_appear.png)





Don't worry about how this file works just yet. For now, change the line `android:valueTo="200dp"` to `android:valueTo="20dp"`. Save the file and confirm that the "Motion Made Easy" text now animates to the top of the screen. Change the line back to how it was and save again; the text will now animation to about half way up the screen.





### Troubleshooting





If you don't see the changes on your device, make sure that Mirror is running in Android Studio. If Mirror is running, you'll see the "Stop Mirror" icon in your toolbar:





![10 Mirror toolbar]({{site.baseurl}}/wp-content/uploads/2014/09/10_Mirror_running.png)





If it is running, click on the "Open Mirror" button in the toolbar to open the Mirror Console. If there are any errors they'll show up in the console in red text. If you're unable to fix these errors you can send us an error report and we'll figure out how to get you up and running. Click the "Report error" button on the left side of the Mirror Console and make sure the "Include current contents of Mirror Console" is checked.





![Error report button]({{site.baseurl}}/wp-content/uploads/2014/09/11_Mirror_Console.png)





### What now?





This guide is just intended to get you set up with Android Studio and Mirror. The next thing you should do is read our Mirror tutorials:







  * The [Mirror tutorial]({{site.baseurl}}/mirror-tutorial/) will teach you how to prototype apps using Mirror


  * The [Mirror.js overview]({{site.baseurl}}/mirror-js-overview/) will teach you how to use the experimental JavaScript support in the Mirror.js preview to create dynamic, interactive prototypes.





To follow along with the first tutorial you'll want to import the Tutorial project. This is in the collection of samples you downloaded earlier. To import it in Android Studio, select "File > Import Project" and select the "Tutorial" project in the "mirror-samples" folder you downloaded.





The tutorials assume some familiarity with the Android resource system. If you've never been exposed to this, using Mirror is actually a great way to learn it! Below are some links to documentation for Android resources; having these on hand will give you more details about resources while you're learning to use Mirror. All of these are from the [Android developer website](https://developer.android.com/). A lot of the content on the developer site has to do with writing Java code for Android apps, but understanding that content is not necessary for using Mirror.







  * [Resources overview](https://developer.android.com/guide/topics/resources/overview.html)


  * [Providing resources](https://developer.android.com/guide/topics/resources/providing-resources.html)


  * [Resource types](https://developer.android.com/guide/topics/resources/available-resources.html)


  * [Layouts](https://developer.android.com/guide/topics/ui/declaring-layout.html)



    * You can ignore the  "Load the XML resource" and "Building Layouts with an Adapter" sections -- Mirror handles this more simply using sample data, as covered in the Mirror tutorial




  * [Property Animation](https://developer.android.com/guide/topics/graphics/prop-animation.html)



    * Specifically the "How property animation works" and "Declaring animations in XML" sections. Again, the rest of the content is Java-specific and Mirror handles things differently. See the Mirror.js overview to learn how to handle animations using Mirror and JavaScript.





