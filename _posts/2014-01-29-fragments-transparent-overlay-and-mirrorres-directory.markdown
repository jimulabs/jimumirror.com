---
author: linton
comments: true
date: 2014-01-29 05:00:06+00:00
layout: post
slug: fragments-transparent-overlay-and-mirrorres-directory
title: Fragments, transparent overlay and "mirror/res" directory
wordpress_id: 414
categories:
- Features
---

_**TL;DR**: Mirror 1.2 introduces three premium features: initial fragment support, transparent overlay and "mirror/res" directory, useful features that help you build layouts and hi-fi prototypes more quickly. [Get Mirror now](/)._

Ladies and gentlemen, fragment support is here!

Well, it's just some initial support but we think it's already useful and it will help you build layouts with fragments in mind. We just can't wait to share it with you. Also, we've added two interesting features that you might find useful: transparent overlay and "mirror/res" directory. Fasten your seatbelts and let me give you a quick tour!


### Fragments


Let's say your app has a master-detail structure and shows one pane on phones and two panes on tablets. The layout files are as below:

    
    <!-- res/layout/activity_main.xml -->
    <LinearLayout ...>
      <fragment android:id="@+id/master" .../>
    </LinearLayout>
    
    <!-- res/layout-sw720dp/activity_main.xml -->
    <!-- res/layout-sw600dp-land/activity_main.xml -->
    <LinearLayout ...>
      <fragment android:id="@+id/master" .../>
      <FrameLayout android:id="@+id/details" .../>
    </LinearLayout>


How do you populate the layouts with sample data in Mirror? The answer is the "_content" tag. Starting from Mirror 1.2, you can use the "_content" tag inside a populator which corresponds to a "fragment" tag, "FrameLayout", "RelativeLayout" or "LinearLayout". (BTW: "populators" are variably named tags that select views in your layout by id). Inside the "_content" tag, you can use populators to fill the specified layout with sample data, just like you do with root level populators:

    
    
    <screen>
      <_content layout="@layout/activity_main">
        <master>
          <_content layout="@android:layout/list_content">
            <list>
              <items include="mails.xml" />
            </list>
          </_content>
        </master>
        <details>
          <_content layout="@layout/details_pane">
            <from>Paul McCartney</from>
            <subject>Have you seen the new version of Mirror?</subject>
          </_content>
        </details>
      </_content>
    </screen>


If you preview this in Mirror, you'll see one pane ("master") on phones and two panes ("master" and "details") on tablets, all populated with the sample data you specified.

Under the hood, Mirror attaches a fragment for each "_content" tag using "FragmentManager" just as your app code would do.

In the sample project "MirrorMail" that comes with MirrorServer, preview "activity_list" in landscape mode and you can see this feature in action.


#### "include"


Similar to "items" and "_item", "_content" tag can include another file using the "include" attribute:

    
    <!-- mirror/activity_main.xml -->
    ...
      <details>
        <_content include="details_content.xml" />
      </details>
    ...
    
    <!-- mirror/details_content.xml -->
    <_content layout="@layout/details_pane">
       <from>Paul McCartney</from>
       <subject>Have you seen the new version of Mirror?</subject>
    </_content>




#### Limitations


A few limitations of the fragment support as of Mirror 1.2:



	
  * "_content" cannot be nested. That is, [nested fragments](http://developer.android.com/about/versions/android-4.2.html#NestedFragments) are not yet supported.

	
  * "ViewPager" isn't supported yet (it should come very soon, though)

	
  * Mirror does not use either "android:name" or "tools:layout" attribute in the "fragment" tag in Android layouts.




### Transparent overlay


What's it about? A picture is worth a thousand words:

[![overlay](/wp-content/uploads/2014/01/overlay-614x1024.png)](/wp-content/uploads/2014/01/overlay.png)

Got it? You can now overlay a hi-fidelity mockup your designer creates on top to make pixel-perfect layouts. The overlay covers the entire screen space your app uses including the action bar. It's easy to turn the overlay on (and off) with an "overlay" attribute on the "screen" tag:

    
    <screen overlay="@drawable/mockup">
    ...
    </screen>


We think this feature would be useful if your workflow involves a process of "matching this comp on this particular device", and it's a fun and easy feature to build.  Maybe you can find other creative ways to use it.

However, it's worth mentioning that [this workflow is questionable](http://blog.teamtreehouse.com/psd-to-html-is-dead) in the world of responsive design, and having designers create mockups of many versions sounds counter-productive.  We are always trying to come up with something better. Let us know in the comment if you have any ideas to share.


### "mirror/res" directory


Starting from 1.2, MirrorServer automatically creates a "res" directory inside the "mirror" directory, which has the same structure as Android's "res" directory. You can use the same qualifiers in the directory names such as "drawable-hdpi". So if you have some resources that you'd like to preview but don't want to pollute your production resources, put them in "mirror/res". A good use case is to put overlay mockups for different screen densities, sizes and orientations here and have Android automatically determine which mockup to use on the device (again, assuming your designers are happy to create these mockups).


### Conclusion


In Mirror 1.2, we introduce three premium features including initial fragment support, transparent overlay and "mirror/res" directory. Let us know your thoughts in the comment area below, or [get Mirror now](/mirror-downloads/)!
