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
		<a href="<?=site_url("admincontrol/homepage/addMenus")?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add Menus
		</button></a>
        <a href="<?=site_url("admincontrol/homepage/addMenus")?>"><button class="i_speech_bubble icon green">view Main Menus</button>
		</a>
	</div>
</section>	
			<div class="g12">
			<h1><?=$title?></h1>
			
			<table class="datatable">
				<thead>
					<tr>
					
						<th>Title</th><th>Date Added</th>
                        
                        <th>Date Modified</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					foreach($menus as $item){
					
					?>
					
					<tr class="gradeA">
						
                        
                        <td> <?=$item->title?></td>
                        <td><? echo date("F jS, Y", strtotime($item->date_added))."<br />".date("H:i:s", strtotime($item->date_added))?></td>
                        <td><? echo date("Y-m-d", strtotime($item->date_modified))."<br />".date("H:i:s", strtotime($item->date_modified))?></td>
                        
						

			<td class="c">
                        
                        
                        <a href="<?=base_url()?>admincontrol/homepage/editMenus/<?=$item->id?>" class="btn i_pencil" title="i_pencil"></a>
                        
                  <?php 
              if($this->session->userdata['adminData']['user_id']!="")
              {                                
              ?>
						<a href="<?=base_url()?>admincontrol/homepage/deleteMenus/<?=$item->id?>" class="btn i_cross" title="i_cross"></a>
                        <? } ?>
						</td>
						
					</tr>
					
					<?php } ?>
					
				</tbody>
			</table>
		</div>

			
		</section>