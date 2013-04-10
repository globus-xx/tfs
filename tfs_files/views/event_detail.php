<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? include "includes/head.php";?>
    <body dir="rtl">
	<!-- header -->
	
        
   <style type='text/css'>

		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 600px;
		margin: 0 auto;
		}

</style> 
    <div id="main">
        <div class="container">
        	
            <!-- main slider -->
           
                
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  
	<script type="text/javascript">
     /* var map;
      function initialize() {
        var myOptions = {
          zoom: 10,
          center: new google.maps.LatLng<? foreach($event as $row2)
		  echo $row2->location;
		  ?>,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
		  
        };
		

        map = new google.maps.Map(document.getElementById('map_canvas'),
            myOptions);
			
 
      }*/
	  
	   var parliament = new google.maps.LatLng<? foreach($event as $row2)
		  echo $row2->location;
		  ?>;
		  var stockholm = new google.maps.LatLng<? echo $row2->location;?>;
		  
	   var marker;
      var map;
      
	  function initialize() {
	   var mapOptions = {
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: stockholm
        };

        map = new google.maps.Map(document.getElementById('map_canvas'),
                mapOptions);

        marker = new google.maps.Marker({
          map:map,
          draggable:false,
          animation: google.maps.Animation.DROP,
          position: parliament
        });

	  }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
            
                    <? //include "includes/left-panel.php";?>
              <div style=" clear: both;">&nbsp;</div>
                
            <div class="content">
            	
                <div class="right-panel">
                  <!--                popular news -->
 
<!--              end  popular news -->
                
<!--                 news -->

<div class="general-news">
<div class="news-head-right"> &nbsp;</div>
<div class="news-head"> <h1 style="margin-bottom: 2px;">
                        اخبار                                
                       </h1> </div>
                       
                        <div class="news-head-line"> &nbsp;</div>
                       
                        <div class="news-first" style="width: 538px">
                        <div id="map_canvas" style="width: 500px; height: 300px"></div>
                       
                        <span></span>
                                <h3><?   echo $row2->title;?> </h3>
                                <strong >
                                  <?   echo $row2->content;?> 
                                  
                                  
                              
                                     </strong> 
                        </div>
                        
                    
                       
                   
                   
                        
</div>   <!--                end news-->

<div style="float: right; width: 2%">&nbsp;</div>

<!--               videos-->


<!--                end videos-->
<!--            general_news.php     news-list -->

  
<!--                end list-news-->


<!--                 event-calendar -->

  
<!--                end event-calendar-->
            
                
     
        </div>
        <div style="float: none">&nbsp;</div>
        
    </div>
 </div>
    <!-- footer -->
    

</body>
</html>

