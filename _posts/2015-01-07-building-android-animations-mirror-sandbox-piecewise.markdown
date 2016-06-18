---
author: linton
comments: true
date: 2015-01-07 05:46:06+00:00
layout: post
slug: building-android-animations-mirror-sandbox-piecewise
title: Building Android animations with Mirror Sandbox, piecewise
id: 725
categories:
- Features
- News
- Tutorial
---

I am thrilled than ever to share this with you: we believe we've made an important step in making Android UI development easier. Yes! Mirror can now **hot-swap Java classes** of your custom views as you code. According to our initial testing, it usually takes 4-10 seconds to see the changes on the device -- slower than resource hot-swapping with Mirror but still a lot faster than building and deploying the full APK!





Moreover, Mirror will allow you to build and preview animations and interactions **in small pieces** – think of it as a [REPL](https://en.wikipedia.org/wiki/Read%E2%80%93eval%E2%80%93print_loop) for Android UI development. It's a great way to build UIs especially for dynamic things such as animations.





Typical use cases include:







  * Live-coding custom views, animations and interactions. Once satisfied, you can **directly use the animation code in production**.


  * Prototyping your app's UI by populating views with mock data where Mirror’s sample data XML doesn’t fit: `myCustomView.setData(someDataModel)`. Because it's plain old Java code, you can do whatever that Java allows (with some caution, see FAQ below).


  * Experimenting and learning UI related Android APIs by executing code piecewise - just as what you can do with REPLs in other languages such as Ruby.





## Usage





See the video below for a quick tutorial (It's 6-min but it's worth watching till the end, I promise. :))
<p><iframe width="560" height="315" src="//www.youtube.com/embed/r4r5g4tSwW0?rel=0" frameborder="0" allowfullscreen></iframe></p>






Or if you prefer reading text, there are two modes of usage:







  1. **Just live-coding custom views.** In this case, you don't need to make any changes to your project. Just click the button "Start Mirror" on Android Studio's toolbar, and Mirror will start monitoring changes to your Java source files in addition to resource XMLs. The updated code will be compiled and sent to the device, which the Mirror client uses to render the layout.


  2. **Prototyping the UI with Mirror Sandbox.** You will need to add a small open-source library dependency, [mirror-sandbox](https://github.com/jimulabs/mirror-sandbox), into your project, and create subclass(es) of `MirrorSandboxBase`. The benefit, as mentioned, is that you can preview your animations and interactions _piecewise_. We also built a few useful [wrapper classes](https://github.com/jimulabs/motion-kit) that make it a bit easier to create and choreograph animations. See the [Github repo](https://github.com/jimulabs/mirror-sandbox) for more details.





## FAQ





### How does it work?





Mirror achieves the fast code hot-swapping by only compiling the necessary Java files (updated files and their dependents) - it's incremental compilation in a sense. The resulting classes are then converted into a (small) `dex` file, which is sent to connected devices momentarily. The Mirror client loads the classes in this `dex` file using a custom class loader.





### Will it hot-swap all my Java files?





Actually no. Mirror only hot-swaps your custom views and their dependencies. It ignores classes that are not necessary for rendering layouts such as activities, fragments, services etc. Technically, as of now, all subclasses of `android.app.*` and `android.support.v4.app.*` are ignored.





### What code can I put in the "MirrorSandbox#enterSandbox()" method?





Mirror Sandbox is designed to help you build the user interface of your app, so generally you can put code that populates or animates views etc. The Mirror client only uses a small number of permissions such as internet. Expect errors if you write code that requires other permissions. And apparently, you don't want to put misbehaving code such as an infinite loop there.





### What's your Eureka moment?





Remember [Mirror.js]({{site.baseurl}}/mirrorjs-preview/)? It works pretty well as a prototyping tool and JavaScript scripts can be loaded and executed live as they are being edited. However, when it's time to code the actual production app, you don't want to reimplement the animations in Java from scratch, right? (See my talk at Droidcon London 2014, [Kill Design Specs](http://www.slideshare.net/lintonye/kill-design-specs-droidcon-london-2014))





In a rainy morning, I was contemplating how we could easily convert JavaScript scripts into Java code without producing a bunch of mess. Or maybe we could directly [compile it into bytecode](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/Rhino/JavaScript_Compiler)? Or maybe let's require users to ship apps with [Rhino](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/Rhino)? Aha! If we can hot-swap Java code quickly enough, why do we bother to convert?





Also we assumed that, because of the wide use of JavaScript in web design, it should be easier for designers compared to Java. But is that really the case? In fact writing Java code CAN be easier thanks to the awesome IDE support: error checking, code complete, quick access to documentation etc. My current hypothesis: people who can write JavaScript code will be able to at least write script-like Java code with proper tool support and good examples, at a higher speed. BTW, I made far fewer errors when making the video above in comparison to the [Mirror.js video]({{site.baseurl}}/mirrorjs-preview/). Which one is easier, Java or JavaScript? What do you think?





So here you go, we give you Mirror Sandbox!





### Still have questions? Make a comment below.





<blockquote>
  
> 
> Written with [StackEdit](https://stackedit.io/). <== I don't mind leaving this here as it's an awesome editor!
> 
> 
</blockquote>



