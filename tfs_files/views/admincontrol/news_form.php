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
			
          
			 } ?>	
             
             
             </div>
        
               <? 
		if(isset($newsData)){
			
			$title  	 = $newsData->title;
			$content     = $newsData->content;
			$sortOrder	 = $newsData->sort_order;
			$image 		 = $newsData->image;
			$is_active	 = $newsData->is_active?"checked='checked'":"";
			$is_main	 = $newsData->ismain;
			$country_id  = $newsData->member_country_id;
			$category_id = $newsData->category_id;
			$s_name = $newsData->source_name;
			$s_link = $newsData->source_link;
			$dd=$this->admin_model-> check_callback("acf_news_categories",$category_id,"id");
			foreach($dd->result_array() as $mm)
			{
				$val=$mm['title'];
			}
			$tag_ids 	 = $this->general->getAllRecordsWhere(TAGSRELATIONS, array("item_id"=>$newsData->id, "item_type"=>"news"));
			foreach($tag_ids as $t){
				$tags[]=$t->tag_id;
			}
			
		}else{
			
			$title 		 = set_value('txt_title');
			$content  	 = set_value('txt_content');
			$sortOrder 	 = set_value('txt_sort_order');
			
			$val 	 = set_value('contact');
			$image 		 = "";
			$is_active	 = isset($_POST['chk_active'])?"checked='checked'":"";
			$is_main	 = isset($_POST['chk_main'])?"checked='checked'":"";
			$country_id  = isset($_POST['cmb_country'])?$_POST['cmb_country']:0;
			$category_id = isset($_POST['cmb_category']);
			$tags 		 = isset($_POST['cmb_tags'])?$_POST['cmb_tags']:array();
			$s_name = isset($_POST['s_name']);
			$s_link = isset($_POST['s_link']);
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
							<div><input value="<?=$title?>" name="txt_title" id="txt_title" type="text" tabindex="1" required="required"/></div>
						</section>
                       
                       <section><label for="password">News Categories Hierarchy</span></label>
							<div id="abcc"> 
  </div></section> 
						<section><label for="password">News Category</span></label>
							<div>  <input id="tags" class="ui-autocomplete-input" type="text" style="display:block" name="contact" autocomplete="off" onchange="get_cat_hierarchy();" value="<?=$val?>"><input type="hidden" name="parent_cat" id="parent_cat" value="<?=$category_id?>" />
  </div></section>
          
          
          
          <section><label for="password">Image:</span></label>
							<div><input name="txt_image" id="txt_image" type="file" tabindex="2" /> <?=form_error('txt_image');?></div>
						</section>
                        <?
						if($image)
						{
                           ?>
          <section><label for="password">Image:</span></label>
							<div>
                            <img src="<?=base_url()?>images/news/thumb_<?=$image?>" width="100px" height="80"/>
                            
                            </div>
						</section>
                        <? }?>
                        
                        
                        <section><label for="password">Active?:</span></label>
							<div><input name="chk_active" id="chk_active" value="1" type="checkbox" tabindex="2" <?=$is_active?> /></div>
						</section>
          
          <section><label for="password">Type ?:</span></label>
							<div> <input name="chk_main" id="chk_main" value="1" type="radio" tabindex="2" <?if($is_main==1)echo "checked"; else echo "";?> />Main</div><br>
                                                        <div> <input name="chk_main" id="chk_main2" value="2" type="radio" tabindex="2" <?if($is_main==2)echo "checked"; else echo "";?> />SubMain</div><br>
                                                        <div> <input name="chk_main" id="chk_main3" value="3" type="radio" tabindex="2" <?if($is_main==3)echo "checked"; else echo "";?> />none</div>
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
						<section><label for="password">Source Name:</span></label>
							<div><input value="<?=$s_name?>" name="s_name" id="txt_title" type="text" tabindex="1" required="required"/></div>
						</section>
                        <section><label for="password">Source Link:</span></label>
							<div><input value="<?=$s_link?>" name="s_link" id="txt_title" type="text" tabindex="1" required="required"/></div>
						</section>
						
						<section>
							<div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
						
			</fieldset>
					
		</section>
		
</form>		