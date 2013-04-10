<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? include "includes/head.php";?>
    <body dir="rtl">
	<!-- header -->
	<? include "includes/header.php";?>
        
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
                        <? foreach($home_recent_news as $row4){?>
                        <div class="news-first" style="width: 538px">
                         <h3><a href="<?=base_url()?>news/view/<?=$row4->id?>"> <?=$row4->title?> </a>   </h3>
                         <span><? echo date("d-M-Y", strtotime($row4->date_added))?></span>
                        <img src="<?php print base_url()?>/images/news/detail/<?=$row4->image;?>" align="right" style="padding: 0 0 0 5px"/>
                        
                               
                                <strong >
                                     <?=$row4->content?>
                                     </strong> 
                        </div>
                        
                        <? } ?>
                       
                   
                   
                        
</div>   <!--                end news-->

<div style="float: right; width: 2%">&nbsp;</div>

<!--               videos-->

<div class="videos">
    
    <div class="news-head-right"> &nbsp;</div>
<div class="news-head"> <h1 style="margin-bottom: 2px;">
                        الفيديو                                
                       </h1> </div>
                    <div class="news-head-line"> &nbsp;</div>
                    
                    <? foreach($home_videos as $row5) {?>
                    <div class="news-first" style="width: 350px; padding-bottom:7px;">
                        <iframe width="160" height="115" src="http://www.youtube.com/embed/<?=$row5->code?>" align="right" frameborder="0" allowfullscreen ></iframe>
                  
                        
                                <h3><a href="#"><?=$row5->title?> </a>   </h3>
                             
                        </div>
                        <? }?>
    
</div>
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
    <? include "includes/footer.php";?>

</body>
</html>

