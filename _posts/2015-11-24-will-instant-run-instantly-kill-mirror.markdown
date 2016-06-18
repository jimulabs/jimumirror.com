---
author: linton
comments: true
date: 2015-11-24 21:54:10+00:00
layout: post
slug: will-instant-run-instantly-kill-mirror
title: Will "Instant Run" instantly kill Mirror?
id: 804
categories:
- Features
---

_This post was meant to be an internal note, but we decided to think aloud and open it up for broader discussion in the community. Your feedback would be highly appreciated._





[![Instant run tweet]({{site.baseurl}}/wp-content/uploads/2015/11/Screen-Shot-2015-11-24-at-1.34.06-PM.png)]({{site.baseurl}}/wp-content/uploads/2015/11/Screen-Shot-2015-11-24-at-1.34.06-PM.png)





To be honest, we've been living in the fear of this for a couple of years, since the onset of jimu Mirror. I'm actually surprised that the day hasn't come sooner (we demoed Mirror to two different groups from the Android tools team back since early 2014).





Apart from facing the anxiety and uncertainty, we are proud of being the first (to our knowledge) to bring some elements of live-coding to Android. We are thrilled to see that Mirror has helped many of you save time and build better apps, and we are grateful for your generous support.





So what are we going to do with Mirror? One thing is for sure, Android Studio 2.0 looks like a step in the right direction and Instant Run would be a bliss to fellow developers, but it doesn't mean that Android dev tools are perfect. There are even opportunities to build upon Instant Run to do something useful if it proves to be a superior solution (they have some interesting design decisions, for example, the main classes are not reloaded during  a refresh). We'll continue to innovate in the tools space the way we've always been. We'll keep fixing bugs and adding features (maybe slowly but steadily).





The key difference between Mirror and other similar tools is that it's mainly a tool for building UI, rather than previewing the entire app. That's why we have [sample data]({{site.baseurl}}/mirror-docs/mirror-tutorial/) and [Mirror Sandbox](https://github.com/jimulabs/mirror-sandbox). With Mirror, you can create full-fidelity prototypes before coding adapters or fragments. We think this prototype-first approach leads to more effective collaboration across the team.





What do you think? Have you used Mirror to build prototypes? What other things do you think we could make Mirror useful? I'd really appreciate your feedback.





Will Instant Run kill Mirror? I guess only if we let it be killed.



