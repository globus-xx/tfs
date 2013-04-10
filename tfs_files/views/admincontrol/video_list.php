<section id="content">


	<section>
	<div>
		<a href="<?=site_url("admincontrol/videos/addVideos")?>"><button class="btn red" style="float:right;" name="submitbuttonname" value="submitbuttonvalue">Add Video
		</button></a>
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
					
						<th width="100">Video</th><th width="200">Title</th><th width="130">Date Added</th>
                        
                        <th width="110">Date Modified</th><th>Active</th><th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					
					foreach($videos as $item){
					
					?>
					
					<tr class="gradeA">
						<td> <a href="http://www.youtube.com/watch?v=<?=$item->code?>" target="_blank"><img src="http://i1.ytimg.com/vi/<?=$item->code?>/default.jpg" /></td>
                        
                        <td> <a href="<?=site_url("admincontrol/videos/editVideos/".$item->id)?>"><?=$item->title?></a></td>
                        <td><? echo date("F jS, Y", strtotime($item->date_added))."<br />".date("H:i:s", strtotime($item->date_added))?></td>
                        <td><? echo date("Y-m-d", strtotime($item->date_modified))."<br />".date("H:i:s", strtotime($item->date_added))?></td>
                        <td><?=$item->is_active?"Active":"Disabled"?></td>
                     
                        
						

						<td class="c">
                        
                        
                        <a href="<?=site_url("admincontrol/videos/editVideos/".$item->id)?>" class="btn i_pencil" title="i_pencil"></a>
                        
                  <?php 
              if($this->session->userdata['adminData']['user_id']!="")
              {                                
              ?>
						<a href="<?=base_url()?>admincontrol/videos/deleteVideos/<?=$item->id?>" class="btn i_cross" title="i_cross"></a>
                        <? } ?>
						</td>
						
					</tr>
					
					<?php } ?>
					
				</tbody>
			</table>
		</div>

			
		</section>