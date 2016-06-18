---
author: matt
comments: true
date: 2014-09-26 16:30:51+00:00
layout: post
slug: build-android-layouts-mirror-complex-listviews
title: Building Android layouts with Mirror - Complex ListViews
id: 695
categories:
- Tutorial
---

_This is part of a series of posts on using Mirror to rapidly build your app's user interface. Mirror lets you see immediately how your layouts and resources look on your phone or tablet, without needing to code up mock adapters or constantly re-install your app. For a general overview of how to use Mirror, check out the [Mirror Tutorial]({{site.baseurl}}/mirror-tutorial)._





## ListViews with multiple item layouts





[Last time]({{site.baseurl}}/2014/09/building-android-layouts-mirror-listviews) we looked at filling ListViews when all the items have the same layout. In this post we'll look at some situations where it's necessary to have items with _different_ layouts in a ListView, and we'll see how to easily develop and preview these more complex lists using Mirror. This lets you experiment with different designs built around lists without having to code up heterogenous adapters.





### List headers





Borrowing the example from the previous post, let's suppose we want to have a list of people in our app, where each person has a name and avatar. We'll use a layout called `person_item` to display each person:





		<!-- layout/person_item.xml -->
			<RelativeLayout ...>
			    <TextView android:id="@+id/name" ... />
			    <ImageView android:id="@+id/avatar" ... />
			</RelativeLayout>





In this example we also want a header for our list. The first item will simply say "People" and will have a different style than the rest of the items. Here's the header layout:





			<!-- layout/header_item.xml -->
			<LinearLayout ...>
			    <TextView android:text="@string/header_text"
			        style="@style/Header" ... />
			</LinearLayout>





Where `@string/header_text` is a string resource that's set to "People".





We'll use the same simple layout for our list as before:





			<!-- layout/list.xml -->
			<ListView android:id="@+id/list" ... />





Mirror's sample data lets us easily specify how to fill layouts with data so we can preview them accurately on devices. We can mostly re-use the sample data from the previous post to fill our list, but we'll add one extra item at the top for the header:





			<!-- mirror/list.xml -->
			<screen>
			    <_content layout="@layout/list">
			        <list>
            			<items layout="@layout/person_item" >
                			<_item layout="@layout/header_item" /> <!-- New item here! -->
                			<_item>
                    			<name>Alice</name>
                    			<avatar src="@drawable/alice" />
                			</_item>
                			<_item>
                    			<name>Bob</name>
                    			<avatar src="@drawable/bob" />
                			</_item>
                			<_item>
                    			<name>Charles</name>
                    			<avatar src="@drawable/charles" />
                			</_item>
            			</items>
        			</list>
   		 	</_content>
		  </screen>





There are two things to note about the header item at the start of the list. The first is that it specifies a different layout from the parent `<_items>` element. When populating a list, the `<_items>` element can give a default layout that items will use, but any individual item can override that by giving their own `layout` attribute. The second thing to note is that we don't need to actually fill in the header item in this case, since it always uses the same text, which is specified in the layout file.





If you preview this screen file using Mirror, you'll see the list, as desired, with a distinct header element first followed by several person elements all sharing the same layout.





### List sections





Another situation that requires a heterogenous list is when you want to have distinct sections in your list, with a different heading for each section. As a contrived example, suppose we want a list that has colours, places, and numbers in it, in separate sections. For simplicity we'll use the built in `simple_list_item_1` for the items within each section, and we'll use the following `section_heading` layout for the section headings:





		<!-- layout/section_heading.xml -->
		<LinearLayout ...>
		    <TextView android:id="@+id/heading"
		        style="@style/SectionHeading" ... />
		</LinearLayout>





And we'll use the same top-level list layout as we did in the previous section. To see what our list will look like with filled in sections and section headings, we can use the following screen file:





		<!-- layout/list_with_sections.xml -->
		<screen>
		<_content layout="@layout/list">
		<list>
			<items layout="@android:layout/simple_list_item_1" >
				<_item layout="@layout/section_heading">
					<heading text="Colours" />
				</_item>
				<_item>
				   <text1 text="Blue" textColor="#0000FF" />
				</_item>
				<_item>
					<text1 text="Yellow" textColor="#FFFF00" />
				</_item>
				<_item>
					 <text1 text="Pink" textColor="#FFC0Cb" />
				</_item>

				<_item layout="@layout/section_heading">
					<heading text="Places" />
				</_item>
				<_item>
					<text1 text="Victoria" />
				</_item>
				<_item>
					<text1 text="San Francisco" />
				</_item>
				<_item>
					<text1 text="London" />
				</_item>

				<_item layout="@layout/section_heading">
					<heading text="Numbers" />
				</_item>
				<_item>
					<text1 text="one" textSize="10sp" />
				</_item>
				<_item>
					<text1 text="myriad" textSize="14sp" />
				</_item>
				<_item>
					<text1 text="10↑↑↑↑3" textSize="24sp" />
				</_item>
			</items>
		</list>
	</_content>
	</screen>





Previewing this screen file will show exactly what our list looks like, with three sections each with a heading. You can change the number of sections, the content, or the layouts and styles of the items or headings, and quickly develop this UI. Getting a complex list view like this looking exactly right without Mirror can be frustrating; there's quite a bit of setup required to even see the list on a device, and tweaking multiple layouts to get things just right requires a frustrating amount of recompiling and reinstalling. Mirror makes developing complex layouts like this simple and enjoyable.





### Multiple item layouts





This example extends easily into lists whose actual content should be displayed differently depending on what it is. Without going into much explanation, we could modify the above screen file to use different layouts and attributes for the different kinds of items:





	 <!-- layout/list_with_sections.xml -->
		<screen>
		<_content layout="@layout/list">
		<list>
			<items>
				<_item layout="@layout/section_heading">
					<heading text="Colours" />
				</_item>
				<_item layout="@layout/colour_item">
					<colour text="Blue" textColor="#0000FF" />
				</_item>
				<_item layout="@layout/colour_item">
					<colour text="Yellow" textColor="#FFFF00" />
				</_item>
				<_item layout="@layout/colour_item">
					<colour text="Pink" textColor="#FFC0Cb" />
				</_item>

				<_item layout="@layout/section_heading">
					<heading text="Places" />
				</_item>
				<_item layout="@layout/place_item">
					<place text="Victoria" />
				</_item>
				<_item layout="@layout/place_item">
					<place text="San Francisco" />
				</_item>
				<_item layout="@layout/place_item">
					<place text="London" />
				</_item>

				<_item layout="@layout/section_heading">
					<heading text="Numbers" />
				</_item>
				<_item layout="@layout/number_item">
					<number text="one" textSize="10sp" />
				</_item>
				<_item layout="@layout/number_item">
					<number text="myriad" textSize="14sp" />
				</_item>
				<_item layout="@layout/number_item">
					<number text="10↑↑↑↑3" textSize="24sp" />
				</_item>
			</items>
		</list>
		</_content>
		</screen>





### Next time





[Next time]({{site.baseurl}}/2014/10/building-android-layouts-mirror-view-pagers/) we'll move on from ListViews and look at developing layouts with ViewPagers. Mirror makes it easy to quickly put together a screen with multiple pages that can be swiped through. This lets you develop your separate page layouts in the correct context, and get accurate feedback about the overall organization of your app.



