<section id="content">


	<section>
	<div>
		<a href="<?=site_url("admincontrol/news/addNews")?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add News
		</button></a>
        <a href="<?=site_url("admincontrol/news/addNews")?>"><button class="i_speech_bubble icon green">view Main News</button>
		</a>
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
					
						<th>Image</th><th>Title</th><th>Date Added</th>
                        
                        <th>Date Modified</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					foreach($news as $item){
					
					?>
					
					<tr class="gradeA">
						<td> <img src="<?=base_url()?>images/news/thumb_<?=$item->image?>" width="100px" height="80"/></td>
                        
                        <td> <?=substr($item->title,0,35)?></td>
                        <td><? echo date("F jS, Y", strtotime($item->date_added))."<br />".date("H:i:s", strtotime($item->date_added))?></td>
                        <td><? echo date("Y-m-d", strtotime($item->date_modified))."<br />".date("H:i:s", strtotime($item->date_added))?></td>
                        
						

						<td class="c">
                        
                        
                        <a href="<?=base_url()?>admincontrol/news/editNews/<?=$item->id?>" class="btn i_pencil" title="i_pencil"></a>
                        
                  <?php 
              if($this->session->userdata['adminData']['user_id']!="")
              {                                
              ?>
						<a href="<?=base_url()?>admincontrol/news/deleteNews/<?=$item->id?>" class="btn i_cross" title="i_cross"></a>
                        <? } ?>
						</td>
						
					</tr>
					
					<?php } ?>
					
				</tbody>
			</table>
		</div>

			
		</section>