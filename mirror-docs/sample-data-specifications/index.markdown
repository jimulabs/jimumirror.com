---
author: alex
comments: true
date: 2013-08-23 01:12:44+00:00
layout: page
slug: sample-data-specifications
redirect_from: 
 - /sample-data-specifications
 - /sample-data-specifications/
title: Sample data specification
id: 250
---

[[ Tutorial ]]({{site.baseurl}}/mirror-tutorial)  | [[ Project Setup ]]({{site.baseurl}}/project-configuration-in-mirror-server) |  [ Sample Data Specification ]





#### Overview



| Elements | Attributes | Parents   | Children |
|:--------|:----------|:---------|:--------|
|screen    | theme, overlay, inEditMode, sandbox | none | _content |
|_content  | layout, include | screen, populator| populator
|actionbar | title, subtitle, icon, customView, menu, showHome, showTabsFor |  screen|  none |
|items | layout, include, count | populator | _item |
|_item | layout, include, count | populator, items | populator |
|_page | title, layout, icon | ViewPager populator | populator |
|populator<sup>1</sup> |  src, visibility, textColor, layoutManager, _*Android namespace attributes, custom attributes*_ | _content, _item | items, _item, _content<sup>2</sup> |




_1. Populator tags are variably named elements. Any element other than the ones listed above are assumed to be populator tags._


_2. Content can be the only child of a populator if it matches a `<fragment>`, FrameLayout or any other ViewGroups that are not AdapterViews._





#### \<screen\> element





The screen element is a root declaration that defines the document as renderable on the client app.





Attributes:



| Name     | Description|
|:---------|:-----------|
| theme | Specifies a theme to be applied to the contents of the screen: <br> `<screen theme="@android:style/Theme.Holo" />` <br> `<screen theme="@style/MyTheme" />` <br> If this attribute is not specified, Mirror will use the theme specified in the “application” tag in the manifest. |
| overlay | Specifies an image to be displayed as a translucent overlay on top of the screen (including the action bar). The transparency of the overlay can be adjusted via a slider. This attribute is useful for creating layouts that match a designer’s hi-fidelity mockups pixel by pixel. The mockups can be placed in resource directories inside the “mirror” directory, such as “mirror/res/drawable-hdpi”. <br>`<screen overlay="@drawable/mockup" />` |
| inEditMode | Specifies whether the views in the layout are currently in edit mode. The value of this attribute can be true or false (default to true). The [View.isInEditMode()](https://developer.android.com/reference/android/view/View.html#isInEditMode()) method will return the same value as this attribute. |
| sandbox | Specifies the fully qualified name of the “sandbox” class to be used for this screen. See [this post](2015/01/building-android-animations-mirror-sandbox-piecewise/) for more details. |



Parents: _none_

Children: _content





#### \<actionbar\> element





This is an optional element that appears as a child of the screen tag and can be used to describe the appearance of an action bar for the previewed layout.





Attributes:




| Name | Description |
|:---------|:-----------|
| title | The title attribute specifies the action bar’s title. |
| subtitle | The subtitle attribute specifies the action bar’s subtitle.|
| icon | The icon attribute can be used to supply a drawable or image file to be displayed in the action bar’s home section. |
| customView | Specify a layout file to be used as a custom navigation view. |
| menu | The menu attribute is used to specify a menu resource file that will be used to inflate the options menu for the action bar.|
| showHome | Boolean flag to display the homeAsUpIndicator drawable next to the action bar’s home icon.|
| showTabsFor | The id of a ViewPager you’d like to display tabs for. The id must correspond to a ViewPager in the previewed layout, and the tabs will be populated according to the <_page> elements given for the ViewPager (see <_page> section below). |



Parents: screen

Children: _none_





#### \<_content\> element





The _content element appears in conjunction with a screen element and defines the corresponding Android layout in the resource folder that the document defines data for.





Attributes:




| Name | Description |
|:---------|:-----------|
| layout | The layout attribute references an android layout xml file in the resources folder that provides context for mock data to be displayed on the client app: <br> `<_content layout="@layout/some_activity"/>` |
| include | The include attribute references an external data xml file in the mirror directory. If the external file has a compatible root element it’s content will replace the content for the associated screen file. Valid root tags for external file are _content. <br> `<_content include="data_file.xml"/>` | 



Parents: screen, populator

Children: populator





##### Fragment support





Starting from Mirror 1.2, the \<_content\> tag can be used inside a populator which corresponds to a \<fragment\> tag, FrameLayout or any other ViewGroup that are not AdapterViews. Mirror creates fragments using the "layout" attribute and adds them onto the ViewGroup. \<_content\> tags can only be nested two deep (including the root \<_content\> tag), or an error will be reported. This means nested fragments aren't supported yet.




    
    <screen>
      <_content layout="@layout/activity_main">
        <master>
          <_content layout="@android:layout/list_content">
            <list>
              <items include="mails.xml" />
            </list>
          </_content>
        </master>
        <detail>
          <_content layout="@layout/detail_pane">
            <from>Paul McCartney</from>
            <subject>Have you seen the new version of Mirror?</subject>
          </_content>
        </detail>
      </_content>
    </screen>





#### \<items\> element





The items tag is a container for sample data items for views that extend the AdapterView class.





Attributes:


| Name | Description |
|:---------|:-----------|
| layout |  The layout attribute references an android layout xml file in the resources directory and specifies the default layout for each of the children: <br> `<items layout="@layout/list_item" />` <br> Children can override this default layout by specifying their own layout attribute. |
| include | The include attribute references an external data xml file in the mirror directory. If the external file has a compatible root element it’s content will be inserted before any existing children of the items tag. Valid root tags for external file are items. |
| count | The count attribute repeats the data wrapped by the items tag a specified number of time. It is applied after includes. The following results in 6 items: <br> `<items count=”3”>`<br>  `<_item ... />` <br> `<_item ... />` <br> `</items>` |



Parents: populator

Children: _item





#### \<_item\> element





The _item tag contains populator tags for a specific layout, either inherited from a parent or specified in the _item tag declaration with the layout attribute. It represents a single data item that can be used to populate a view that extends the AdapterView class.





Attributes:

| Name | Description |
|:---------|:-----------|
| include | The include attribute references an external data xml file in the mirror directory. If the external file has a compatible root element it’s content will be used in in place of the _item tag. Valid root tags for external file are _item. |
| count | The count attribute inserts a specified number of duplicates of the _item tag. The duplicates are inserted in the parent items tag at the position of the existing _item. The following results in 4 items: <br> `<items>` <br> `<_item count=”3” ... />` <br> `<_item ... />` <br> `</items>` |




Parents: populator, items

Children: populator





#### \<_page\> element





Populates one page of a ViewPager. Must be the child of a populator corresponding to a ViewPager element in the mirrored layout. A \<_page\> element must have a layout attribute. Inside the \<_page\> element you can use populators for views in the page's layout, just like inside a \<_content\> element.





Usage:




    
    <viewPagerId>
      <_page layout="page1_layout" title="Page 1" icon="@drawable/icon1">
        <textViewId text="Some text" />
      </_page>
      <_page layout="page2_layout" title="Page 2" icon="@drawable/icon2">
        <imageViewId src="@drawable/image" />
      </_page>
    </viewPagerId>





Attributes:


| Name | Description |
|:---------|:-----------|
| layout | Reference to the layout that should be displayed for this page. |
| title | The title to use for this page if using action bar tabs. Can be raw text or a reference to a string resource. |
| icon | The icon to use for this page if using action bar tabs. Must be a reference to a drawable or file system image. |



Parent: populator for a ViewPager element

Children: populators for views inside the page layout





#### \<populator\> element





Populator tags are variably named elements. The name of the element is a reference to a specific view id in an Android layout file. The Android layout file containing this view id is determined by the layout attribute of the populator’s parent element. Populator tags can refer to both view containers, like GridViews and ListViews, or Views without children, like TextViews, or custom-defined view classes (premium only feature). The inner text of the populator elements sets the text for the referenced view. It’s also possible specify an internal android id by prefixing the populator tag with “android-” (without quotes). If the layout is already referencing an internal Android layout, then this prefix can be omitted.





Usage:




    
    <viewContainerId>
     <items ... >
     <_item ... />
     <_item ... />
     </items>
    </viewContainerId>





`<textViewId>Some text</textViewId>` Text content for views referenced by populator tags is set to the inner text of the populator element.


`<imageViewId src="some_image" />`





Attributes:


|Name | Description |
|:---------|:-----------|
| src | The src attribute defines an image source for a view. The src attribute can either reference an Android drawable or an external image file in the mirror directory. If no file extension is given Mirror will assume the value refers to a drawable. Examples: <br> `<imageViewId src="ic_launcher"/>` <br> (also equivalent to `<imageViewId src="@drawable/ic_launcher" />`) <br> `<imageViewId src=”@drawable/ic_launcher” />` <br> `<imageViewId src=”@android/drawable/ic_delete” />` <br> `<imageViewId src="external_image.jpg" />` |
| url | The url attribute defines a URL to be displayed inside a WebView. The url attribute can be either a reference to an HTML file in the mirror directory, or a website on the internet. It will look first in the mirror directory, and if a file with the specified name does not exist it will try the internet. Although WebView requires all addresses to begin with http:// or file://, these can be omitted when using the url attribute. <br>Examples: <br> `<webViewId url="google.com"/>` <br> `<webViewId url="http://www.google.com"/>` <br> `<webViewId url="folder_in_mirror/local_file_to_display.html"/>` |
| visibility | Can be one of “gone”, “visible” or “invisible” and controls the visibility of the referenced view. The view will not be visible but still take up space if set to “invisible”, but will not take up any space if set to “gone” |
| textColor | If the referenced view is an instance of TextView then this attribute can be used to specify its text color. May be a color resource reference or a string of the form #RRGGBB #AARRGGBB ‘red’, ‘blue’, ‘green’, ‘black’, ‘white’, ‘gray’, ‘cyan’, ‘magenta’, ‘yellow’, ‘lightgray’, ‘darkgray’, ‘grey’, ‘lightgrey’, ‘darkgrey’, ‘aqua’, ‘fuschia’, ‘lime’, ‘maroon’, ‘navy’, ‘olive’, ‘purple’, ‘silver’, ‘teal’. |
| layoutManager | If the referenced view is a RecyclerView then this attribute specifies the LayoutManager to use with that RecyclerView. Currently LinearLayoutManager and StaggeredGridLayoutManager are supported. For both managers the orientation can be specified. For the staggered grid manager you can also give the span count. <br>Examples: <br> `<recyclerViewId layoutManager="linear:horizontal"/>` <br> `<recyclerViewId layoutManager="linear:vertical"/>` <br> `<recyclerViewId layoutManager="staggeredGrid:vertical"/>` <br> `<recyclerViewId layoutManager="staggeredGrid:4:horizontal"/>` (4 is the span count) |
| _*Android namespace attributes*_ | Most other android attributes for a view can be overridden in sample data, with some limitations. For a more complete description of how other attributes are supported in sample data see the [sample data attributes]({{site.baseurl}}/mirror-docs/sample-data-attributes/) document. <br> `<imageViewId adjustViewBounds="true"/>` <br> `<textViewId highlightColor="0xFF0000" allCaps="true" />` |
| _*Custom attributes*_ | Mirror also supports setting custom attributes for custom views if a public setter exists for the attribute. For a more complete description of how other attributes are supported in sample data see the [sample data attributes]({{site.baseurl}}/mirror-docs/sample-data-attributes/) document. <br> `<myCustomViewId customColor="0x0F0F0F"/>` |



Parents: _content, _item

Children: items, _item, _content





#### External data files





Valid root tags for external data files are:






    
  * _content

    
  * _item

    
  * items





The root tag of an externally referenced file must be in agreement with the element containing the include attribute. Refer to the attribute descriptions in this document to see what types of external data can be included for each element that supports the include attribute.



