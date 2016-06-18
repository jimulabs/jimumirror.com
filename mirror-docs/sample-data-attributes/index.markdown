---
author: alex
comments: true
date: 2013-12-05 08:29:08+00:00
layout: page
slug: sample-data-attributes
redirect_from:
 - /sample-data-attributes
title: Supporting custom attributes in sample data
id: 389
---

Mirror 1.1 has improved support for setting or overriding layout attributes in sample data files. It's now possible to mock up layout attribute values that might normally be set dynamically at run time, such as highlight colors or the visibility of individual elements in a list item. Many of the attributes defined normally for standard Android views and even custom attributes for custom views are supported in Mirror sample data. Attributes are set in sample data using populator tags, which are references to views in an associated Android layout file. If unfamiliar with populator tags, check out the [tutorial]({{site.baseurl}}/mirror-tutorial/) and [sample data specification]({{site.baseurl}}/sample-data-specifications/) documents before continuing.





### Supported Attributes





Mirror supports setting attributes that have a corresponding public setter in the referenced view class. For instance TextView has methods public void setAllCaps(boolean allCaps)  and public void setTextColor(int color) so the following is possible in a sample data file:





`<textViewId allCaps="true" textColor="0xFF0000">
`




Starting from Mirror 1.2, support for snake case convention has been added in addition to camel case. Continuing with the above example, the following will also work in a sample data file:





`<textViewId all_caps="true" text_color="0xFF0000">
`




Feel free to use the convention that you prefer.





Note the difference in the name for the allCaps attribute in sample data, normally when setting the allCaps attribute in a layout file you would use the attribute android:textAllCaps. Sample data attributes are not namespace aware and reflect the name of the method used to set the attribute.





Similarly, if we are specifying data for an instance of a custom view class, say with id "@+id/customViewId", then the custom view class should have a public method setCustomColor(int color)  in order for the following to work:





`<customViewId customColor="0x111111">
`




Setting attributes that takes a dimension (i.e. 120dp, 15sp) in sample data is now supported. Supported dimension units include dip, dp, px, in, mm, sp, and pt. However, for dimension attributes to fully function, the setter for these attributes must take in a float argument representing pixels. Support for setter which takes in an int argument are likely to be supported in future releases.





As an example, if we want to specify the border width for an instance of a custom view class, say with id "@+id/customViewId", then the custom view class should have a public method setBorderWidth(float width)  in order for the following to work:





`<customViewId border_width="2.5dp">
`




Having a public method setBorderWidth(int width) will not work at the moment.



