 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
 <?php if(isset($eventsData)){ ?>
    <script> var stockholm = new google.maps.LatLng<?=$eventsData->location?>;
      var parliament = new google.maps.LatLng<?=$eventsData->location?>;
    
	<? }
	else
	{ ?>
	
	<script>
      var stockholm = new google.maps.LatLng(25.227305, 55.307922);
      var parliament = new google.maps.LatLng(25.227305, 55.307922);
	
	<? } ?>
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
          draggable:true,
          animation: google.maps.Animation.DROP,
          position: parliament
        });
        google.maps.event.addListener(marker, 'click', toggleBounce);
        
        
        google.maps.event.addListener(marker, 'mouseup', function() {
    // 3 seconds after the center of the map has changed, pan back to the
    // marker.
//                    window.setTimeout(function() {
//                      map.panTo(marker.getPosition());
//                    }, 3000);

               
$("#txt_location").val(marker.getPosition());
//alert(marker.getPosition());  
                  });
  
  
      }

      function toggleBounce() {

        if (marker.getAnimation() != null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
	
    </script>


<script type="text/javascript" src="<?=base_url();?>ckeditor/ckeditor.js"></script>             
<form action="" method="post" enctype="multipart/form-data">
<section id="content">
	
<div style="color:#900">
<?php if(validation_errors() !=	''){
	   echo validation_errors();
	   }
		
		 if($this->session->userdata('msg')!=''){
       
       ?>
       
     <div class="alert i_access_denied green"><? echo $this->session->userdata('msg');?></div>
   
        <?
			$this->session->unset_userdata('msg');
			
          
			 } ?>	</div>
               <? 
		if(isset($eventsData)){
			?>
    


            
            <?
			
			$title  	 = $eventsData->title;
                        $location  	 = $eventsData->location;
                        
                        //$duration  	 = $eventsData->duration;
			$content         = $eventsData->content;
                        $startdate       = date('d-m-Y', strtotime($eventsData->start_date));                                               
                        $enddate         = date('d-m-Y', strtotime($eventsData->end_date));
                        $regdate         = date('d-m-Y', strtotime($eventsData->reg_end_date));
						
						
						$startdate_hidden=$eventsData->start_date;
						$enddate_hidden=$eventsData->end_date;
						$regdate_hidden=$eventsData->reg_end_date;
						
						
			$sortOrder	 = $eventsData->sort_order;
			$image 		 = $eventsData->image;
			$is_active	 = $eventsData->is_active?"checked='checked'":"";
			$is_main	 = $eventsData->is_main?"checked='checked'":"";
			//$country_id      = $eventsData->member_country_id;
			$val             = $eventsData->category;
                       
                            
//			$dd=$this->admin_model-> check_callback("acf_news_categories",$category_id,"id");
//			foreach($dd->result_array() as $mm)
//			{
//				$val=$mm['title'];
//			}
//			$tag_ids 	 = $this->general->getAllRecordsWhere(TAGSRELATIONS, array("item_id"=>$eventsData->id, "item_type"=>"news"));
//			foreach($tag_ids as $t){
//				$tags[]=$t->tag_id;
//			}
			
		}else{
			
			$title 		 = set_value('txt_title');
                       // $location 	 = set_value('txt_location');
                        $location 	 = "";
                        $startdate       = set_value('txt_from');
                        $enddate         = set_value('txt_to');
                        $regdate         = set_value('txt_reg_date');
						$startdate_hidden="";
						$enddate_hidden="";
						$regdate_hidden="";
			$content  	 = set_value('txt_content');
			$sortOrder 	 = set_value('txt_sort_order');
			
			$val=0;
			$image 		 = "";
			$is_active	 = isset($_POST['chk_active'])?"checked='checked'":"";
			$is_main	 = isset($_POST['chk_main'])?"checked='checked'":"";
			
			//$category_id     = isset($_POST['cmb_category']);
			//$tags 		 = isset($_POST['cmb_tags'])?$_POST['cmb_tags']:array();
		}
		?>
    
    

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script type="text/javascript">

$(function() {
    var availableTags =[<? foreach($categories as $pp)
	{
	echo '{"label":"'.$pp['title'].'", "value":"'.$pp['title'].'", "id":'.$pp['id'].'},';
		
	}?>]
	
	
	
    $( "#tags" ).autocomplete({
      source: availableTags,
	  change: function (event, ui) {
		  document.getElementById("parent_cat").value=ui.item.id;
		  var av=ui.item.id;
	  $.post("<?=site_url("admincontrol/newscat/get_hierarchy")?>/"+av, function(data) {
$('#abcc').html(data);
});
}
    });
  });
  
  
  
  function get_cat_hierarchy()
  {
	   var av=document.getElementById("tags").value;
	   if(av!="")
	   {

 }
  }
			 </script>
             
             	
			<fieldset>
			
			
					<label><?=$title?></label>
					<section><label for="password">Title:</span></label>
							<div><input value="<?=$title?>" name="txt_title" id="txt_title" type="text" tabindex="1" /></div>
				        </section>
                                        
                                        <section><label for="password">Location:</span></label>
							<div>
                                        <input  name="txt_location" id="txt_location" type="hidden" tabindex="1" value="<?=$location?>"/>
                                                        <div id='map_canvas' style='height:200px;'>
                                                        </div>                        
                                                        </div>
					</section>
                       
<!--                       <section><label for="password">News Categories Hierarchy</span></label>
							<div id="abcc"> 
  </div></section> -->
                                        
                                        
						<section><label for="password">Event Category</span></label>
							<div>  
                                                            <select name='category' >
                                                                
                                                                <option value='0' <? if($val==0)echo "selected";  ?>>Upcoming</option>
                                                                <option value='1' <? if($val==1)echo "selected";  ?>>Previous</option>
                                                                                                                                
                                                            </select>
                                                            
                                                </div></section>
          
          
                                                

                                                
                                                
                                                
                                                <section><label for="password">Start Date - End Date :</span></label>
							
                                                                                                                                                     
                                                        <div>
                                                            From : <?=$startdate?><input id="from"  type="text" value='<?=$startdate?>'> To : <input id="to" type="text" value='<?=$enddate?>'>
                                                            <input id="txt_from" name='txt_from' type="hidden" value="<?=$startdate_hidden?>">   <input id="txt_to" name='txt_to' type="hidden" value="<?=$enddate_hidden?>" >
                                                        </div>
                                                       
                                                    
                                                     <script>
                                                     
                                                          $( "#from" ).datepicker({
                                                            defaultDate: "+1w",
                                                            changeMonth: true,
                                                            numberOfMonths: 3,
                                                            dateFormat:"dd-mm-yy" ,
                                                            altField: "#txt_from",
                                                            altFormat: "yy-mm-dd",                                                            
                                                            onClose: function( selectedDate ) {
                                                              $( "#to" ).datepicker( "option", "minDate", selectedDate );                                                             
                                                            }
                                                          });
                                                          
                                                          
                                                                                                                                                                               
                                                          $( "#to" ).datepicker({
                                                            defaultDate: "+1w",
                                                            changeMonth: true,
                                                            numberOfMonths: 3,
                                                            dateFormat:"dd-mm-yy" ,
                                                            altField: "#txt_to",
                                                            altFormat: "yy-mm-dd",                                                            
                                                            onClose: function( selectedDate ) {
                                                              $( "#from" ).datepicker( "option", "maxDate", selectedDate );                                                             
                                                            }
                                                          });
                                                       
                                                                                                                                                                                                                                                                                                                                                     
                                                          </script>
                                                          
                                                          
                                                          
                                                        </section>
                                        
                                        
                                        
                                        <section><label for="password">Registration End Date :</span></label>							                                                                                                                                                                                                                                                                                                                                                                                                              
                                                        <div>                                                           
                                                            <input id="reg_date" type="text" value='<?=$regdate?>'>  
                                                            <input id="txt_reg_date" name='txt_reg_date' type="hidden" value="<?=$regdate_hidden?>" >  
                                                        </div>    
                                            
                                            
                                             <script>
                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                                         $( "#reg_date" ).datepicker({
                                                             dateFormat:"dd-mm-yy" ,
                                                            altField: "#txt_reg_date",
                                                            altFormat: "yy-mm-dd"                                                            
                                                          });
                                                                                                                                                                                                                            
                                                 
                                              </script>
                                                        
                                                        
                                         </section>
                                        
                                                       
                                                          
                                                         
  
  
                                                        
                                                
                                              
                                        
                                                <section><label for="password">Image:</span></label>
							<div><input name="txt_image" id="txt_image" type="file" tabindex="2" /> <?=form_error('txt_image');?>
                                                        <input type='hidden' id='hdn_image' value='<?=$image?>'>
                                                        </div>
						</section>
                        
                        
                        
                                                <section><label for="password">Active?:</span></label>
							<div><input name="chk_active" id="chk_active" value="1" type="checkbox" tabindex="2" <?=$is_active?> /></div>
						</section>
          
                                                <section><label for="password">Is Main?:</span></label>
							<div> <input name="chk_main" id="chk_main" value="1" type="checkbox" tabindex="2" <?=$is_main?> /></div>
						</section>
						<section><label for="textarea_auto">Content</label>
						<div>
                                                <textarea id="txt_content" name="txt_content" data-autogrow="true" ><?=$content?></textarea>
                                                <script type="text/javascript">
                                               CKEDITOR.replace( 'txt_content', 
                                                {				
                                                    filebrowserBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html',
                                                    filebrowserImageBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html?Type=Images',
                                                    filebrowserFlashBrowseUrl : '<?=base_url()?>ckfinder/ckfinder.html?Type=Flash',
                                                    filebrowserUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                    filebrowserImageUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                    filebrowserFlashUploadUrl : '<?=base_url()?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                    });
                                        </script>
							
							</div>
						</section>
						
						
						<section>
							<div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
						
			</fieldset>
					
		</section>
		
</form>		