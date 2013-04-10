<link rel="stylesheet" type="text/css" href="<?=base_url()?>scripts/jquery/style.css?version=new" />
<script type="text/javascript" src="<?=base_url()?>scripts/jquery/jquery-ui-tabs-rotate.js" ></script>
<script type="text/javascript">


$(document).ready(function() {
	
		$('#calendar').fullCalendar({
		
			// US Holidays
//			events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
			events: "<?=base_url()?>/assets/json-events.php",
			eventClick: function(event) {
				// opens events in a popup window
				window.open(event.url, 'gcalevent', 'width=700,height=600');
				return false;
			},
			
			loading: function(bool) {
				if (bool) {
					$('#loading').show();
				}else{
					$('#loading').hide();
				}
			}
			
		});
		
	});
</script><script type="text/javascript">
	$(document).ready(function(){
		$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
        
    </script><div id="featured" style="float: right" >
		  <ul class="ui-tabs-nav">
	        
	        <? 
			$count=1;
			foreach($slider_naws as $row)
			{?>
	       
                <li class="ui-tabs-nav-item" id="nav-fragment-<?=$count?>"><a href="#fragment-<?=$count?>"><div><?=substr($row->title,0,200)?></div></a></li>
			<?
			$count++;
			 } ?>
	      </ul>
 
	        <? 
			$count1=1;
			foreach($slider_naws as $row1)
			{?>

	    <!-- First Content -->
	    <div id="fragment-<?=$count1?>" class="ui-tabs-panel" style="">
			<img src="<?=base_url()?>images/news/<?=$row1->image?>" alt="" />
			 <div class="info" >
				<h2><a href="<?=base_url()?>news/view/<?=$row1->id?>"><strong><?=substr($row1->title,0,90)?></strong></a></h2>
				<p><?=strip_tags(substr($row1->content,0,250))?><a href="<?=base_url()?>news/view/<?=$row1->id?>">read more</a></p>
			 </div>
	    </div>
<?
			$count1++;
			 } ?>
	    <!-- Second Content -->
	    

	    <!-- Third Content -->
	    

	    <!-- Fourth Content -->
	    
		
		

		</div>