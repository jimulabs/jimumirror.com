---
author: matt
comments: true
date: 2014-08-20 08:36:18+00:00
layout: page
redirect_from: 
- /mirror-js-overview/
- /mirror-js-overview
slug: mirror-js-overview
title: Mirror.js Overview
id: 534
---

## Note: We have stopped the development of Mirror.js and put what we've learned into Mirror Sandbox, a set of new features based on Java code hot-swapping. See [this post]({{site.baseurl}}/2015/01/building-android-animations-mirror-sandbox-piecewise/) for details.





* * *





This document provides an overview of the features in Mirror.js. For detailed examples implementing complex behaviour, check out the [our samples repository](https://github.com/jimulabs/mirror-samples). In particular, check out the MirrorJSExamples, TuneInRedesign, and TimelyMock projects. These can be imported into Android Studio and previewed using Mirror.





## Mirror.js may be hazardous to your health





We're excited about the ideas and tools here, and we're looking forward to hearing your feedback. Keep in mind that this is a preview and we're still experimenting. We plan on changing and improving this as we figure out how people use it. Please be patient with us as behaviour and APIs change (maybe dramatically, but hopefully for the better!), and let us know what works well and what doesn't.





## Using JavaScript with Mirror





Mirror.js extends the capabilities of the screens and sample data that Mirror already supports. Briefly, a screen file lets you "fill in" the content in a layout file to get an accurate preview of how your UI will look at runtime.  Mirror.js lets you associate a JavaScript file with a screen file, to add dynamic behaviour to the screen. Here's a simple screen file using JavaScript from a file `behaviour.js` (this would be a user-created file):





	<screen script="behaviour.js">
  		<_content layout="@layout/profile">
    		<avatar src="images/person.jpg" />
    	<name text="@string/default_name" />
  		</_content>
	</screen>





When previewed using Mirror, this screen file will load the `profile` layout resource. The image at the given path will be loaded into the ImageView with id `avatar`, and the TextView with id `name` will be filled with the given string resource. For a more complete introduction to Mirror, screens, and sample data, see [the Mirror tutorial]({{site.baseurl}}/mirror-tutorial/).





## Animation Basics





Mirror.js has a simple set of primitives for creating, combining, and displaying Android animations. The most simple thing you can do is animate a view using a built-in animation resource:





	// Apply the built in Android animation 'fade_in' to the view with id 'avatar'
	$('avatar').animator('android:fade_in')





The are a couple of important things here. `$` takes the id of a view on the screen and returns that view. The `animator` method takes the identifier of an Android property animation (i.e. an `@animator` resource) and creates an animator that animates the target view using the given animation. It's important to note that `animator` creates the animation but doesn't actually start it. To do that call `start` on the animator:





	$('avatar').animator('android:fade_in').start()
	// or
	var anim = $('avatar'.animator('android:fade_in')
	anim.start()





### Creating animations





Mirror.js supports both property and view animations, although using property animations is encouraged. Property animations are defined by `@animator` and `@android:animator` resources, while view animations are defined by `@anim` and `@android:anim` resources. The `animator` method creates a property animator, and the `anim` method creates a view animator:





	// Creating property animations:
	var v = $('name')
	v.animator('@animator/my_animation')
	v.animator('my_animation') // @animator prefix is optional

	// Using built-in property animations:
	v.animator('@android:animator/fade_in')
	v.animator('android:fade_in') // built-in animations still need the 'android' prefix

	// Creating view animations:
	v.anim('@anim/my_view_animation')
	v.anim('my_view_animation')
	v.anim('@android:anim/view_animation')
	v.anim('android:view_animation')





Mirror.js also lets you define new animations entirely in JavaScript. This can be useful for quickly adjusting animation parameters when creating an animation, or for prototyping complex, dynamic animations. These animations are also property animations, so they are created using the `animator` method:





	$('avatar').animator({
    	properties: {
        	alpha: [0, 1],
        	scale: [0, 1, 0.5, 1]
    	},
    	interpolator: '@android:interpolator/linear',
    	duration: 1000
	})





This animation linearly fades in the `avatar` view, while adjusting its size from 0%, to 100%, back to 50%, and finally back to 100%. The animations are played over 1 second.





The animation object has three fields:







  * `properties`: This is itself an object. Each key is the name of a property to animate, and the value is an array of property values to animate through.



    * Currently only size, position, rotation, and transparency properties can be animated. This limitation will be fixed in an upcoming release.




  * `interpolator`: A resource id for an interpolator to use when animating the properties. This determines _how_ we move through the property values


  * `duration`: How long the animation shoud take, in milliseconds





### Choreographing animations





It's often necessary to show several animations on multiple objects in a specific order, especially when animating screen transitions. Mirror.js provides three simple functions to help you choreograph animations. These can be combined to create complex animation sequences. All of the discussion in this section applies to **property animations only**.







  * `together`: Play a set of animations at the same time.


  * `sequence`: Play a set of animations one after another, each starting when the previous one finishes


  * `delay`: Wait for a given amount of time, then play an animation





	// Some animations we want to play
	var avatarAnim = $('avatar').animator('fade_in')
	var nameAnim = $('name').animator('pulse')

	// Play the animations at the same time
	together([avatarAnim, nameAnim]).start()

	// Play avatarAnim, then nameAnim
	sequence([avatarAnim, nameAnim]).start()

	// Wait 500ms, then play avatarAnim
	delay(avatarAnim, 500).start()





Each of the basic choreography functions actually returns a new animator, so these functions can be composed to create complex animations. Suppose we want to play `anim1` and `anim2` together, then wait one second before playing `anim3` and `anim4` together:





	var firstPair = together([anim1, anim2])
	var secondPair = together([anim3, anim4])

	sequence([firstPair, delay(secondPair, 1000)]).start()





`together`, `sequence`, and `delay` can all be composed like this, so you can use them to create a hierarchy of animations that makes your choreography easy to create and understand.





### When are animations shown?





The JavaScript file is run when a screen is launched. If you start an animation at the top-level in the script, it will be played immediately when the screen is opened. So if your script only consists of `$('avatar').animator('android:fade_in').start()`, then when the screen is opened `avatar` will fade into view.





You can also trigger animations in response to events or interactions. For example, suppose we want to play a pulsing effect when the user taps on an avatar image:





	var avatar = $('avatar')
	avatar.on('click', function() {
    	avatar.animator('pulse').start()
	})





This assumes there's a view on screen with id `avatar`, and a project resource `@animator/pulse`.





## Linking screens to create an interactive prototype





In addition to animations and interactions, Mirror.js also lets you link together screens to create an interactive prototype. Suppose we have the following in our project:







  * two layouts, `activity_chat` and `activity_profile`


  * a screen file corresponding to each layout


  * a JavaScript file, `chat.js`, that's used by the `activity_chat` screen file





When the user clicks on the button with id `avatar` in activity one, we want to open the `activity_profile` screen.





### Basic linking





Basic screen linking is easy with Mirror.js. In `chat.js`, we can get the desired behaviour with:





	$('avatar').on('click', function() {
  	openScreen('activity_profile.xml')
	})





The `openScreen` function takes a relative path to the screen file that should be previewed.





### Transition animations





Usually we want to smoothly transition between screens rather than just cutting from one to another. The `openScreen` function takes some additional arguments to help prototype this.





#### Shared elements





Similar to the [Activity Transitions API](https://developer.android.com/preview/material/animations.html#transitions) in the Android L preview, with Mirror you can specify elements that appear in both the current and new screens. When the new screen is opened, shared elements will automatically animate from their old location to the new one.





Continuing the previous example, suppose the `activity_chat` and `activity_profile` layouts both have an views with ids `avatar` and `name`. When we open a profile from a chat screen, we want the avatar and name to smoothly animate to their new locations. This is easy with `openScreen`:





	$('avatar').on('click', function() {
  	openScreen('activity_profile.xml', ['avatar', 'name'])
	})





The second argument to `openScreen` is an array of strings that are the ids of views shared between the screens.





#### Opening and closing animations





In addition to shared elements, `openScreen` also takes as arguments animations for bringing the overall screens into and out of focus. Some examples:





	// Transition between screens using fade. Pass an empty array if there are no shared elements
	openScreen('activity_profile.xml', [], '@android:animator/fade_in', '@android:animator/fade_out')

	// You can also use view animations
	openScreen('activity_profile.xml', [], '@anim/slide_in', '@anim/slide_out')





Once you've opened a new screen, pressing the back button will return to the screen that was previously being shown. By default, when moving back no animation will be played. You can customize this behaviour with the final two arguments to `openScreen`:





	// Full example of openScreen
	$('avatar').on('click', function() {
  	openScreen('activity_profile.xml', ['avatar', 'name'],
    	'@anim/slide_in', '@anim/slide_out', '@anim/slide_in', '@anim/slide_out')
	})





With the above call, there will be a sliding animation to `activity_profile` when `avatar` is clicked. When you press back on the device, the same sliding animation will bring `activity_chat` back. In addition, the `avatar` and `name` views will automatically animate between their positions in `activity_chat` and `activity_profile`.





To recap, here's the complete signature of `openScreen`:





	openScreen(screenPathToOpen, sharedElementIds,
  	launchEnterAnim, launchExitAnim, backEnterAnim, backExitAnim)





#### Customizing opening and closing animations





If you look at the `openScreen` function in the previous section, you can see a fundamental limitation. `openScreen` is called in the context of the _calling_ screen, and does not have access to the context of the _called_ screen (the one being opened). Let's look again at a call to `openScreen`:





	// In the JavaScript file for activity_chat
	$('avatar').on('click', function() {
  	openScreen('activity_profile.xml', ['avatar', 'name'])
	})





Suppose when we open `activity_profile` that we also want to reveal a `bio` field after the shared `avatar` and `name` fields have moved into place. Because `bio` is the id of a view in `activity_profile`, but is not shared with `activity_chat`, we can't do this using `openScreen`. We actually can't access the `bio` view from the `activity_chat` JavaScript file at all.





To get around this, you need to add some code in the JavaScript file for `activity_profile`:





	// In the JavaScript file for activity_profile
	var bioView = $('bio') // we can access bio in this context
	var revealBio = bioView.animator('@animator/reveal')
	customizeScreenOpeningAnimation(function(sharedElementsAnim) {
  	return sequence([sharedElementsAnim, revealBio])
	})





`customizeScreenOpeningAnimation` takes a callback function that we can use to control the transition animation _from the context of the opening screen_. The callback is passed the animator for the shared views, and it must return a new animator that will be played instead. In this case we want to play the `revealBio` animation after the shared elements are animated, so we use the `sequence` function as described in the **Choreographing animations** section.





Along with customizing how the screen is opened, we might also want to customize how it is _closed_. There's an additional function to control this, `customizeScreenClosingAnimation`. Suppose when we close `activity_profile` we want to "unreveal" the `bio` view before animating back to `activity_chat` using shared elements:





	// In the JavaScript file for activity_profile
	var unrevealBio = $('bio').animator('@animator/unreveal')
	customizeScreenClosingAnimation(function(sharedElementsAnim) {
  	return sequence([unrevealBio, sharedElementsAnim])
	})





### Transitioning prototypes into production





One of our long-term goals with Mirror is to ease the transition between the design and implementation stages of Android development. Mirror provides some tools to quickly create prototypes using _actual Android resources_, and we think this is important. Prototyping an application using Android resources means those files can be immediately used in development.





Mirror.js extends Mirror's prototyping to support dynamic, interactive behaviour. With a bit of care, much of the work that goes into prototyping with Mirror can still be reused in production. Keep in mind when you're using Mirror that, currently, everything written in the JavaScript file will likely need to be re-written in Java. Anything in an Android resource file will be able to be used directly in development. Define as many of your animations as possible in `@animator` resource files, and use JavaScript to link them together. This will ensure that your animations are discrete assets that can easily be used in production without translation.



