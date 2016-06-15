---
author: linton
comments: true
date: 2014-01-08 06:22:46+00:00
layout: post
slug: mirror-dropbox-remote-mirror
title: Mirror + Dropbox = "Remote Mirror"
id: 408
categories:
- Features
---

**TL;DR** - Use Mirror and Dropbox to collaborate on UI tasks remotely. Does it sound useful? Leave your comments in [this G+ thread](https://plus.google.com/105955309246186974515/posts/EDLNNSwQemJ).



#### "Remote Mirror"


jimu Mirror allows designers and developers to collaborate in real time and create UI in rapid iterations. Instead of relying on redlines, emails and bug tickets to communicate every UI change that has to be done, which is slow and tedious, you just need to sit together, make a change, check it out on devices and resolve UI issues instantly.

However, what if you are traveling or you are part of a distributed team? This is where the "Remote Mirror" concept comes in: _one person edits layouts, another person at another location sees the preview updates on her/his devices right away_.

Sounds useful? We are toying around this idea and hope to bring it to life in the near future.



#### Mirror + Dropbox


In fact, You don't have to wait! It's fairly easy to simulate Remote Mirror with Dropbox and two installations of Mirror. You probably have already figured it out, right? Correct, just put the project directory in a shared Dropbox folder, and run MirrorServer at both locations. When one person edits a layout file, which will be syncced by Dropbox, and at the other end, MirrorServer detects the file change and push the new resources onto connected devices. It's pretty fast according to our preliminary test (1-2 extra seconds for a change to show up at the other end).



#### Issues / Limitations


Of course this method is not perfect. First, you'll see quite a few conflicts in the "mirror" directory because the MirrorServer on both sides try to change the same files after a resource file is updated. This will cause some unnecessary resource pushes and it's unknown whether the compiled resources (.ap_) would be broken in some cases. More importantly, as our initial test shows, if you update your custom views and try to preview it by rebuilding the project, it takes much longer for the change to show up at the other end (at least a few minutes in our test). There are simply way too many files to sync via Dropbox after a rebuild. 



#### Conclusion


I believe "Remote Mirror" has the potential to change the workflow of UI design and development for Android apps. By combining Mirror and Dropbox, we can at least get a taste of it. Do you think if it's a useful feature? Let us know in [this G+ thread](https://plus.google.com/105955309246186974515/posts/EDLNNSwQemJ). Thanks for reading!
