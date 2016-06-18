---
author: linton
comments: true
date: 2014-12-11 22:12:44+00:00
layout: post
slug: journey-lollipop-transitions-part-1
title: 'My Journey to Lollipop Transitions: part 1'
id: 717
categories:
- Story
---

_What you'll see below isn't a tutorial, but a journey of what I've tried and experienced. If you can learn one thing or two after watching me stumbling through the process, I'd find this writing well worth the time. All the code discussed below is available on [Github](https://github.com/jimulabs/google-music-mock), with each round being on its own branch._





I've heard good things about the new APIs in Lollipop such as reveal and window transitions -- looks like you can do lots of cool stuff with just a couple of lines, awesome! I couldn't resist giving it a spin.





Rather than simple examples, my goal was to implement some real-world-ish effects similar to the example found in [Google's Material design guideline](http://www.google.com/design/spec/animation/meaningful-transitions.html#meaningful-transitions-visual-continuity), adapted to a phone form factor:





![final-result]({{site.baseurl}}/wp-content/uploads/2014/12/final-result.gif)













Since I already had the layouts and dummy data, I expected it to take no more than a couple of hours. But guess what? It took me more than two days and quite a few rounds of trial-and-errors. There are quite a few glitches and gotchas that you'll probably run into too.





I'll start with my first round, and follow up with other rounds in future posts (as it's getting long).





## Round 1: window content transitions





It's straightforward to dissect the animations into a few parts:







  1. the shared view transition between the `AlbumListActivity` and `AlbumDetailActivity`,


  2. the reveal effect on `AlbumDetailActivity`,


  3. the scaling effect of the FAB on `AlbumDetailActivity`,


  4. the "folding/unfolding" effect of the two panels below the album art image on `AlbumDetailActivity`,


  5. and the fading effect of the `TextView`s in the panels (this is probably not very noticeable in the video)





My first instinct after reading the [doc](https://developer.android.com/training/material/animations.html#Transitions) is to take full advantage of the brand new activity/window content transition APIs. You know, use the shared view transition for 1; and for 2-5, set a choreographed `TransitionSet` to `windowEnterTransition` and `windowExitTransition`.





Sounds easy, right? Wait a sec, what's `windowReturnTransition`? And `windowReenterTransition`? Huh? What about `windowSharedElementEnter/Exit/Return/ReenterTransition`? Thankfully, Alex Lockwood wrote an excellent [post](http://www.androiddesignpatterns.com/2014/12/activity-fragment-transitions-in-android-lollipop-part1.html) about them -- good time for a revisit!





Yup it's a bit daunting to have 2x4 different types of transitions. But I'd only need to worry about `sharedElementEnterTransition`, `windowEnterTransition` and `windowReturnTransition` for now. The system will create sensible defaults for the other five. (BTW: when I got started, I actually mistakenly used `windowExitTransition` when I was supposed to use `windowReturnTransition`. So be careful!)





### Shared element transition





It turned out that the shared element transition was the easiest step in this whole (tiny) project. `ActivityOptions.makeSceneTransitionAnimation()` and boom, it just worked.





It's not without issues, though. For one thing, sometimes the entire transition is skipped and it just plays the default bottom-to-top animation on my Nexus 5 -- looks like a bug to me. (**Update Jan 3, 2015:** I saw this issue on Android 5.0.0, but it's no longer reproducible as of 5.0.1, see [here](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/cn4iw1n) for details)





Also, while the shared view is moving, it covers everything on its path, including the views that are supposed to be above. As shown in the (slowed-down) video below, the top of the cyan FAB button is covered up (and hence the flickering), and even the system navigation bar!
<div class="fivecol" style="float:none; margin-bottom:20px;">
<iframe width="282" height="500" src="//www.youtube.com/embed/pClWvtlHprg?controls=0&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>












Without looking at the code, my guess is that the animation happens on an overlay of the window, which naturally covers everything on the screen. Probably we should draw the FAB (and system navigation bar) on the overlay as well? (Insert x hours of reading `PhoneWindow.java`, `ActivityTransitionCoordinator.java` etc to confirm)





**Update**: As reddit user scep12 [pointed out](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/), there's a way to turn off the overlay: `Window#setSharedElementUseOverlay()`. In my experience, the flag on both `AlbumListActivity` and `AlbumDetailActivity` needs to be set to avoid the flickering on the FAB and system navigation bar. The animation is a little different, you can try and see on the ["round-1-window-content-transitions" branch](https://github.com/jimulabs/google-music-mock/tree/round-1-window-content-transitions).
**Update Jan 3, 2015**: Alex Lockwood analyzed the pros and cons of using `setSharedElementUseOverlay()` and also mentioned another approach to avoid this glitch, see [this post](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/cn4iak3).





### Window enter transition





Now it's time to cook the enter transition of `AlbumDetailActivity`. It's straightforward to enable the transition in code as below (or in the theme in XML):





`getWindow().setWindowEnterTransition(transition)`





The rest is to create and choreograph the transitions.





#### Custom transitions





Soon I figured I had to write my own `Transition` classes for the revealing, scaling and "folding/unfolding" effects. Two of these classes are _seemingly_ straightforward (see [Fold](https://github.com/jimulabs/google-music-mock/blob/round-1-window-content-transitions/app/src/main/java/com/jimulabs/googlemusicmock/transition/Fold.java) and [Scale](https://github.com/jimulabs/google-music-mock/blob/round-1-window-content-transitions/app/src/main/java/com/jimulabs/googlemusicmock/transition/Scale.java)), while the reveal transition deserves a separate section.





In fact, I used "seemingly" above because some extra care should be taken when writing custom transitions which I didn't realize until finishing this post. So all of my `Fold`, `Scale` and `RevealTransition` classes need to be revised. I'll reserve a future post specifically for custom transitions (if I can't find a good article about it by then).





#### Transition choreography





The next step is to choreograph the rest of the transitions. I used `TransitionSet` with two different orderings: `TransitionSet.ORDERING_SEQUENTIAL` and `ORDERING_TOGETHER`, and also `Transition#setStartDelay()`. Further, I need to set the target of the transitions to limit them to only the views I wanted to animate.





Something like this:





	  fadeFab.setStartDelay(500);
 	 ...
	  Fold foldTitleContainer = new Fold();
 	 foldTitleContainer.addTarget(R.id.title_container);
	  ...
 	 TransitionSet panelsSet = new TransitionSet();
	  panelsSet.setOrdering(TransitionSet.ORDERING_SEQUENTIAL);
	  panelsSet.addTransition(titleContainerSet);
 	 panelsSet.addTransition(infoContainerSet);





Later I decided to switch to XML as the declarative format was supposed to be easier to manage (see [album_detail_enter.xml](https://github.com/jimulabs/google-music-mock/blob/round-1-window-content-transitions/app/src/main/res/transition/album_detail_enter.xml) and [album_detail_return.xml](https://github.com/jimulabs/google-music-mock/blob/round-1-window-content-transitions/app/src/main/res/transition/album_detail_return.xml)).





Here's a snippet:





		<transitionSet xmlns:android="http://schemas.android.com/apk/res/android"
		    android:transitionOrdering="together">
		    <transitionSet android:transitionOrdering="sequential">
		        <transitionSet android:transitionOrdering="together">
		            <transition class="com.jimulabs.googlemusicmock.transition.Fold">
		                <targets>
		                    <target android:targetId="@id/title_container" />
		                </targets>
		            </transition>
		            <fade>
		                <targets>
		                    <target android:targetId="@id/title" />
		                    <target android:targetId="@id/subtitle" />
		                </targets>
		            </fade>
		        </transitionSet>
		  ...
		</transitionSet>





Is it really easy to read and change, though? I don't know about you, but for me, I see a full page of `target`, `transition`, `android` etc. The information about how the transitions are choreographed is buried in the noisy XML. Remember, if you are designing these transitions, you don't know how they will look until you can actually see them in action. Imagine spending some quality time to make sense of this XML, tweak the timing and playing orders, run the app to check the animation and repeat... good luck. There's gotta be a better way! (hint, hint)





Anyways, we can inflate this transition and set it to the window:





  TransitionInflater inflater = TransitionInflater.from(this);
  Transition transition = inflater.inflate(R.transition.album_detail_enter);





And here's what it looks like (without the reveal effect). There's some weird flickering at the beginning of the enter transition and I'll cover it in round 3 (yeah, I couldn't manage to solve it until round 3).
<div class="fivecol" style="float:none; margin-bottom:20px;">
<iframe width="282" height="500" src="//www.youtube.com/embed/6ywyDhEcxJA?controls=0&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>












### Reveal transition





Let's come back to the reveal transition. Normally you would use `ViewAnimationUtils.createCircularReveal()` to get a `RevealAnimator`, which, interestingly, is a public but hidden class (probably Google isn't super happy about the implementation yet?).  Since it's just an `Animator`, I can just use it in my `RevealTransition`:





	  @Override
	  public Animator onAppear(ViewGroup sceneRoot, View view, TransitionValues startValues, TransitionValues endValues) {
	      Animator animator = ViewAnimationUtils.createCircularReveal(view, mEpicenter.x, mEpicenter.y, mSmallRadius, mBigRadius);
	      return animator;
	  }





But if you run it -- oops, the app will crash with an `UnsupportedOperationException`. Basically the `RevealAnimation` cannot be paused or resumed (possibly because it runs in the render thread) but the window transition code pause/resume the animations at some point. My hack was to use a `WrapperAnimator` that intercepts and ignores calls to `pause()` and `resume()` and delegates other calls to `RevealAnimator`.  Note this is just my quick-and-dirty solution to get the demo going, for a proper implementation, see this Googler halfthought's [Reveal Transition post](https://halfthought.wordpress.com/2014/11/07/reveal-transition/).





Here's what I've got so far (slowed down by 2x):
<div class="fivecol" style="float:none; margin-bottom:20px;">
<iframe width="282" height="500" src="//www.youtube.com/embed/GxhqaGAP3DI?controls=0&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>












Obviously, it isn't quite what I wanted. The reveal effect is hardly noticeable because the yellowish background always fades away. I wanted it to stay to give the reveal animation a clearer cut. I'm not sure if it's possible to turn off this fading, but let's continue with my approach because it reveals an interesting limitation of Lollipop's window transition.





So my approach was to set the yellow background to the `RelativeLayout` in `layout/activity_album_detail` instead. See the video below (and the code on the ["round-1" branch](https://github.com/jimulabs/google-music-mock/tree/round-1-window-content-transitions)):
<div class="fivecol" style="float:none; margin-bottom:20px;">
<iframe width="282" height="500" src="//www.youtube.com/embed/3NtcueSJCJo?controls=0&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>












The reveal animation worked as expected. However, all the other animations are now gone! How come? It took me a few hours to realize this tricky behaviour of the window transition: **Will a window transition run for a particular view? Well, it depends on the background of the view's ancestors.** To put it precisely:







  * If the background of a `ViewGroup` is set (even if it's `android:color/transparent`), the transition system will treat the `ViewGroup` as a single view and ignore its children. Thus, any transitions will only run on the `ViewGroup`, instead of its children individually; if a transition has its target set to one of the children only, the transition will not run at all.


  * Conversely, if a `ViewGroup` does not have a background (or it's `@null`), transitions will run for all its individual children; if a transition has its target set to the `ViewGroup`, the transition will not run at all.


  * This does NOT happen if you run `beginDelayedTransition()` in normal cases such as setting the visibility of views in a `OnClickListener`.





This limitation led me to try round 2, just run the rest of transitions using `beginDelayedTransition()` after the `windowEnterTransition` finishes.





**Update 12/15/2014:** There is some more information about this behaviour in [`ViewGroup#isTransitionGroup()`](https://developer.android.com/reference/android/view/ViewGroup.html#isTransitionGroup()). So this is by design, not a bug. And [`ViewGroup#setTransitionGroup(boolean)`](https://developer.android.com/reference/android/view/ViewGroup.html#setTransitionGroup(boolean)) can be used to customize this behaviour. But still, why are Activity transitions different from normal transitions?





## Conclusion





By now my impression about the window transition stuff in Lollipop is mixed: it does good things, but be warned, there are glitches, bugs and confusions. Handle it with care. (or hopefully Google will fix these issues soon?)





Below is a rundown of the issues I've come across so far:





### Bugs







  * Shared view transition glitches: when the animation is playing, it covers up everything, including the views that are supposed to be above, even the system navigation bar (!)



    * **Update**: As reddit user scep12 [pointed out](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/), you can use `Window#setSharedElementUseOverlay()` to turn off the overlay. The resulting animation is a little different but better than the flickering.


    * **Update Jan 3, 2015**: Alex Lockwood analyzed the pros and cons of using `setSharedElementUseOverlay()` and also mentioned another approach to avoid this glitch, see [this post](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/cn4iak3).




  * Sometimes transitions don't play at all (**Update Jan 3, 2015:** I saw this issue on Android 5.0.0, but it's no longer reproducible as of 5.0.1, see [here](http://www.reddit.com/r/androiddev/comments/2p0x2g/my_journey_to_lollipop_transitions_part_1/cn4iw1n) for details)





### Confusions







  * Whether a window transition will run or not for a particular view depends on the background of the view's ancestors. I'm not sure if this is by design or a bug. **Update 12/15/2014:** In fact [`ViewGroup#setTransitionGroup(boolean)`](https://developer.android.com/reference/android/view/ViewGroup.html#setTransitionGroup(boolean)) can be used to customize this behaviour. But still, why are Activity transitions different from normal transitions?


  * `windowContentTransition` doesn't seem to have any effect. No matter if it's set to `true` or `false`, transition animations work fine as long as the theme is `android:Theme.Material` or its variants.


  * 2x4 types of transitions: [`sharedElement`, `window`] x [`enterTransition`, `exitTransition`, `returnTransition`, `reenterTransition`]. In many cases you'd only need to worry about a few of them, but are there any ways to simplify this conceptually?


  * Transition choreography via Java code or XML is not easy, specially when you are in the design phase of the animations. 





I'll write about my next rounds of using view transitions and animators in the next post.





Thanks for reading! In the meantime, I'd appreciate your feedback and comments.



