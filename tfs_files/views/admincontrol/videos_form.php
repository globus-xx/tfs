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
		if(isset($videoData)){
			
			$title  	= $videoData->title;
			$sortOrder	= $videoData->sort_order;
			$code 		= $videoData->code;
			$is_active	= $videoData->is_active?"checked='checked'":"";
			$is_main	= $videoData->is_active?"checked='checked'":"";
			$country_id = $videoData->member_country_id;
			$type 		= $videoData->category_id;
			
		}else{
			
			$title 		= set_value('txt_title');
			$sortOrder 	= set_value('txt_sort_order');
			$code 		= set_value('txt_code');
			$is_active	= isset($_POST['chk_active'])?"checked='checked'":"";
			$is_main	= isset($_POST['chk_active'])?"checked='checked'":"";
			$country_id = isset($_POST['cmb_country'])?$_POST['cmb_country']:0;
			$type 		= isset($_POST['cmb_type'])?$_POST['cmb_type']:1;
		}
		?>
        
             
             
             	
			<fieldset>
			
			
					<label><?=$title?></label>
					<section><label for="password">Title:</span></label>
							<div><input value="<?=$title?>" name="txt_title"  type="text" tabindex="1" required=""  id="required_field"/></div>
						</section>
                        
                        <section><label for="password">Code:</span></label>
							<div><input value="<?=$code?>" name="txt_code" id="txt_code" type="text" tabindex="1" /></div>
						</section>
                          <? if($code){ ?>
                         <section><label for="password">:</span></label>
							<div> <a href="http://www.youtube.com/watch?v=<?=$code?>" target="_blank"><img src="http://i1.ytimg.com/vi/<?=$code?>/default.jpg" /></a></div>
						</section>
                        <? }?>         
                         
						<section><label for="password">Company</span></label>
							<div>   <select name="cmb_country" id="cmb_country" style="margin:0px;" tabindex="6">
            <option value="0">Asian Chess Federation</option>
			<? 
			$member_countries =  $this->general->getAllRecordsWhere(COUNTRIES, array("is_active"=>1), "country_name", "ASC");
			foreach($member_countries as $item){?>
            <option value="<?=$item->id?>"><?=$item->country_name?></option>
            <? }?>
          </select>
		  <? if($country_id){ ?>
          <script>document.getElementById('cmb_country').value=<?=$country_id?></script>
          <? }?></div></section>
          
          
         
                        
                        
                        
                        <section><label for="password">Active?:</span></label>
					<div> <input name="chk_active" id="chk_active" value="1" type="checkbox" tabindex="2" <?=$is_active?> /></div>
						</section>
          
          <section><label for="password">Is Main?:</span></label>
							<div> <input name="chk_main" id="chk_main" value="1" type="checkbox" tabindex="2" <?=$is_main?> /></div>
						</section>

						
						
						<section>
							<div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
						
			</fieldset>
					
		</section>
		
</form>		