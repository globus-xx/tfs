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
//		if(isset($companyShare)){
//                    extract(get_object_vars($companyShare));
//                       $establishing_date_hidden=$establishing_date; $establishing_date         = date('d-m-Y', strtotime($establishing_date));  
//                        $registered_date_hidden=$registered_date; $registered_date         = date('d-m-Y', strtotime($registered_date));  
//                        $first_trading_day_hidden=$first_trading_day; $first_trading_day         = date('d-m-Y', strtotime($first_trading_day));  
//		
//			
//
//			
//		}
               
						
						
		?>
            
            <form action="" method="post" enctype="multipart/form-data">	
                <span onclick="hideDiv('companyShare_form')"> <label ><strong>Company Share Holders</strong> </label></span>
                <div id="companyShare_form" > 
	 	
                <fieldset>

                                
                                <section>
                                    <label for="name">Share Holder Country:</label>
                                    <div><input value="<?=$name?>" name="name" id="name" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="txt_establishing_date">Type:</label>
                                    <div><input value="<?=$establishing_date?>" name="txt_establishing_date" id="txt_establishing_date" type="text" tabindex="1" />
                                    <input value="<?=$establishing_date_hidden?>" name="establishing_date" id="establishing_date" type="hidden" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="registered_in_market">Percentage Of Share:</label>
                                    <div><input value="<?=$registered_in_market?>" name="registered_in_market" id="registered_in_market" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                              
                                <section>
                                    <label for="txt_registered_date">Region/Nationality:</label>
                                    <div><input value="<?=$registered_date?>" name="txt_registered_date" id="txt_registered_date" type="text" tabindex="1" />
                                    <input value="<?=$registered_date_hidden?>" name="registered_date" id="registered_date" type="hidden" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                

                <fieldset>

                                
                                <section>
                                         <div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>
                                             <input type="hidden" id="updateID" name="updateID" value="<?php print $id?>">
                                         </div>

                                </section>
                </fieldset>

           
             </div> 
 </form>

  <form action="" method="post" enctype="multipart/form-data">
  <span onclick="hideDiv('companyShare_company')"> <label ><strong>Shareholder Companies</strong> </label></span>
        <div id="companyShare_company" > 
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
             <fieldset>
     
                                <section>
                                        
                                    <label for="list_order">Company Name & Share%</label>
                                     <div id="bmemberDiv">
                                    <input  placeholder="Company Name" name="company_id_1" id="company_id_1" type="text" tabindex="1" style=" width: 40% !important" />
                                    & <input  placeholder="Designation" name="company_id_1" id="company_id_1" type="text" tabindex="1"    style=" width: 40% !important" />
                                    
                                    <span onclick="addShareholderCompanyFilelds()"> Add more.</span>
                                         </div>
                                </section>
                </fieldset>

        </div>
 </form> 