---
author: matt
comments: true
date: 2014-09-17 22:02:46+00:00
layout: post
slug: building-user-interfaces-android-textviews-imageviews
title: Building Android layouts with Mirror - TextViews and ImageViews
id: 688
categories:
- Tutorial
---

_This is a new series of posts on using Mirror to rapidly build your app's user interface. Mirror lets you see immediately how your layouts and resources look on your phone or tablet, without needing to code up mock adapters or constantly re-install your app. For a general overview of how to use Mirror, check out the [Mirror Tutorial]({{site.baseurl}}/mirror-tutorial)._





We'll be starting with the basics: putting text in TextViews and images in ImageViews.





## Filling TextViews and ImageViews





Suppose you have a layout in your project that looks like this:





		<!-- layouts/person.xml -->
		<RelativeLayout ...>
		    <TextView android:id="@+id/name" ... />
		    <ImageView android:id="@+id/avatar" .../>
		</RelativeLayout>





### Using an Android Studio tools attribute





The first thing you can do is use a `tools` attribute, just as you would to fill in data in the Android Studio preview pane:





		<!-- layouts/person.xml -->
		<RelativeLayout ...>
			<TextView android:id="@+id/name"
				tools:text="Alan Turing" ... />
			<ImageView android:id="@+id/avatar"
				tools:src="@drawable/turing" />
		</RelativeLayout>





Mirror picks up on the tools attributes in your layouts, so the text and image will show up on your device as well as in the preview pane. The downside to using tools attributes is that you can only specify one piece of data. This is a problem if, for example, your layout is an item layout that will be used in a ListView. In that case the same layout will be repeatedly filled with different data. Using sample data instead provides the flexibility we need here.





### Using Mirror's sample data





Mirror will automatically create a screen file for `person.xml` in the `mirror` directory in your main application module. The generated screen file looks like this:





		<screen>
			<_content layout="@layout/person">
				<!-- TextView Examples:
				<name text="@string/string_resource" />
				<name text="Text literal" textSize="14sp" /> -->
				<name />
				<!-- ImageView Examples:
				<avatar src="@drawable/image_resource" />
				<avatar src="relative_path/image.jpg" /> -->
				<avatar />
			</_content>
		</screen>





You can see that the generated screen file comes with a couple of examples on how to fill the views. For instance, we could replace the `<name />` element with `<name text="Alan Turing" />`. Of course, if you have multiple TextViews in your layout, you can fill them all in the same way.





Theres one more way to fill TextViews using sample data that may be convenient. Instead of writing `<name text="Alan Turing" />`, you can also write `<name>Alan Turing</name>` and get the same result. This pattern _only_ applies to TextViews.





ImageViews can be filled with either drawable resources or image files on your hard drive. Replacing `<avatar />` with `<avatar src="@drawable/turing" />` would fill the ImageView with that resource.





### Next time





[Next time]({{site.baseurl}}/2014/09/building-android-layouts-mirror-listviews), we'll look at how to fill a ListView with distinct items, and really see how sample data gives us more flexibility than tools attributes. Thanks for reading!



