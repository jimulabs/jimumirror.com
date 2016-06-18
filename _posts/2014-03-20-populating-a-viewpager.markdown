---
author: eric
comments: true
date: 2014-03-20 20:04:34+00:00
layout: post
slug: populating-a-viewpager
title: Populating a ViewPager
id: 458
categories:
- Features
---

[ViewPager](http://developer.android.com/reference/android/support/v4/view/ViewPager.html) is a support library widget that makes it easy to create multiple pages that can be navigated with a swipe. When used with an action bar, we can create a tabbed UI. As of Mirror 1.3, we can populate a `ViewPager` with sample data the same way we use a `<_content>` tag to populate a `FrameLayout`. Under the hood, Mirror creates fragments and serves them to the `ViewPager` via a `PagerAdapter`. To see this in action, we will look at the MirrorMailProject sample that comes with Mirror.





Opening up `MirrorMail/src/main/res/layout/mail_list_view_pager.xml`, we find that it only contains one XML tag:




    
    <android.support.v4.view.viewpager xmlns:android="http://schemas.android.com/apk/res/android" android:layout_width="match_parent" tools:context="com.jimulabs.test.mirror.MainActivity" android:id="@+id/pager" android:layout_height="match_parent"></android.support.v4.view.viewpager>





[![a populated, swipeable ViewPager]({{site.baseurl}}/wp-content/uploads/2014/03/Capture-182x300.png)]({{site.baseurl}}/wp-content/uploads/2014/03/Capture.png)Doesn't look like much, does it? However, if we load the layout in Mirror, we will find it is a populated, swipeable `ViewPager`. How is this set up?





First, let's take a look at the corresponding XML file in the `mirror` directory. We call these Mirror-specific XML files "screen" files, and the regular Android XML files in the `layout` directory "layout" files. In this case, we are looking for the screen file with the same name as our layout file.





Open `mirror/mail_list_view_pager.xml`. We will talk about the `<actionbar/>` tag in a moment, but let's first see what is in our `<_content>` tag for the screen:




    
    <_content layout="mail_list_view_pager">
        <pager>
            <_page layout="@android:layout/list_content" title="inbox" icon="@drawable/ic_action_inbox">
                <list>
                    <items include="mails_inbox.xml"></items>
                </list>
            
            <_page layout="@android:layout/list_content" title="sent" icon="@drawable/ic_action_sent">
                <list>
                    <items include="mails_sent.xml"></items>
                </list>
            
            <_page layout="@android:layout/list_content" title="trash" icon="@drawable/ic_action_trash">
                <list>
                    <items include="mails_trash.xml"></items>
                </list>
            
        </pager>
    





The `<pager>` tag corresponds with the ID of our `ViewPager` in the layout file. This is how Mirror knows which element to populate with the children of the tag. In our `<pager>`, we have three `<_page>` tags as children. Each one of these has its own `layout` attribute, pointing to `@android:layout/list_content`, [a standard Android layout](http://developer.android.com/reference/android/R.layout.html#list_content). If we read [the source code for "list_content.xml"](http://grepcode.com/file/repository.grepcode.com/java/ext/com.google.android/android/4.4.2_r1/frameworks/base/core/res/res/layout/list_content.xml/), we find that it contains a `ListView` element with the ID "list". This matches our `<list>` tag in each `<_page>`.





Mirror can populate anything that extends `AdapterView` (including `ListView`) using an `<items>` tag. Here we make use of the `include` attribute, an optional way to keep your screen files from getting too large. We could just as easily have put all of the items of each page in the same file, but we split it up to be less overwhelming to read. Each `<_page>` includes items from different XML files in the "mirror" directory.  All three of them are quite similar, so let's take a look at `mirror/mails_inbox.xml`.




    
    <items layout="mail_list_item">
        <_item>
            <avatar src="images/ava1.png"></avatar>
            <snippet>I've got to admit it's getting better. It's a little better all the time.</snippet>
            <subject>Have you seen the new version of Mirror?</subject>
            <time>17:35</time>
            <from>Paul McCartney</from>
        
        ...
    </items>





There are lots of items in the list, so we have truncated it to inspect just one item. An important thing to note is that the root tag of this XML file is `<items>`, which matches our `<items include="mails_inbox.xml">` tag. This root tag also has an attribute `layout="mail_list_item"`. This points Mirror towards the layout file `MirrorMail/src/main/res/layout/mail_list_item.xml`. `mail_list_item.xml` has many elements with IDs like "avatar", "snippet", and "subject", which are all populated by the matching tags in our `mails_inbox.xml` items file.





[![ava1]({{site.baseurl}}/wp-content/uploads/2014/03/ava1.png)]({{site.baseurl}}/wp-content/uploads/2014/03/ava1.png)Look at `<avatar>` and find the matching element in the layout file. We can see in our layout file that "avatar" is the ID of a custom view called `com.jimulabs.samples.mirrormail.CircularImageView`. Mirror will try to set any valid attribute it finds in a screen file, just like Android sets attributes from a layout file; when it encounters the attribute `src="images/ava1.png"`, it will set the `CircularImageView`'s `src` attribute to `mirror/images/ava1.png` (in this case a portrait of Sir Paul).





So what about that `<actionbar/>` tag in `mirror/mail_list_view_pager.xml` we said we would come back to? Here it is:




    
    <actionbar menu="@menu/list_menu" title="Mailboxes" icon="@drawable/inbox" showtabsfor="@id/pager"></actionbar>





What probably sticks out most is the `showTabsFor="@id/pager"` attribute. This attribute tells the action bar that it should show a tabbed interface for an element with the ID "pager". What does this mean? Remember how each `<_page>` tag had a couple of attributes, `title` and `icon`? These two attributes control what shows up in the action bar. `showTabsFor` will tell Mirror which tag to look in to find these attributes.





With this in place, we now have a fully-populated, multi-tabbed `ViewPager`. And, of course, any changes you make to your layout and screen files will be reflected immediately in Mirror. Leave a comment in our [Google+ community](https://plus.google.com/u/0/communities/100032204836569153341) or send us an email at [support@jimulabs.com](mailto:support@jimulabs.com) for more help with getting your own `ViewPager` going with Mirror.



