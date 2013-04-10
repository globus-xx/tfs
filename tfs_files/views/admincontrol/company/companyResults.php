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
                <span onclick="hideDiv('companyResult_financialReports')"> <label ><strong>Financial Reports | التقارير المالية 	
</strong> </label></span>
                <div id="companyResult_financialReports" > 
	 	
                <fieldset>

                                
                                <section>
                                    <label for="financialReportYear">financial Report Year:</label>
                                    <div><select name="financialReportYear" id="financialReportYear"></select><?$financialReportYear?></div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="financialReportQuater">Quarter:</label>
                                    <div><input value="<?=$financialReportQuater?>" name="financialReportQuater" id="financialReportQuater" type="text" tabindex="1" />
                                    </div>
                                </section>
                </fieldset>

                <fieldset>

                                <section>
                                    <label for="registered_in_market">File:</label>
                                    <div><input value="<?=$registered_in_market?>" name="registered_in_market" id="registered_in_market" type="text" tabindex="1" /></div>
                                </section>
                </fieldset>

                
                <fieldset>
                               
                                <section>
                                         <div><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>
                                             <input type="hidden" id="updateID" name="updateID" value="<?php print $id?>">
                                         </div>

                                </section>
                </fieldset>
        <div id="companyShareDiv" > 

             <fieldset>
     
                                <section>
                                        
                                    <label for="list_order">Year , Quarter , File</label>
                                     <div id="bshareDiv">
                                         Year | Quarter | File<div>&nbsp;</div>
                                    <select name="financialReportYear_1" id="financialReportYear_1">
                                        <option value="2010" selected="selected">2010</option>
                                    </select>
                                         
                                    | <input  placeholder="Quarter" name="financialReportQuarter_1" id="financialReportQuarter_1" type="text" tabindex="1"    style=" width: 27% !important" />
                                    | Filename.ext
                                    
<!--                                    <span onclick="addShareFields()"> Add more.</span>-->
                                         </div>
                                </section>
                </fieldset>

        </div>
           
             </div> 
            </form>
            <form action="" method="post" enctype="multipart/form-data">	
                <span onclick="hideDiv('companyResult_Income')"> <label ><strong>Company Results-Income</strong> </label></span>
                <div id="companyResult_Income" > 
	 	
                <fieldset>

                                
                                <section>
                                    <label for="incomeYear">Income Year:</label>
                                    <div> <select name="incomeYear" id="incomeYear">
                                            <option value="2010" selected="selected">2010</option>
                                          </select>
                                    </div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="sales">sales:</label>
                                    <div><input value="<?=$sales?>" name="sales" id="sales" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                
                 <fieldset>

                                
                                <section>
                                    <label for="costOfSales">cost Of Sales:</label>
                                    <div><input value="<?=$costOfSales?>" name="costOfSales" id="costOfSales" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="totalIncome">total Income:</label>
                                    <div><input value="<?=$totalIncome?>" name="totalIncome" id="totalIncome" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="adminMarketExprience">admin Market Exprience:</label>
                                    <div><input value="<?=$adminMarketExprience?>" name="adminMarketExprience" id="adminMarketExprience" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="salesIncome">sales Income:</label>
                                    <div><input value="<?=$salesIncome?>" name="salesIncome" id="salesIncome" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="investment">investment:</label>
                                    <div><input value="<?=$investment?>" name="investment" id="investment" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="financeCost">finance Cost:</label>
                                    <div><input value="<?=$financeCost?>" name="financeCost" id="financeCost" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="corporateIncomeSister">corporate Income Sister:</label>
                                    <div><input value="<?=$corporateIncomeSister?>" name="corporateIncomeSister" id="corporateIncomeSister" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="minority">minority :</label>
                                    <div><input value="<?=$minority?>" name="minority" id="minority" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>
                 <fieldset>

                                
                                <section>
                                    <label for="zakatTaxes">zakat Taxes :</label>
                                    <div><input value="<?=$zakatTaxes?>" name="zakatTaxes" id="zakatTaxes" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="extraordinaryItem">extraordinary Item :</label>
                                    <div><input value="<?=$extraordinaryItem?>" name="extraordinaryItem" id="extraordinaryItem" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="net">net :</label>
                                    <div><input value="<?=$net?>" name="net" id="net" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="averageNumberOfShare">average Number Of Share :</label>
                                    <div><input value="<?=$averageNumberOfShare?>" name="averageNumberOfShare" id="averageNumberOfShare" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="earningPerShare">earning Per Share :</label>
                                    <div><input value="<?=$earningPerShare?>" name="earningPerShare" id="earningPerShare" type="text" tabindex="1" required="required"/></div>
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
  <span onclick="hideDiv('companyResults_budget')"> <label ><strong>Company Results-Budget</strong> </label></span>
        <div id="companyResults_budget" > 

<fieldset>

                                
                                <section>
                                    <label for="budgteYear">Budget Year:</label>
                                    <div>
                                        <select name="budgteYear" id="budgteYear">
                                            <option value="2010" selected="selected">2010</option>
                                        </select>
                                    </div>
                                </section>
                </fieldset>

                 <fieldset>
                               
                                <section>
                                    <label for="cashAndCashEquivalent">cash And Cash Equivalent:</label>
                                    <div><input value="<?=$cashAndCashEquivalent?>" name="cashAndCashEquivalent" id="cashAndCashEquivalent" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                
                 <fieldset>

                                
                                <section>
                                    <label for="owe">owe:</label>
                                    <div><input value="<?=$owe?>" name="owe" id="owe" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="stock">stock:</label>
                                    <div><input value="<?=$stock?>" name="stock" id="stock" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="otherCash">other Cash:</label>
                                    <div><input value="<?=$otherCash?>" name="otherCash" id="otherCash" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="totalCurrentAssets">total Current Assets:</label>
                                    <div><input value="<?=$totalCurrentAssets?>" name="totalCurrentAssets" id="totalCurrentAssets" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="property">property:</label>
                                    <div><input value="<?=$property?>" name="property" id="property" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="name">investments:</label>
                                    <div><input value="<?=$investments?>" name="investments" id="investments" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="intengibleAssets">corporate Income Sister:</label>
                                    <div><input value="<?=$intengibleAssets?>" name="intengibleAssets" id="intengibleAssets" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="otherAsset">other Asset :</label>
                                    <div><input value="<?=$otherAsset?>" name="otherAsset" id="otherAsset" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>
                 <fieldset>

                                
                                <section>
                                    <label for="name">total Non Current Assets :</label>
                                    <div><input value="<?=$totalNonCurrentAssets?>" name="totalNonCurrentAssets" id="totalNonCurrentAssets" type="text" tabindex="1" required="required"/></div>
                                </section>
                </fieldset>

                 <fieldset>

                                
                                <section>
                                    <label for="name">total Assets :</label>
                                    <div><input value="<?=$totalAssets?>" name="totalAssets" id="totalAssets" type="text" tabindex="1" required="required"/></div>
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
