---
author: matt
comments: true
date: 2014-08-25 11:18:27+00:00
layout: page
redirect_from:
- /mirror-tutorial
slug: mirror-tutorial
title: Getting Started with Mirror
id: 543
---





## Why Mirror?





Mirror makes developing your Android app's UI faster and more effective. It displays your layouts on your phone or tablet, updating in real-time as you code. You can preview your app in a realistic context without the limitations or inconsistencies of Android Studio. If you're unfamiliar with Mirror, check out [this video](https://www.youtube.com/watch?feature=player_detailpage&v=3adPncFr9Gc) of Mirror in action.





## Using this guide





We've prepared a small sample project you can use if you want to play with the examples with this guide. To get it, clone the [Mirror samples repository](https://github.com/jimulabs/mirror-samples) and import the Tutorial project into Android Studio. You can also follow along using your own project; all of the examples here are very general.





## Getting started: mirroring static layouts





If you're using our [Android Studio plugin](/mirror-downloads/) (highly recommended!) there's nothing to configure to use get started; Mirror will automatically find your modules and figure out your project structure (currently only Gradle-based projects created with Android Studio are supported). If you're using the standalone version of Mirror, see our separate [setup guide](/project-configuration-in-mirror-server/).
  

![Mirror Android Studio plugin](/wp-content/uploads/2014/08/as-plugin-window-small.png)
  

Click the **"Start/Stop Mirror"** button in the Android Studio toolbar (standalone users: the big **Start** button). If you have a device attached to your computer with debugging enabled, Mirror will install our previewing application on your device, and in a couple of seconds it will launch and display a list of the layouts in your application. Select one of these layouts to see what it looks like.
  

![List of screens in sample project](/wp-content/uploads/2014/08/geny_sla_short.png)
  






#### Things to try







  * Preview the `list_item` screen


  * In `layout/list_item.xml`, set `layout_centerVertical` to false in the `name` TextView


  * Remove the `name` TextView. Add it back in


  * In `values/styles.xml`, change the `layout_width` and `layout_height` in the `Avatar` style





Remember to save the file after each change. Every time you save a file, the preview on your device will quickly and automatically update to show the modified layout. Creating styles and layouts that look exactly how you want is much easier when you can immediately see the effects on a real device.





## Populating layouts with simple dynamic data





Chances are your layout has some elements that are filled dynamically, like a "name" text field, or an "avatar" image. It's important to preview your layout with this dynamic data in place, so you can see how the layout will _really_ look.





Android Studio supports this to some extent with [tools attributes](http://tools.android.com/tips/layout-designtime-attributes), and Mirror also supports tools attributes in the same way. Tools attributes set in your layouts will show up in your on-device preview just like in the Android Studio preview pane.





Mirror also supports another, more powerful way to simulate dynamic data in static previews, called **sample data**. If you look in your main app module, you'll see that there's a new `mirror` directory. This contains a collection of files with the same names as layouts in your application. These are **screen files**, and each corresponds to a screen that you can preview using Mirror.
  

![Mirror screens](/wp-content/uploads/2014/08/plugin_window_screens.png)
  

There are a number of special elements in a screen file (see the full spec [here](/sample-data-specifications/)), but most elements in the screen file correspond to views in a layout. These elements can be used to populate views with data. For example, suppose we have a layout called `list_item` with this code:





	<!-- layout/list_item.xml -->
	...
	<ImageView android:id="@+id/avatar" />
	<TextView android:id="@+id/name" />
	...





  

In the corresponding screen file (by default `mirror/list_item.xml`) we can _populate_ these elements in a similar manner to tools attributes:





	<!-- mirror/list_item.xml -->
	<screen>
  	<_content layout="list_item">
    	<name text="Android" />
    	<avatar src="@drawable/android_avatar" />
  	</_content>
	</screen>





  

Generally, a drawable used in development like this isn't intended to actually be included in the application. You can put resources like this in the `mirror/res` directory, which behaves exactly like the regular resource directory (ex. different drawables for different device resolutions) but will only be used by Mirror and won't be included in your built application.
  

![Mirror resource directory](/wp-content/uploads/2014/08/plugin_mirror_res.png)
  






#### Things to try







  * Open the `list_item` screen on your device, and the `mirror/list_item.xml` file in your editor


  * Change the text in `name`


  * Add an attribute to `name`, for example `textSize="32sp"`





## Populating layouts with complex dynamic data





Now lets move beyond tools attributes. Consider these layout snippets:





	<!-- layout/list.xml -->
	...
	<ListView android:id="@+id/list" />
	...

	<!-- layout/list_item.xml -->
	...
	<TextView android:id="@+id/name" />
	<ImageView android:id="@+id/avatar" />
	...





  

In this example we have a list of people, and each person in the list will have a name and an avatar. To actually see what the activity will look like, we'd normally need to write a dummy adapter with some static data and hook it up to our layout. In the process we'd lose the ability to immediately preview changes _in context_. Sample data can solve this problem, and easily. Here's an example screen file to preview the `list` layout filled with items:





	<!-- mirror/list.xml -->
	<screen>
  	<_content layout="list">
    	<list>
      	<items layout="list_item">
        	<_item>
          	<name text="Android" />
          	<avatar src="@drawable/android" />
        	</_item>
        	<_item layout="list_item_special">
          	<name text="Duke" />
          	<avatar src="@drawable/duke" />
        	</_item>
        	<_item>
          	<name text="Tux" />
          	<avatar src="@drawable/tux" />
        	</_item>
      	</items>
    	</list>
  	</_content>
	</screen>





  

Now if you open the `list` screen in the Mirror app, you'll see a list with three items:
  

![Mascot list view](/wp-content/uploads/2014/08/geny_list_view_short.png)
  






Changing any of the `list` or `list_item` layouts, the `list` screen file, or any other associated resources would all result in an immediately updated preview. Notice also the different layout, `list_item_unread`, in the second item of the above example. Sample data makes it easy to develop heterogenous list layouts with complex items, with live previews and no dependency on your Java code.





#### Things to try







  * Preview the `list` screen on your device


  * Duplicate one of the `<_item>` elements in `mirror/list.xml`


  * In `mirror/list.xml`, change the line `<items layout="list_item">` to `<items layout="list_item" count="5">`


  * In `layout/list_item_special.xml`, change the `textStyle` of the TextView to `italic`





## Nesting layouts and previewing fragments





It's common in Android development, especially since the introduction of Fragments, to have entire sections of your UI that can be dynamically swapped in and out. Suppose we have a layout with a heading, and then a section we want to be able to fill with different layouts depending on the situation. We'll call this `container`, and we'll also assume we have a layout `text_content` that holds some text content to insert into `container`:





	<!-- layout/container.xml -->
	<LinearLayout android:orientation="vertical">
  	<TextView android:id="@+id/heading" />
  	<FrameLayout android:id="@+id/content_frame" />
	</LinearLayout>

	<!-- layout/text_content.xml -->
	<LinearLayout>
  	<TextView android:id="@+id/body" />
	</LinearLayout>





  

This is a common pattern; at runtime, `content_frame` would be filled in with `text_content`. An accurate preview of this UI would involve the `text_content` layout displayed inside the `container` layout, and content filled in for both. Again, sample data makes this straightforward. In sample data, any `ViewGroup` (such as `FrameLayout`) can have its own, nested content:





	<!-- mirror/container.xml -->
	<screen>
  	<_content layout="container">
    	<heading text="Valuable content" />
    		<content_frame>
      			<_content layout="text_content">
        			<body>Some extended body text. You can populate text views like this, with the same result as using the 'text' attribute</body>
      			</_content>
    		</content_frame>
  		</_content>
	</screen>





  

Opening `container` in the Mirror app on your device will show the whole UI exactly as in will appear in the final app.
  

![Container with text content](/wp-content/uploads/2014/08/geny_container_short.png)
  

So far we've had one screen file for each layout in our project, but we can be more flexible than this. Suppose we have another layout, `image_content`, that we intend to put inside `container` as well:





	<!-- layout/image_content.xml -->
	<LinearLayout>
  	<ImageView android:id="@+id/image" />
	</LinearLayout>





  

In our app, we sometimes want to show text content, and sometimes image content. To preview the image case, we could edit the `container.xml` screen file to show `image_content`, instead of `text_content`, but switching back and forth would be annoying. Instead, let's create a new screen file:





	<!-- mirror/container_with_image.xml -->
	<screen>
  	<_content layout="container"> <!-- We'll use the same top-level layout -->
    	<heading text="Valuable content" />
    	<content_frame>
      	<_content layout="image_content"> <!-- But change the inner content -->
        	<image src="@drawable/mascot" />
      	</_content>
    	</content_frame>
  	</_content>
	</screen>





  

Now the Mirror app will show both `container` and `container_with_image` as previewable screens. We can check out both, or show them to a client, without needing to change any files.
  

![Container with image content](/wp-content/uploads/2014/08/geny_container_with_image_short.png)
  






#### Things to try







  * While previewing the `container` screen, change something in `layout/text_content.xml` such as the color or size of the TextView


  * While previewing the `container_with_image` screen, change the `ContainerHeading` style in `values/styles.xml`





## High fidelity prototypes





To get high-quality, detailed feedback on an app's design it's important to have a high-quality, detailed prototype. Mirror's sample data make it possible to create a native, high-quality prototype without depending on Java code. To give a quick idea of what you can do with Mirror, let's see what a screen with tabs and an action bar will look like. We'll re-use `text_content` and `image_content` from before, but we'll need a new top-level layout with a `ViewPager` to hold the pages:





	<!-- layout/view_pager.xml -->
	...
	<ViewPager android:id="@+id/pager" ... />
	...





  

And here's a screen file putting everything together:





	<!-- mirror/view_pager.xml -->
	<screen>
	    <actionbar title="Pager Demo" icon="@drawable/mascot" showTabsFor="@id/pager"/>
	    <_content layout="@layout/view_pager">
	        <pager>
	            <_page title="Android" layout="image_content">
	                <image src="@drawable/android" />
	            </_page>
	            <_page title="Duke" layout="image_content">
	                <image src="@drawable/duke" />
	            </_page>
	            <_page title="Text" layout="text_content">
	                <body>This text is displayed in the 'Text' tab</body>
	            </_page>
	        </pager>
	    </_content>
	</screen>





  

Open up `view_pager` on the device to see how it looks:
  

![View pager screen](/wp-content/uploads/2014/08/geny_view_pager_short.png)
  

Hopefully this gives you an idea of how far you can go creating accurate previews with Mirror with a very small amount of extra work. Check out and explore the [sample data spec](/sample-data-specifications/) for a complete list of what you can do using Mirror.





#### Things to try







  * Preview the `view_pager` screen


  * Change the action bar title in `mirror/view_pager.xml`


  * Remove the tabs from the action bar in `mirror/view_pager.xml` (you can still swipe between pages)


  * Add a page for Tux to the view pager


  * While previewing the `view_pager` screen, add the attribute `android:alpha="0.5"` to the ImageView in `layout/image_content`



