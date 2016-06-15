---
author: matt
comments: true
date: 2014-10-07 22:36:36+00:00
layout: post
slug: speeding-gradle-builds
title: Speeding up Gradle builds
id: 705
categories:
- Tutorial
---

Gradle is a nice build system and there are many benefits to using it for Android builds. However, a common complaint about Gradle is that build times are much longer than they were with the old ant-based built system. Specifically, building and installing apps from Android Studio or IntelliJ involves a lot more waiting than developers are used to compared to Eclipse and ADT. Whether you're using Android Studio or Gradle on the command line, there are a few things you can do to speed your builds up.





Note that these suggestions apply to Gradle in general, not just to Android builds. At the time of writing the latest version of Android Studio is 0.8.11 and the latest version of Gradle is 2.1. Both of these tools are evolving and improving rapidly; we'll try to keep this post up to date as things change.





_Update April 2, 2015:_ The content below still applies to Studio 1.1, 1.2 preview 4, and Gradle 2.2.1.





## Use the Gradle daemon





This one is a must if you're building frequently. The Gradle daemon is a process that runs in the background on your machine. When you run a Gradle task using the daemon, the already-running process handles it. This eliminates Gradle startup costs that are otherwise incurred every time you run Gradle. The only downside to using the daemon is that the process takes up some memory: on my machine a couple hundred MB. After 3 hours of idle time the daemon will stop itself; you can stop it earlier by running `gradle --stop` on the command line (this is useful when sometimes your gradle builds give an error `Unable to locate a Java Runtime to invoke`). See the [Gradle daemon](http://www.gradle.org/docs/current/userguide/gradle_daemon.html) chapter in the Gradle user guide for more information.





### In Android Studio





Nothing to do! Android Studio uses a daemon by default, so you don't need to configure it.





### On the command line





You can configure your project to always use a daemon by adding the following line to the `gradle.properties` file in your project directory:





`org.gradle.daemon=true`





If you want to use the daemon only for certain tasks, use the `--daemon` flag when starting the task. This will connect a running daemon, or start a new one if necessary. For example:





`gradle build --daemon`
  






## Compile projects in parallel





If your Gradle build contains multiple decoupled projects, you can take advantage of Gradle's parallel mode. In parallel mode, Gradle will run multiple executor threads, which can execute tasks from different projects in parallel. By default Gradle will create one executor thread for each CPU core on your machine, but this is configurable.





For more information about multi-project builds, decoupled projects, and parallel execution, have a look at the [Multi-project Builds](http://www.gradle.org/docs/current/userguide/multi_project_builds.html) section in the Gradle user guide.





### In Android Studio





You can turn on parallel execution mode in Android Studio's settings. Under the **Compiler (Gradle-based Android Projects)** section in Studio 1.1 (or **Build, Execution, Deployment > Compiler > Compiler** section in Studio 1.2), check the "Compile independent modules in parallel" box. If you want to change the number of threads Gradle uses, add `--parallel-threads=N` to the "Command-line options" field on the same screen, where `N` is the number of threads to use.





### On the command line





Like the daemon, you an configure this per-project and per-task. To always build in parallel, add the following line to your `gradle.properties` file:





`org.gradle.parallel=true`





To use parallel mode for only a particular task, use the `--parallel` flag, optionally with the `--parallel-threads` flag to change the number of threads used:





`gradle build --parallel --parallel-threads=N`
  






## Configure projects on demand





In its default mode, Gradle configures every project before executing tasks, regardless of whether the project is actually needed for the particular build. "Configuration on demand" mode changes this behaviour, only configuring required projects. Like parallel mode, configuration on demand mode will have the greatest effect on multi-project builds with decoupled projects. Note that configuration on demand mode is currently an incubating feature, so isn't fully supported. You can learn more about it in the [Multi-project Builds](http://www.gradle.org/docs/current/userguide/multi_project_builds.html) section of the Gradle user guide.





### In Android Studio





You can turn on configure on demand mode on the same screen that has the parallel build settings. In the **Compiler (Gradle-based Android Projects)** section in Studio 1.1 (or **Build, Execution, Deployment > Compiler > Compiler** section in Studio 1.2) of Android Studio's settings. Toggle the "Configure on demand" checkbox to turn the mode on and off.





### On the command line





This works the same way as parallel mode. To turn on configuration on demand mode for all tasks, add the following line to your `gradle.properties` file:





`org.gradle.configureondemand=true`





And to use configure on demand mode for a single task, use the `--configure-on-demand` flag:





`gradle build --configure-on-demand`
  






## Avoid unnecessary rebuilds





This last point is more about workflow than Gradle specifically. Often frequent rebuilds in Android development happen when we're tweaking the interface and need to see how each change looks. This feedback loop can be sped up immensely by leveraging the Android resource system and tools that avoid costly rebuilds.





The Android Studio layout preview pane is the most obvious example of this sort of tool. It gives you a decent preview of your layout, but it's often incomplete and doesn't show how your different layouts actually fit together. We built [Mirror](/) to stretch this rebuild-free development style _much_ further, letting you view and work on the entire UI of your app without needing to rebuild and reinstall it. Just change your layouts, styles, assets or Java/Kotlin code of your custom views, a preview of your layouts or animations will be ready on the device in seconds.





If it sounds like this would save you time and improve your work, download the [Android Studio plugin](/mirror-downloads). It's free to try! If you want to learn more, check out [our homepage](/) or the [Mirror tutorial](/mirror-tutorial).



