<script type="text/javascript" src="<?=base_url();?>ckeditor/ckeditor.js"></script>

<form action="" method="post" enctype="multipart/form-data">
<section id="content">
	
<div style="color:#900">
<?php if(validation_errors() !=	''){
	   echo validation_errors();
	   }
		
		 if($this->session->userdata('msg')!=''){
       
       
        echo $this->session->userdata('msg');
			$this->session->unset_userdata('msg');
			
          
			 } ?>	</div>
               <? 
			   
		
			foreach($edit_cat->result_array() as $mnp)
			
			$title 		 = $mnp['title'];
			$p_id=$mnp['p_id'];
			$is_active= $mnp['is_active']?"checked='checked'":"";
			if(validation_errors())
			{
					$title 		 = set_value('txt_title');
			$is_active= set_value('chk_active')?"checked='checked'":"";
			}
			
		
		?>
             
             
             	
			<fieldset>
			
			
					<label><?=$title?></label>
					<section><label for="password">Title:</span></label>
							<div><input value="<?=$title?>" name="txt_title" id="txt_title" type="text" tabindex="1" required="required"/></div>
						</section>
                        <input type="hidden" name="p_id" value="<?=$p_id?>"/>
  
                        
                        
                        
                        <section><label for="password">Active?:</span></label>
							<div><input name="chk_active" id="chk_active" value="1" type="checkbox" tabindex="2" <?=$is_active?>/></div>
						
						</section>
						
						<section>
							<div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
						
			</fieldset>
					
		</section>
		
</form>		