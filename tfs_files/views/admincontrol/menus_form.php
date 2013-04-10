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
		if(isset($menuInfo)){
			
			$title                  = $menuInfo->title;
                        $slug                   = $menuInfo->slug;
                        $pTitle                 = $menuInfo->page_title;
                        $pKeywords              = $menuInfo->page_keywords;
                        $pDescription           = $menuInfo->page_description;
                      //   $isExternal             = $menuInfo->external?"checked":"";
                        $is_active              = $menuInfo->showit?"checked='checked'":"";
                      //  $link		 	= $menuInfo->link;
                        $content                = $menuInfo->content;
                     // $banner  		= $menuInfo->banner_name;
                        $sort                   = $menuInfo->order;
                    //print$sort;die
                                               
		}else{
			
			$title 		= set_value('txt_title');
                        $slug		= set_value('txt_slug');
                        $pTitle		= set_value('txt_page_title');
                        $pKeywords	= set_value('txt_page_keywords');
                        $pDescription 	= set_value('txt_page_description');
                        $sort 		= set_value('txt_sort');
                       // $isExternal	= "";
                        
                          if(isset($_POST['chk_active']))
                            {
                              if($_POST['chk_active']==1)
                               $is_active	=  "checked='checked'";                                 
                            }
                            else
                            $is_active	="";
                            
                       //   $link		= set_value('txt_link');
                        $content  	= set_value('txt_content');   
                       // $banner			= "";
                        
                        
		}
		?>
  
    
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

             
             	
			<fieldset>
			
			
					<label><?=$title?></label>
					<section><label for="password">Menu Title:</span></label>
							<div><input value="<?=$title?>" name="txt_title" id="txt_title" type="text" tabindex="1" required="required"/></div>
				        </section>
                                        
                                        <section><label for="password">Sort Order:</span></label>
							<div><input value="<?=$sort?>" name="txt_sort" id="txt_sort" type="text" tabindex="1" required="required"/></div>
				        </section>
                                        
                                        <section><label for="password">Menu Slug:</span></label>
							<div>
                                                            <input value="<?=$slug?>"  name="txt_slug" id="txt_slug" type="text" tabindex="1" required="required"/>                                                                           
                                                        </div>
					</section>
                                        
                                        
                                        <section><label for="password">Page Title:</span></label>
							<div>
                                                            <input value="<?=$pTitle?>" name="txt_page_title" id="txt_page_title" type="text" tabindex="1" required="required"/>                                                                           
                                                        </div>
					</section>
                                        
                                        
                                         <section><label for="password">Meta Keywords :</span></label>
							<div>
                                                            <input value="<?=$pKeywords?>"  name="txt_page_keywords" id="txt_page_keywords" type="text" tabindex="1" required="required"/>                                                                           
                                                        </div>
					</section>
                                        
                                        
                                        <section><label for="password">Page Meta Description :</span></label>
							<div>
                                                            <input value="<?=$pDescription?>"  name="txt_page_description" id="txt_page_description" type="text" tabindex="1" required="required"/>                                                                           
                                                        </div>
					</section>
                       
                                        
<!--                                        
                                        <section><label for="password">Upload a New Banner: </span></label>
							<div>
                                                            <input type="file" name="image" id="image" tabindex="1" required="required" />                                                                        
                                                            <? if(form_error('image')){?>
                                                                <div class="error-left"></div>
                                                                <div class="error-inner">
                                                                  <?=form_error('image');?>
                                                                </div>
                                                             <? }?>
                                                        </div>
					</section>
                                        
                                        
                                        
                                         <section><label for="password">Child Page Banner? :</span></label>
							<div>
                                                       <select name="cmb_banner" id="cmb_banner">
                                                
                                                        </select> 
                                                        </div>
					</section>
                                        -->
                                        
                                       
                                        
                   
                                        
<!--                                         <section><label for="password">Is External?:</span></label>
							<div> <input type="checkbox" name="chk_external" id="chk_external" value="1" class="inp-form" <?=$isExternal?> /> </div>
						</section> 
                                        -->
                                        
                                       <section><label for="password">Active?:</span></label>
							<div><input name="chk_active" id="chk_active"  type="checkbox" value='1'   <?=$is_active?> /></div>
						</section>
          
                                        
                                        
                                               
                                        
<!--                                                <section><label for="password">Link (if external only):</span></label>
							<div> <input type="text" name="txt_link" id="txt_link" value="<?=$link?>" class="inp-form" /> </div>                                                                                                               
						</section> -->
              
                                                                
                                        
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