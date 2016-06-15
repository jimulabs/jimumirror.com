---
author: matt
comments: true
date: 2014-10-03 17:55:53+00:00
layout: post
slug: building-android-layouts-mirror-view-pagers
title: Building Android layouts with Mirror - View Pagers
id: 703
categories:
- Tutorial
---

_This is part of a series of posts on using Mirror to rapidly build your app's user interface. Mirror lets you see immediately how your layouts and resources look on your phone or tablet, without needing to code up mock adapters or constantly re-install your app. For a general overview of how to use Mirror, check out the [Mirror Tutorial](/mirror-tutorial)._





## Previewing page-based layouts with View Pagers





In the last two posts we looked at previewing lists using Mirror; we saw how to populate both [simple](/2014/09/building-android-layouts-mirror-listviews/) and [complex](/2014/09/build-android-layouts-mirror-complex-listviews/) lists. In this post we're going to look at view pagers. View pagers are a very common Android design pattern and form the backbone of the user experience for many apps. When you're implementing the layouts for the pages in a view pager, it's crucial to see the whole experience together to make sure the pages are consistent and are arranged in a sensible manner. Mirror lets you preview view pager based interfaces and, as usual, fill them with data to get an accurate view of your UI.





As an example, the Gmail app lets you swipe left and right to move between messages. Swiping left will switch to the next oldest message, and swiping right will switch to the next newest. This behaviour can be implemented using a `ViewPager`; let's see how to preview this UI using Mirror. We'll need two layouts for this example. The first is the "top-level" layout that will hold the pages. We'll call this layout `inbox_messages`:





[code lang="xml"]
<!-- layout/inbox_messages.xml -->
<ViewPager android:id="@+id/pager" ... />
[/code]





We'll also need a layout to hold each message -- let's call it `message`. We'll have a few fields for the message, such as `sender`, `subject`, and `content`, and we'll put everything in a `ScrollView` in case the message is too long to fit on one screen:





[code lang="xml"]
<!-- layout/message.xml -->
<ScrollView ...>
    <LinearLayout ...>
        <TextView android:id="@+id/sender" ... />
        <TextView android:id="@+id/subject" ... />
        <TextView android:id="@+id/content" ... />
    </LinearLayout>
</ScrollView>
[/code]





As always, Mirror previews screen files rather than layouts directly, so we'll need a screen file to preview everything. We want the screen file to show our `inbox_messages` layout, but fill the `ViewPager` with pages using he `message` layout. This is easy to do with sample data:





[code lang="xml"]
<!-- mirror/messages.xml -->
<screen>
  <_content layout="@layout/inbox_messages">
    <pager> <!-- the id of our ViewPager -->
      <_page layout="@layout/message">
        <sender text="James Gosling" />
        <subject text="Fault tolerance" />
        <content>In particular, you have to worry about how to build systems that can be robust
        and continue operating in the face of partial failures, because most of the systems that
        people are building that are of any interest are ones where there's always something
        that's broken.</content>
      </_page>
      <_page layout="@layout/message">
        <sender text="Bjarne Stroustrup" />
        <subject text="Complexity" />
        <content>The simple fact is that complexity will emerge somewhere, if not in the
        language definition, than in thousands of applications and libraries.</content>
      </_page>
      <_page layout="@layout/message">
        <sender text="Simon Peyton-Jones" />
        <subject text="Purity" />
        <content>You only have to reason about values and not about state. If you give a function
        the same input, it'll give you the same output, every time. This has implications for
        reasoning, for compiling, for parallelism.</content>
      </_page>
    </pager>
  </_content>
</screen>
[/code]





The key element here is the `<_page>` tag in the screen file. `<_page>` defines a single page in a view pager. The `layout` attribute specifies what layout the page should be filled with. Inside the `<_page>` element, you can reference views from that layout the same way you do inside the `<_content>` element. In this case, `sender`, `subject`, and `content` are all ids of views inside the `@layout/message` layout.





Start Mirror and open the `messages` screen: you'll see the first email message, and swiping left and right will switch between the three emails. Now you can edit and style the `message` layout and see the result in context, exactly as it will look in the running application.





### Next time





This gives an overview of how to create a basic page-based layout and fill in the pages. Often paging layouts come with some extra UI, particularly tabs. In the next post we'll add tabs to our layout by adding an action bar to our Mirror preview. We'll also look at populating the rest of the action bar, which will let us create very accurate previews that look exactly like the production app.





_Note:_ The quotes in the examples were taken from _Masterminds of Programming_, by Federico Biancuzzi and Shane Warden. It's a wonderful book and I recommend checking it out.



