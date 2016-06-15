---
author: linton
comments: true
date: 2015-02-06 00:53:47+00:00
layout: page
slug: time-saved-using-mirror
title: How much time have you saved using Mirror?
id: 740
---





<table class="table" >
<tbody >
<tr>
            
<td> Time saved
</td>
            
<td> When
</td>
            
<td> Number of updates
</td>
</tr>
<tr >
            
<td id="saved0" >Unknown
</td>
            
<td id="period0" >Today
</td>
            
<td id="updates0" >Unknown
</td>
</tr>
<tr >
            
<td id="saved1" >Unknown
</td>
            
<td id="period1" >Past week
</td>
            
<td id="updates1" >Unknown
</td>
</tr>
<tr >
            
<td id="saved2" >Unknown
</td>
            
<td id="period2"> Past month
</td>
            
<td id="updates2" >Unknown
</td>
</tr>
<tr >
            
<td id="saved3" >Unknown
</td>
            
<td id="period3" >Since you started using Mirror
</td>
            
<td id="updates3" >Unknown
</td>
</tr>
</tbody>
</table>
Average APK build and deploy time of all your projects: Unknown. The actual timing are calculated per project based on its average build time.
    

#### How are these numbers calculated? Simple:



    


        

### Time saved = N x T - MT


 Where:
        


            
  * **N** = _number of updates sent to devices by Mirror_

            
  * **T** = _average time to build and deploy (install) a full APK onto a device_

            
  * **MT** = _total time Mirror has spent on preparing and sending these updates to
                devices._

        
    


    


   For each of your projects, Mirror records these numbers in a local database. Full APK build time is retrieved using Android Studio's API, while the deploy time is estimated based on our experiments using APKs of various sizes      (roughly at 0.5 seconds per MB). We use "N x T" as the baseline because without Mirror, you'd have to build and deploy the full APK every time to see the changes on the device. The rest is elementary math.
    



