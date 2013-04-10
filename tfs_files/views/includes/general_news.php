<div class="general-news">
<div class="news-head-right"> &nbsp;</div>
<div class="news-head"> <h1 style="margin-bottom: 2px;">
                        اخبار                                
                       </h1> </div>
                    <div class="news-head-line"> &nbsp;</div>
                    
                    <? foreach($sec_recent_news as $rr) {?>
                    <div>
                        <span class ="date-span"><? echo date("F jS, Y", strtotime($rr->date_added))?>| <? echo date("H:i", strtotime($rr->date_added))?>  </span>
                        <span class="desc-span" >
                           <a href ="<?=base_url()?>news/view/<?=$rr->id?>"> <?=substr($rr->title,0,140)?></a>
                         </span>  
                      
                        <span class ="source-span"><a href ="<?=$rr->source_link?>" style="color: #0d7dac; text-decoration: none" >
                                <?=substr($rr->source_name,0,15)?>
                            </a></span>
                        <hr style="color: #eeeeee; height: 2px;margin-top: 10px "></hr>
                    </div>
                    <? }?>
</div>
<div class="general-news">
<div class="news-head-right"> &nbsp;</div>
<div class="news-head"> <h1 style="margin-bottom: 2px;">
                        اخبار                                
                       </h1> </div>
                    <div class="news-head-line"> &nbsp;</div>
<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>
                    
</div>