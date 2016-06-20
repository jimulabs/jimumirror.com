---
author: alex
comments: true
date: 2013-12-10 08:50:53+00:00
layout: page
redirect_from: 
  - /project-configuration-in-mirror-server
  - /project-configuration-in-mirror-server/
slug: project-configuration-in-mirror-server
title: Project Setup for Mirror Standalone
id: 392
---

[[ Tutorials ]]({{site.baseurl}}/mirror-tutorial)  | [ Project Setup ] |  [[ Sample Data Specification ]]({{site.baseurl}}/sample-data-specifications)





#### Note: If you're using Android Studio, you don't need to read this page. The Mirror plugin for Android Studio automatically configures your project. [Download it here]({{site.baseurl}}/mirror-downloads/).





Setting up a new project with Mirror is easy. Enter a project path and Mirror will automatically detect project and library resources for most conventional Eclipse, IntelliJ and Android Studio project structures. Occasionally Mirror may not pick up all the necessary files in order to preview your project, especially if your project structure is highly customized, in which case the resource paths must be specified manually.





#### Gradle Project Setup





For most single application Gradle projects you will want to specify the directory containing the settings.gradle file as the project path. Mirror will attempt to pick up any library project dependencies and scan for resources. If you specify a Gradle subproject as your project path your library projects may not be automatically detected. In this case it may be necessary to manually add your library resource directories in the edit project configuration window.





#### IntelliJ and Eclipse Project Setup





For IntelliJ and Eclipse projects you will generally want to use the project path containing the src, res, Android manifest file for your project. If the project path contains a project.properties file resources for any library references should be added to the project configuration automatically.





#### Dex / Apk file path





For custom view support Mirror requires a path to a dex file created by your project's build process. Normally Mirror will automatically scan for such files, but if you have recently cleaned your build directory Mirror may not detect this path. To ensure the most up to date dex file is used when rendering custom views on your device ensure that you update the dex / apk path for your project configuration after your project has been built normally at least once.





#### Resource not found error in Mirror console





Resource not found errors in the Mirror console often indicate a missing library project path. If your project has any dependencies on the resources of a library project and you encounter such an error, ensure that the library project appears in the list of Library Resource Paths in the edit project configuration window.



