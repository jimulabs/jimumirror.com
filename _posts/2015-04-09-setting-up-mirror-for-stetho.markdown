---
author: linton
comments: true
date: 2015-04-09 22:24:05+00:00
layout: post
slug: setting-up-mirror-for-stetho
title: Setting up Mirror for Stetho
id: 766
categories:
- Features
- Tutorial
---

Facebook's [Stetho](http://facebook.github.io/stetho/) makes it possible to inspect native Android apps in Chrome Developer Tools. Its latest release added view inspection support, which is really handy when combined with Mirror. You can quickly preview layout changes on the device, and at the same time browse view hierarchy using Stetho -- without rebuilding or re-deploying the app.





To enable Stetho in Mirror previews, you'll need to use the [mirror-sandbox](https://github.com/jimulabs/mirror-sandbox) library, and add a static method into your sandbox class:




    
    
    public class MySandbox extends MirrorSandboxBase {
        @SuppressWarnings("unused")
        // This method doesn't have to public
        public static void $init(Context context) {
            Stetho.initialize(
                    Stetho.newInitializerBuilder(context)
                            .enableDumpapp(Stetho.defaultDumperPluginsProvider(context))
                            .enableWebKitInspector(Stetho.defaultInspectorModulesProvider(context))
                            .build());
        }
        ...
    }





Watch it in action below:







What do you think? Let me know in the comment box!



