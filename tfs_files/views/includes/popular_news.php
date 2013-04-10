<div class="popular-news">                    
                    <div class="news-head-right"> &nbsp;</div>
                    <div class="news-head"> <h1>
                        اخبار                                
                       </h1> </div>
                    <div class="news-head-line"> &nbsp;</div>
                    
                    <? foreach($home_naws as $row3) {?>
                    
                    <div class="news-last">
               <a href="<?=base_url()?>news/view/<?=$row3->id?>">             <img src="<?php print base_url()?>/images/news/thumb_<?=$row3->image?>" width="221" height="125"/></a>
                           
                                <h3><a href="<?=base_url()?>news/view/<?=$row3->id?>"> <?=substr($row3->title,0,70)?> </a>   </h3>
                                <div style="width:221px"><strong>
                                     <?=strip_tags(substr($row3->content,0,280))?>
                                </strong><a href="<?=base_url()?>news/view/<?=$row3->id?>"><img src="images/d-arrow.jpg" ></a></div>
                        </div>
                        
                        <? } ?>
                        
                        <span class ="source-span" style="text-align:right !important;"><a href ="<?=base_url()?>news" style="color: #0d7dac; text-decoration: none; float:right;" >
                              عرض الكل
                            </a></span> 
                <br class="clear" />
                 
</div>