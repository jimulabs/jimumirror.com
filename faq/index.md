---
author: linton
comments: true
date: 2015-03-30 23:11:42+00:00
layout: page
permalink: /faq/
slug: faq
title: Frequently Asked Questions
id: 757
---

### How does Mirror work?





Mirror has two components: a server program that runs on your computer and an app that runs on each preview device. The server watches your project directory and detects changes to resource files, sample data files, Java/Kotlin files and dex/apk files. When something is changed, the server packages up the resources for your project and sends them to the attached devices. The Mirror app renders the UI using the standard Android resource system, so the displayed preview will look exactly how it will when you run your app.





### How does the code hot-swapping work?





Mirror achieves the fast code hot-swapping by only compiling the necessary Java files incrementally. The resulting classes are then converted into a (small) dex file, which is sent to connected devices momentarily. The Mirror client loads the classes in this dex file using a custom class loader.





### Does Mirror support emulators?





Yes, as long as the emulator is API 15+. Genymotion VMs are supported as well. One requirement is that the emulators or devices need to have an (emulated) SD card.





### Does Mirror support other types of devices such as Android Wear and Android TV?





Yes, to some degree. Mirror doesn't have any specific support for Android Wear yet, such as using `WearbleListView` for the list of layouts. But you should still be able to preview custom layouts in your wear project (check out [this video](https://youtu.be/2vkupBMOq4c)). One caveat is that debugging via Bluetooth is very slow. In most cases you'll want to use USB or just the emulator.





We've done some initial testing on Android TV ([ADT-1](https://developer.android.com/tv/adt-1/index.html)) and it worked fine. We'll do some more testing using the [Leanback library](https://developer.android.com/tools/support-library/features.html#v17-leanback).





Android Auto? Not sure until we have access to a device.





### Is it possible to use Facebook's Stetho in Mirror previews?





Certainly! Check out [this post]({{site.baseurl}}/2015/04/setting-up-mirror-for-stetho/).





### How to preview layouts with fragments?





You can use `<_content>` tag to add fragments (see [this tutorial]({{site.baseurl}}/mirror-docs/mirror-tutorial/) for more details).





	<screen>
  		<_content layout="@layout/my_layout">
   	 	...
    	<id_of_frame_layout_to_be_replaced_by_fragment>
      		<_content layout="@layout/fragment_dialog">
        		<image src="@drawable/mascot"/>
        		...
      			</_content>
    		</id_of_frame_layout_to_be_replaced_by_fragment>
  		</_content>
	</screen>




### How to preview layouts with ViewPager?





Check out [this tutorial]({{site.baseurl}}/2014/10/building-android-layouts-mirror-view-pagers/)





### How to preview layouts with custom fonts?





If you have custom views to render the custom fonts, it should just work as Mirror sends assets (where fonts are located) to the device too.  Otherwise, e.g. if you render the fonts in your activity/fragment, it's possible to use the "Sandbox" feature to load the fonts from a Java class, i.e. create a subclass of `MirrorSandboxBase` and put its fully qualified name in the screen file, in `MirrorSandbox#$onLayoutDone()`, write Java code to load the custom fonts and set it to the views as needed.





### How to preview layouts for dialogs?





Previewing dialog layouts is as simple as adding a "theme" attribute to the corresponding mirror file: `<screen theme="Theme.AppCompat.Light.Dialog">`.





### How to set custom attributes from a mirror file?





Mirror relies on the Java naming convention to set the value of custom attributes, i.e. it'll try to call the setter method of the attribute you put in the mirror file. You can do things like the following.





	<textViewId allCaps="true" textColor="0xFF0000">

See [this doc]({{site.baseurl}}/mirror-docs/sample-data-attributes/) for more details.





### Does Mirror use the "tools" attributes?





Yes! Mirror supports most "tools:" attributes that can be directly translated to a view's "android:" attributes. This means, for example, the TextView below will show up as "Hello World" in Mirror instead of being blank.





	<TextView
   	   tools:text="Hello World"
   	   ...
	/>

When both "tools:" and "android:" of an attribute appear in the same tag, the "android:" one takes precedence.





### What does "View#inEditMode()" return in Mirror?





It returns `true` by default. However, you can change this using the `inEditMode` attribute in the mirror file:





	<screen inEditMode="false">

You can also insert a `tools:inEditMode="false"` in the layout, and Mirror will copy the value to the corresponding mirror file _when you haven't modified the mirror file_. If you have modified the mirror file, it won't get updated.





### I got a ClassNotFoundError on my device, what should I do?





Click the "Reload custom views" button to the left of the start/stop button. This will invoke the gradle task such as "dexDebug" (depending on the selected variant) and clean up cache which may cause the issue. When the gradle task finishes, the error should go away.





If the problem persists, send us an error report from Studio using "Tools -> Mirror -> Report error".





### Will Mirror hot-swap all my Java files?





Actually no. Mirror only hot-swaps your custom views and their dependencies. It ignores classes that are not necessary for rendering layouts such as activities, fragments, services etc. Technically, as of now, all subclasses of `android.app.*` and `android.support.v4.app.*` are ignored.





### My code is in fragment/activity/application, why it's not executed?





The Mirror client is a separate app which does not currently use the code in your fragment, activity or application. It only uses the custom views on the layout and classes used by the custom views.





### What code can I put in the “MirrorSandbox#$onLayoutDone()” method?





Mirror Sandbox is designed to help you build the user interface of your app, so generally you can put code that populates or animates views etc. The Mirror client only uses a small number of permissions such as internet. Expect errors if you write code that requires other permissions. And apparently, you don’t want to put misbehaving code such as an infinite loop there.





### Mirror is awesome! But how to convince my boss to purchase a license?





Show him or her [this report]({{site.baseurl}}/time-saved-using-mirror/). This information is available within Android Studio and tailored to your projects. Open the Mirror Console and you'll see.





## Still have questions? Ask below.



