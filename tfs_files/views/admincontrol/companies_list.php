<section id="content">
<?php if(validation_errors() !=	''){
	   echo validation_errors();
	   }
		 if($this->session->userdata('msg')!=''){
        	echo $this->session->userdata('msg');
			$this->session->unset_userdata('msg');
			
		} 
?>	

	<section>
	<div>
		<a href="<?=site_url("admincontrol/company/upadateCompany")?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add Company
		</button></a>
        <!--<a href="<?=site_url("admincontrol/company/upadateCompany")?>"><button class="i_speech_bubble icon green">view Main company</button>
		</a>-->
	</div>
</section>	
			<div class="g12">
			<h1><?=$title?></h1>
			
			<table class="datatable">
				<thead>
					<tr>
					
						<th>Company Name</th>
                                                <th>Market</th>
                                                <th>Capital</th>
                                                <th>Web site</th>
                                                <th>Action</th>
                        
                       
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					foreach($companies as $item){
					
					?>
					
					<tr class="gradeA">
						
                                        <td><?php print $item->name ?></td>
                                        <td> <?php $item->registered_in_market ?></td>
                                        <td><?php $item->capital_and_paid ?></td>
                                       
                                        <td><?php $item->website_url ?></td>
                                        <td class="c">
                        
                                                <a href="<?=base_url()?>admincontrol/company/upadateCompany/<?=$item->id?>" class="btn i_pencil" title="i_pencil"></a>

                                                <?php 
                                                if($this->session->userdata['adminData']['user_id']!="")
                                                {                                
                                                ?>
                                                   <a href="<?=base_url()?>admincontrol/company/deleteCompany/<?=$item->id?>" class="btn i_cross" title="i_cross"></a>
                                                <? } ?>
						</td>
                           
											
					</tr>
					
					<?php } ?>
					
				</tbody>
			</table>
		</div>

			
		</section>