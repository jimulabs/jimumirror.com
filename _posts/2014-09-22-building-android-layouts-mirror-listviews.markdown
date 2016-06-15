---
author: matt
comments: true
date: 2014-09-22 16:13:22+00:00
layout: post
slug: building-android-layouts-mirror-listviews
title: Building Android layouts with Mirror - ListViews
id: 689
categories:
- Tutorial
---

_This is part of a series of posts on using Mirror to rapidly build your app's user interface. Mirror lets you see immediately how your layouts and resources look on your phone or tablet, without needing to code up mock adapters or constantly re-install your app. For a general overview of how to use Mirror, check out the [Mirror Tutorial](http://jimulabs.staging.wpengine.com/mirror-tutorial)._





## Filling a ListView





ListViews are one of the core building blocks of Android apps, and they're almost always dynamic. Your ListView items can contain all sorts of data, and it's very useful to see how the list will look and feel on a phone or tablet once it's full. Getting an accurate view of how a list will look at runtime requires three pieces: the surrounding list layout, the layout (or layouts) of the items, and the data to be put in the list. Sample data makes this simple.





For this example, here are snippets from the list and item layouts. This example is from the [Mirror tutorial](/mirror-tutorial), which you should check out if you haven't already.





[code lang="xml"]
<!-- layout/list.xml -->
<LinearLayout ... />
    <ListView android:id="@+id/list" ... />
</LinearLayout>

<!-- layout/person_item.xml -->
<RelativeLayout ...>
    <TextView android:id="@+id/name" ... />
    <ImageView android:id="@+id/avatar" ... />
</RelativeLayout>
[/code]





Suppose we want to have a list with a few names in it. The automatically generated screen file for the `list` layout gives us the information we need to do this:





[code lang="xml"]
<!-- mirror/list.xml -->
<screen>
    <_content layout="@layout/list">
        <list>
            <items layout="@android:layout/simple_list_item_1" >
                <_item>
                    <text1>Vancouver</text1>
                </_item>
                <_item>
                    <text1>Cairo</text1>
                </_item>
                <_item>
                    <text1>New York</text1>
                </_item>
                <_item>
                    <text1>San Francisco</text1>
                </_item>
                <_item>
                    <text1>Seattle</text1>
                </_item>
                <_item>
                    <text1>Hong Kong</text1>
                </_item>
                <_item>
                    <text1>Tokyo</text1>
                </_item>
            </items>
        </list>
    </_content>
</screen>
[/code]





Mirror automatically fills lists with some random data like this to get you going quickly, but we need to make a couple of changes. First, we want to use our own `person_item` layout instead of the Android `simple_list_item_1` layout. We also want to change the text from cities to names, and add avatars for the list items:





[code lang="xml"]
<!-- mirror/list.xml -->
<screen>
    <_content layout="@layout/list">
        <list>
            <items layout="@layout/person_item" > <!-- item layout changed -->
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
                <_item>
                    <name>A really long name so we can see if our layout handles it gracefully</name>
                    <avatar src="@drawable/longname" />
                </_item>
            </items>
        </list>
    </_content>
</screen>
[/code]





And that's it! Now you can quickly fill in a list view with complex items and see how it'll look, without having to set up an adapter just for some dummy data.





### Lists with many items





You often want to see how a list will look with more than just a few items in it, but creating dummy data for each item is tedious and unnecessary. Mirror lets you repeat the items in a list to fill up a ListView quickly, using a `count` attribute. In the previous example, if we change `<items layout="@layout/person_item">` to `<items layout="@layout/person_item" count="5" />`, we'll end up with a list with 20 items: `Alice, Bob, Charles, reallylongname, Alice, Bob, Charles, ...`. Note that `count="1"` is the same as not having `count` at all, and `count="0"` will result in an empty list.





### Next time





[Next time](/2014/09/build-android-layouts-mirror-complex-listviews/) we'll push our ListViews a little further, creating complex ListViews with multiple item layouts. This will let us preview headers, sections, and heterogeneous lists. Thanks for reading!



