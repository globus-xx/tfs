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
		if(isset($companyData)){
                    extract(get_object_vars($companyData));
                       $establishing_date_hidden=$establishing_date; $establishing_date         = date('d-m-Y', strtotime($establishing_date));  
                        $registered_date_hidden=$registered_date; $registered_date         = date('d-m-Y', strtotime($registered_date));  
                        $first_trading_day_hidden=$first_trading_day; $first_trading_day         = date('d-m-Y', strtotime($first_trading_day));  
		
			

			
		}
               
						
						
		?>
            
            <form action="" method="post" enctype="multipart/form-data">	
 <span onclick="hideDiv('companydata_form')"> <label ><strong>Company Profile</strong> </label></span><div id="companydata_form" > 
	 	
                <fieldset>

                                
                                <section>
                                    <label for="name">Company Name:</label>
                                    <div><input value="<?=$name?>" name="name" id="name" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="txt_establishing_date">Establishing Date:</label>
                                    <div><input value="<?=$establishing_date?>" name="txt_establishing_date" id="txt_establishing_date" type="text" tabindex="1" />
                                    <input value="<?=$establishing_date_hidden?>" name="establishing_date" id="establishing_date" type="hidden" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="registered_in_market">registered _in_market:</label>
                                    <div><input value="<?=$registered_in_market?>" name="registered_in_market" id="registered_in_market" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                              
                                <section>
                                    <label for="txt_registered_date">registered_date:</label>
                                    <div><input value="<?=$registered_date?>" name="txt_registered_date" id="txt_registered_date" type="text" tabindex="1" />
                                    <input value="<?=$registered_date_hidden?>" name="registered_date" id="registered_date" type="hidden" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                <fieldset>

                               
                                <section>
                                    <label for="txt_first_trading_day">first_trading_day:</label>
                                    <div><input value="<?=$first_trading_day?>" name="txt_first_trading_day" id="txt_first_trading_day" type="text" tabindex="1" />
                                    <input value="<?=$registered_date_hidden?>" name="first_trading_day" id="first_trading_day" type="hidden" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="company_ownership">company_ownership:</label>
                                    <div><input value="<?=$title?>" name="company_ownership" id="company_ownership" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                               
                                <section>
                                    <label for="world_record_definition_of_securities">world_record_definition_of_securities:</label>
                                    <div><input value="<?=$world_record_definition_of_securities?>" name="world_record_definition_of_securities" id="world_record_definition_of_securities" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                              
                                <section>
                                    <label for="activity">activity:</label>
                                    <div><input value="<?=$activity?>" name="activity" id="activity" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="fiscal_year">fiscal_year:</label>
                                    <div><input value="<?=$fiscal_year?>" name="fiscal_year" id="fiscal_year" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                               
                                <section>
                                    <label for="external_auditor">external_auditor:</label>
                                    <div><input value="<?=$external_auditor?>" name="external_auditor" id="external_auditor" type="text" tabindex="1"/></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="capital_and_paid">capital_and_paid:</label>
                                    <div><input value="<?=$capital_and_paid?>" name="capital_and_paid" id="capital_and_paid" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="head_office">head_office:</label>
                                    <div><input value="<?=$head_office?>" name="head_office" id="head_office" type="text" tabindex="1"/></div>
                                </section>
                </fieldset>

                <fieldset>

                               
                                <section>
                                    <label for="phone">phone:</label>
                                    <div><input value="<?=$phone?>" name="phone" id="phone" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="fax">fax:</label>
                                    <div><input value="<?=$fax?>" name="fax" id="fax" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="website_url">website_url:</label>
                                    <div><input value="<?=$website_url?>" placeholder="domain.tld like google.ae" name="website_url" id="website_url" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="email_ids">email_ids:</label>
                                    <div><input value="<?=$email_ids?>" name="email_ids" id="email_ids" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                <fieldset>

                                
                                <section>
                                    <label for="list_order">list order:</label>
                                    <div><input value="<?=$title?>" placeholder="1 to 10, will be place in front end listing" name="list_order" id="list_order" type="text" tabindex="1" /></div>
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
  <span onclick="hideDiv('companyBoard_members')"> <label ><strong>Board Members</strong> </label></span>
        <div id="companyBoard_members" > 

             <fieldset>
     
                                <section>
                                        
                                    <label for="list_order">Name & Designation</label>
                                     <div id="bmemberDiv">
                                    <input  placeholder="Name" name="bordmemberName_1" id="bordmemberName_1" type="text" tabindex="1" style=" width: 40% !important" />
                                    & <input  placeholder="Designation" name="bordmemberName_1" id="bordmemberName_1" type="text" tabindex="1"    style=" width: 40% !important" />
                                    
                                    <span onclick="addBoardMemberFilelds()"> Add more.</span>
                                         </div>
                                </section>
                </fieldset>

        </div>
 </form> 
  <form action="" method="post" enctype="multipart/form-data"> 
  <span onclick="hideDiv('companyShareDiv')"> <label ><strong>Company Shares</strong> </label></span>
        <div id="companyShareDiv" > 

             <fieldset>
     
                                <section>
                                        
                                    <label for="list_order">Name , Designation , Share%</label>
                                     <div id="bshareDiv">
                                         Name | Country | Share%<div>&nbsp;</div>
                                    <input  placeholder="Company" name="companyName_1" id="companyName_1" type="text" tabindex="1" style=" width: 27% !important" />
                                    | <input  placeholder="Country" name="shareCountry_1" id="shareCountry_1" type="text" tabindex="1"    style=" width: 27% !important" />
                                    | <input  placeholder="Sahre" name="sahre_1" id="sahre_1" type="text" tabindex="1"    style=" width:27% !important" />
                                    
                                    <span onclick="addShareFields()"> Add more.</span>
                                         </div>
                                </section>
                </fieldset>

        </div>
</form>