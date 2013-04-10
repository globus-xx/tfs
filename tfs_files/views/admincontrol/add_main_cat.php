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
		
			
			$title 		 = set_value('txt_title');
			
	?>
			<fieldset>
			
			
					<label><?=$title?></label>
					<section><label for="password">Title:</span></label>
							<div><input value="<?=$title?>" name="txt_title" id="txt_title" type="text" tabindex="1" required="required"/></div>
						</section>
                        
  
                        
                        
                        
                        <section><label for="password">Active?:</span></label>
							<div><input name="chk_active" id="chk_active" value="1" type="checkbox" tabindex="2" /></div>
						
						</section>
						
						<section>
							<div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
						
			</fieldset>
					
		</section>
		
</form>		