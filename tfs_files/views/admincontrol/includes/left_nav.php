<nav>
			<ul id="nav">
				<li class="i_house"><a href="<?=base_url()?>admincontrol/homepage"><span>Dashboard</span></a></li>
				
				<li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="news"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/news/listNews"><span>Manange News </span></a></li>
                <li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="cat"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/newscat"><span>Manange News Categories </span></a></li>
				
			<li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="video"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/videos/listVideos"><span>Manange Video Gallery </span></a></li>
               
                        <li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="cmp"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/company"><span>Manange Companies </span></a></li>
                        <li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="events"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/homepage/listEvents"><span>Manange Events </span></a></li>
                        <li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="events"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/users"><span>Manange Users </span></a></li>
                      <!--  <li class="i_speech_bubbles_2"><a <? if(isset($class)){ if($class=="menus"){?> class="active"<? } }?> href="<?=base_url()?>admincontrol/homepage/listMenus"><span>Manange Menus </span></a></li>
-->				
			</ul>
		</nav>