---
author: linton
comments: true
date: 2014-08-08 01:04:56+00:00
layout: page
fullscreen: true
slug: mirrorjs-preview
title: 'Mirror.js: Live prototyping native Android, in JavaScript'
id: 532
---

## Note: We have stopped the development of Mirror.js and put what we've learned into Mirror Sandbox, a set of new features based on Java code hot-swapping. See [this post](/2015/01/building-android-animations-mirror-sandbox-piecewise/) for details.









[Feature overview and howtos](/mirror-js-overview/)








![mirrorjs](/wp-content/uploads/2014/08/mirrorjs.gif)

Mirror.js: Live prototyping native Android, in JavaScript





<div class="social-sharing ">
	        <a onclick="return ss_plugin_loadpopup_js(this);" rel="external nofollow" class="button-googleplus" href="https://plus.google.com/share?url=http%3A%2F%2Fjimulabs.com%2Fmirrorjs-preview%2F" target="_blank">Share on Google+</a><a onclick="return ss_plugin_loadpopup_js(this);" rel="external nofollow" class="button-facebook" href="http://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fjimulabs.com%2Fmirrorjs-preview%2F" target="_blank">Share on Facebook</a><a onclick="return ss_plugin_loadpopup_js(this);" rel="external nofollow" class="button-twitter" href="http://twitter.com/intent/tweet/?text=Mirror.js%3A+Live+prototyping+Android%2C+in+JavaScript&amp;url=http%3A%2F%2Fjimulabs.com%2Fmirrorjs-preview%2F&amp;via=jimulabs" target="_blank">Share on Twitter</a>	    </div>	    








* * *





## Overview





_Mirror.js preview_ is a set of experimental features that we are considering to integrate into jimu Mirror. It reflects some of our thoughts on how the workflow for designing and developing modern Android UI could be improved. 



The Android Studio plugin available on this page is a superset of [jimu Mirror](/mirror-downloads). You can try "Mirror.js" for free just as Mirror itself. If you need more time, please [submit a request](https://docs.google.com/forms/d/1z9nfpyWHdS5AnPEm14nyQeI1jcbOzdIx_DyWkjb4rjI/viewform). We'd really appreciate your feedback that will shape the future of Mirror (and the future of Android development). You can either visit our [Google+ community](http://bit.ly/mirror_gplus), or email to [support AT jimulabs.staging.wpengine.com].



## Installation




In Android Studio/IDEA, `Preferences (or Settings) -> Plugins -> install plugin from disk`, and then choose the downloaded zip file.





## Features





  
  * **Preview native animations live**: you can specify and choreograph Android's native animations in JavaScript. The updated animations are instantly picked up and displayed by Mirror just as your layouts and other resources. This particularly helps when tweaking parameters of XML based animators before using it in Java code. 

  
  * **Create prototypes with screen transitions**: you can create complete and realistic prototypes with accurate animation effects and transitions. The resulting prototypes look and behave very close to the app when it's finished. This means that you can collect high quality feedback way before the function code is implemented. This saves everyone's time and improves product quality.

  
  * **Share your work as an APK**: you can export your work to an APK which can be installed and run on a device just as any APKs. 



