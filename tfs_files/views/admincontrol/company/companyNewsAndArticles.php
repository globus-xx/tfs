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
                <span onclick="hideDiv('companyResult_Incom')"> <label ><strong>News and Events</strong> </label></span>
                <div id="companyResult_Incom" > 
	 	
                    <p>News and Events related to the company will be listed here</p>

                </div></form>