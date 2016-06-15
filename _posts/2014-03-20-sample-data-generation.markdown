---
author: eric
comments: true
date: 2014-03-20 21:46:05+00:00
layout: post
slug: sample-data-generation
title: Sample Data Generation
id: 462
categories:
- Features
---

_Written in collaboration with [Matt](/author/matt/)._

Making good use of sample data is key to getting the most out of Mirror. With sample data you can fill your layouts with text, images, and other values to simulate conditions in your running app. This lets Mirror show you exactly what your app will look like when its finished. Mirror automatically creates sample data files that correspond to the layouts in your resource directory. In Mirror 1.3 we've made these starting files a lot more useful so you can get started with sample data on your projects quickly. For information on how to get started with sample data and what you can do with it, see our [tutorial](/mirror-tutorial/) and [sample data spec](/sample-data-specifications/).

Let's take a look at the MirrorMail sample project that's included with Mirror. This app has an activity_list layout that displays a list of emails in an inbox. Included in that layout is a ListView for showing the emails:


    
    <listview android:dividerheight="1dp" android:orientation="vertical" android:layout_width="match_parent" android:id="@+id/mail_list" android:layout_height="match_parent"></listview>



For each of the emails we want to show a few different pieces of information, including the sender (a name and picture), the subject line, and a preview of the content. MirrorMail has a layout mail_list_item that controls how an individual email appears in the list:


    
    <com.jimulabs.samples.mirrormail.circularimageview android:layout_gravity="center_vertical" android:scaletype="center" android:layout_width="@dimen/list_avatar_width" android:layout_margin="@dimen/list_avatar_margin" android:id="@+id/avatar" android:layout_height="@dimen/list_avatar_width"></com.jimulabs.samples.mirrormail.circularimageview>
    
    <textview android:layout_width="wrap_content" android:id="@+id/from" android:layout_aligntop="@id/avatar" android:textcolor="?android:attr/textColorPrimary" android:singleline="true" android:layout_torightof="@+id/bullet" android:includefontpadding="false" android:layout_height="wrap_content" android:textsize="@dimen/from_font_size"></textview>
    
    <textview android:layout_width="wrap_content" android:id="@+id/subject" android:textcolor="?android:attr/textColorSecondary" android:fontfamily="sans-serif-light" android:singleline="true" android:layout_torightof="@id/avatar" android:layout_height="wrap_content" android:textsize="@dimen/subject_font_size" android:layout_marginright="@dimen/list_margin_right" android:layout_below="@id/from"></textview>
    
    <textview android:layout_width="wrap_content" android:id="@+id/snippet" android:fontfamily="sans-serif-light" android:textcolor="?android:attr/textColorTertiary" android:layout_torightof="@id/avatar" android:layout_height="wrap_content" android:textsize="@dimen/snippet_font_size" android:layout_marginright="@dimen/list_margin_right" android:layout_below="@id/subject"></textview>



We've provided detailed sample data files with MirrorMail, but if you were to generate fresh ones with Mirror they'd look like this:

`mirror/activity_list.xml`


    
    
    <screen>
        <_content layout="@layout/activity_list">
            <mail_list>
                <items>
                    <_item layout="@android:layout/simple_list_item_1" count="3">
                        <text1>sample item</text1>
                    
                </items>
            </mail_list>
            ...
        
    </screen>



`mirror/mail_list_item.xml`


    
    
    <screen>
        <_content layout="@layout/mail_list_item">
            <avatar></avatar>
            <flag></flag>
            <time></time>
            <bullet></bullet>
            <from></from>
            <attachment></attachment>
            <subject></subject>
            <snippet></snippet>
        
    </screen>



It's pretty easy to figure out what's going on here: in mail_list_item, tags have been created for the different views in the layout. You can use these tags to populate the layout. We really want to preview the item layout _within_ activity_list though. activity_list already has a skeleton for our mail_list ListView, let's fill that in with some mail_list_items:


    
    <screen>
        <actionbar menu="list_menu" icon="inbox" title="INBOX"></actionbar>
        <_content layout="activity_list">
            <mail_list>
                <items include="list_content.xml"></items>
            </mail_list>
            ...
        
    </screen>



Now if you check out the Mirror app on your attached device or emulator and select activity_list, you should see a pretty useful preview of your layouts:

[![Capture2](/wp-content/uploads/2014/03/Capture2-182x300.png)](/wp-content/uploads/2014/03/Capture2.png)

I hope this post has shown how generated sample data makes it easy to start developing with Mirror quickly. We plan on further improving the generated sample data in the future, and would love to hear any comments or feedback you have. Leave a comment in our [Google+ community](https://plus.google.com/u/0/communities/100032204836569153341) or send us an email at [support@jimulabs.com](mailto:support@jimulabs.com).

