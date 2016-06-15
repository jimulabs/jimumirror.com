---
author: linton
comments: true
date: 2012-07-10 22:34:11+00:00
layout: post
published: false
slug: what-the-google-stole-my-ideas
id: 72
title: What the ..., Google stole my ideas?!
categories:
- Story
---

“Google stole our ideas!” I almost shouted out while watching [the ADT talk](https://www.youtube.com/watch?v=Erd2k6EKxCQ&feature=player_embedded#!) at Google I/O a couple of weeks ago.  On the big screen, they were demoing the shiny new project wizard and the template feature in ADT 20. Oh boy,  these features just looked so familiar to me -- the use of templates to generate best practice code, the master/detail activity template, the revamped UI, the diff preview after creating a new activity, and even the “templates” directory in the Android SDK all resemble some elements of [jimu](/), a dev tool we’ve been building for a while.

Yes, I can only call this a “speculation”.  It's possible too that they might have come up with these features coincidentally.  And the basic idea of code templates is not new.  But it's interesting to consider these similarities together with the timing of the development of ADT.

Back in early April and May, we sent Google a few screencasts and a demo version of jimu.  We had hoped to get involved in I/O and also find a way to develop jimu together with Google, because we had imagined a partnership where we focus on building the tool framework while Google provides expertise on Android.  Our contact at Google told us that they liked the idea and “there’s some lively conversation internally at Google”.  We haven't had any direct contact with the Android tools team, but I guess they had looked at our work.  After I/O, we were curious enough to dig into the source of Android SDK.  We found that the new UI and the template support didn’t appear until May 7, when there came a [giant commit](https://android.googlesource.com/platform/sdk/+/7dd444ea0125e50a5e88604afb6de43e80b7c270) titled "New Template Wizard Support".  That seems to be the very first commit for the feature.  As I said, the timing is interesting since it’s about a month after we sent them our screencasts.  I was bothered by the possibility that they might have taken our ideas without giving us any credit.  It took me quite a while to get over it.

But eventually I managed to see this from a positive angle.  It actually gave me more confidence in the direction we are taking.

No matter if they have peeked our work or come up with it coincidentally, Google gave the nod to these ideas by not only experimenting but also productizing them.  Undoubtedly, the Android team agrees with us on the potential of template tools in addressing some [pressing issues](/blog/2012/06/19/the-making-of-jimu-1/) that make Android programming difficult.

This basic idea of templates is where we got started, but we have retouched it with a twist -- jimu is much more than a few handy templates to just get you a head start, as included in ADT 20.  jimu consists of templates that are smart and versatile.  It is designed to be used throughout development, ranging from rapidly creating complete apps from scratch, to evolving existing apps with fine features, to helping developers better understand and reason about their code when the app is done.  We believe some elements in jimu have the potential to disrupt how software is developed.  What we have implemented and demonstrated is just a portion of a bigger picture, and Android is just our first test field.

I will devote another post to talk about our other ideas and the bigger picture.  Again I will discuss these ideas in the open since I think it’s the only best way to build something truly useful.

Thanks for reading, and I look forward to your comments.

**Update 0712**: this post has received a lot of attention since I posted on Hacker News yesterday -- almost 3000 unique visitors within the first hour while it's on HN home page, and a maximum of 378 simultaneous users.  Readers have left a few interesting comments both [on HN](http://news.ycombinator.com/item?id=4230241) and here.  I feel necessary for an update.  First of all, the point of this post is to share my journey of managing to flip my attitude from negative to positive, much more than accusing Google or trying to get something back from them.  Writing this post has helped me focus on what I should do rather than whining, and I think it might be useful for folks with similar experience too.  Second, I totally agree that ideas don't inherently imply success.  Good ideas are just a good start.  What really makes the difference is the vision behind and the underlying execution.  At this point we have [implemented some ideas](/) and are exploring some more.  Finally, I believe the idea behind jimu is definitely more interesting than just a few template wizards which have been in existence since a long time ago.  Check out [this screencast](http://www.youtube.com/watch?v=6uUGD3IJyLM&feature=player_embedded) if you don't believe me. :)


**PS: Screenshots of jimu and ADT.**

_**1. Project Wizard**_

ADT - the Project Wizard before the May 7 change, where important settings such as "Build Target" and "Minimum SDK" scatter across different screens, making the UI hard to understand and work with.

[![](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.57.23-PM-150x150.png)](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.57.23-PM.png)  [![](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.58.29-PM-150x150.png)](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.58.29-PM.png)  [![](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.58.50-PM-150x150.png)](/wp-content/uploads/2012/07/before0507-Screen-shot-2012-07-07-at-1.58.50-PM.png)


 jimu - Project Wizard: consolidate important project settings and graphical preview into one easy-to-use wizard step.




[![](/wp-content/uploads/2012/07/Screen-shot-2012-07-11-at-10.05.40-AM-150x150.png)](/wp-content/uploads/2012/07/Screen-shot-2012-07-11-at-10.05.40-AM.png)







ADT 20 - the revamped wizards with similar consolidated wizard step and graphical preview of a template.










[![](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.36.12-AM-150x150.png)](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.36.12-AM.png) [![](/wp-content/uploads/2012/07/Screen-shot-2012-07-11-at-10.09.20-AM-150x150.png)](/wp-content/uploads/2012/07/Screen-shot-2012-07-11-at-10.09.20-AM.png)














_** 2. Diff Preview**_







jimu - Diff Preview: Preview code changes before applying a template







[![](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.32.08-AM-150x150.png)](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.32.08-AM.png)


ADT 20 - similar diff preview before applying a template.

[![](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.37.16-AM-150x150.png)](/wp-content/uploads/2012/07/Screen-shot-2012-07-10-at-11.37.16-AM.png)
