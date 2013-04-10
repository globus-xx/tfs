<section id="content">

	<section>
	<div>
    <? if(isset($sub_id) && $check_cat<3){?>
    <a href="<?=site_url("admincontrol/newscat/addcat")?>/<?=$sub_id?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add sub News Category
		</button></a>
        <a href="<?=$back_link?>">Back</a>
        
        
    <? }
	 else if(!isset($sub_id)){
		?>
		<a href="<?=site_url("admincontrol/newscat/addcat")?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add Main News Category
		</button></a>
        <? }
		
		else if(isset($sub_id) && $check_cat<=3){?>
         <a href="<?=$back_link?>">Back</a>
         <? } ?>
	</div>
</section>	
			<div class="g12">
			<h1><?=$title?></h1>
			<?php if(validation_errors() !=	''){
	   echo validation_errors();
	   }
		 if($this->session->userdata('msg')!=''){
			 ?>
             <div class="alert i_access_denied red"><? echo $this->session->userdata('msg');?></div>
             <?
        	
			$this->session->unset_userdata('msg');
			
		} 
?>	
			<table class="datatable">
				<thead>
					<tr>
					
						<th>Title</th><th>Date Added</th>
                        
                        <th>Date Modified</th><th>Active</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					foreach($categories->result_array() as $item){
					
					?>
					
					<tr class="gradeA">
						
                        <td><a href="<?=site_url('admincontrol/newscat/view_sub')?>/<?=$item['id']?>" title="view sub News Category"><?=substr($item['title'],0,35)?></a></td>
                        <td><? echo date("F jS, Y", strtotime($item['date_added']))."<br />".date("H:i:s", strtotime($item['date_added']))?></td>
                        <td><? echo date("Y-m-d", strtotime($item['date_modified']))."<br />".date("H:i:s", strtotime($item['date_added']))?></td>
                     
                         <td><? if($item['is_active'])
						 {
							 echo "Active";
						 }
						 else
						 {
							 echo "Disabled";
						 }
						 ?></td>
                         
						

						<td class="c">
                        
                        
                        <a href="<?=base_url()?>admincontrol/newscat/edit_cat/<?=$item['id']?>" class="btn i_pencil" title="i_pencil"></a>
                        
                  <?php 
              if($this->session->userdata['adminData']['user_id']!="")
              {                                
              ?>
						<a href="<?=base_url()?>admincontrol/newscat/del_cat/<?=$item['id']?>" class="btn i_cross" title="i_cross"></a>
                        <? } ?>
						</td>
						
					</tr>
					
					<?php } ?>
					
				</tbody>
			</table>
		</div>

			
		</section>