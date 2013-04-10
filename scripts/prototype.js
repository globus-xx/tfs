function sl(id) { return document.getElementById(id); }  
function wr(item){
var input=sl('area');
input.focus();
if (input.setSelectionRange) {
var srt = input.selectionStart;
var len = input.selectionEnd;
if (srt < len) srt++;
input.value = input.value.substr(0,srt)+item+input.value.substr(len);
input.setSelectionRange(srt+1,srt+1);
}
else{
var range=document.selection.createRange();
range.text=item;}
input.focus();
input.scrollTop = input.scrollHeight;	
}
	
var t=0;
var v=0;
var s=0;
function check(el){
	var a=sl("chk_trans");
	var b=sl("chk_virtual");
	var c=sl("chk1");
if(el=='trans'){

	//ex or gecko
	sl('area').focus();
  	if(t==0){
	$.cookie("transMethode", "trans", { expires: 100 });
	if(sl('area').setSelectionRange){
	sl('area').onkeyup =  function(){ a=sl('area').value;  sl('area').value=trans(a); }; 
	}
	else {
	sl('area').onkeyup =  function(){ a=sl('area').value;  sl('area').value=trans(a); };
	}


//shwo 
	sl("area").onkeypress = showChar;
	$('#contour').slideDown("slow");
	a.style.backgroundPosition="-133px -2px";
	b.style.backgroundPosition="-147px -2px";
	t=1;v=0;
	}		
	else if(t==1){
	$.cookie("transMethode", null);
	sl("area").onkeyup= "";
	sl("area").onkeypress= "";
	$('#contour').slideUp("slow");
	a.style.background="url(i/inputs) no-repeat -147px -2px";
	t=0;v=0;
	}
	if(sl('k').src=="http://www.arabic-keyboard.org/i/virtual_keyboard.png"){
	sl('k').src="i/keyboard.png";
	}
	$('#transform').css({borderColor:'#55B5ED'})
	
}
else if(el=="virtual"){
	
   	if(v==0){
	$.cookie("transMethode", "virtual", { expires: 100 });
	sl("area").onkeyup = virtual;
	a.style.backgroundPosition="-147px -2px";
	b.style.backgroundPosition="-133px -2px";
	v=1;t=0;
	}		
	else if(v==1){
	$.cookie("transMethode", null);
	sl("area").onkeyup= "";
	sl("area").onkeypress= "";
	b.style.backgroundPosition="-147px -2px";
	v=0;t=0;	
	}
	$('#contour').slideUp("slow");
	
	if(sl('k').src=="http://www.arabic-keyboard.org/i/keyboard.png"){
	sl('k').src="i/virtual_keyboard.png";
	} 
	$('#transform').css({borderColor:'#55B5ED'});
	
}

if(el=='sbi'){
	
  	if(s==0){
	$.cookie("transPlus", "sbi", { expires: 100 });	
	sl("sbi").onkeyup = function(){ a=sl('sbi').value;  sl('sbi').value=trans(a); }
 	sl("sbi").onkeypress = showChar;
	$('#contour').slideDown("slow");
	c.style.backgroundPosition="-133px -2px";
	s=1;
	}		
	else if(s==1){
	$.cookie("transPlus", null);
	sl("sbi").onkeyup= "";
	sl("sbi").onkeypress= "";
	$('#contour').slideUp("slow");
	c.style.backgroundPosition="-147px -2px";
	s=0;
	}
}

if(v==0 && t==0){
$('#transform').css({borderColor:'#b5b5b5'}) 
}

}


function trans(p){
var en2ar=new Array(
	"W","Ù‹",
	"3","Ø¹",
	"a","Ø§",  
	"b","Ø¨","p","Ø¨",  
	"t","Øª",
	"7","Ø­",
	"c","Ø«","Ø³Ø³","Ø«","Øª'","Ø«",  
	"j","Ø¬",
	"Ø­'","Ø®","x","Ø®","5","Ø®",
	"k","Ùƒ",  
	"d","Ø¯",  
	"Ø¯'","Ø°", 
	"r","Ø±",  
	"z","Ø²","Ø±'","Ø²",  "R","Ø²",
	"s","Ø³", 
	"Ø«Ù‡","Ø´","Ø³'","Ø´",
	"S","Øµ","9","Øµ",
	"Øµ'","Ø¶","D","Ø¶","9'","Ø¶",
	"T","Ø·","6","Ø·",
	"Ø·'","Ø¸","Z","Ø¸", 
	"Ø¹'","Øº","gÙ‡","Øº","Ø¹'","Øº","gÙ‡","Øº",
	"f","Ù","v","Ù",
	"Ùƒ'","Ù‚","K","Ù‚","q","Ù‚", 
	"l","Ù„",
	"m","Ù…",
	"n","Ù†",
	"h","Ù‡",
	"w","Ùˆ","o","Ùˆ","u","Ùˆ",
	"y","ÙŠ","i","ÙŠ",
	"e","Ø¢",
	"Ùˆ'","Ø¤","ÙˆØ¡","Ø¤",
	"Ø¡ÙŠ","Ø¦","Ø¡#","Ø¦", "ÙŠ'","Ø¦",
	"#","Ù‰", "Ø¢Ø¢","Ù‰", 
	"Ø§Ø¡Ø¡","Ø¥","I","Ø¥","A","Ø¥",
	"Ø¡Ø§","Ø£","Ø§'","Ø£",
	"_","Ù€",
	"2","Ø¡","-","Ø¡",
	"Ù‡'","Ø©", "H","Ø©",
	//7arakat
	"Ø§=","ÙŽ", 
	"Ùˆ=","Ù", 
	"ÙŠ=","Ù",
	"ÙˆÙ†=","ÙŒ",
	"ÙŠÙ†=","Ù",
	"Ø§Ù†=","Ù‹",
	"1","Ø£",
	"Ø¡Ø¡Ø¡","Ù€Ù€Ù€Ù€Ù€Ù€"
);
 
	
	
	for(i=0;i<en2ar.length;i=i+2){
		p=p.replace(en2ar[i],en2ar[i+1]);
	}
	return p;
	
}	

function virtual(){
var en2ar=new Array(	
	"1","Ù¡",
	"2","Ù¢",
	"3","Ù£",
	"4","Ù¤",
	"5","Ù¥",
	"6","Ù¦",
	"7","Ù§",
	"8","Ù¨",
	"9","Ù©",
	"0","Ù ",
	"q","Ø¶",
	"w","Øµ",
	"e","Ø«",
	"r","Ù‚",
	"t","Ù",
	"y","Øº", 
	"u","Ø¹",
	"i","Ù‡",
	"o","Ø®",
	"p","Ø­",
	'{','Ø¬', '[','Ø¬', 
	"}","Ø¯", "]","Ø¯", 
	"a","Ø´",
	"s","Ø³",
	"d","ÙŠ",
	"f","Ø¨",
	"g","Ù„",
	"h","Ø§",
	"j","Øª",
	"k","Ù†",
	"l","Ù…",  
	";","Ùƒ",
	"\'","Ø·", 
	"z","Ø¦",  
	"x","Ø¡",
	"c","Ø¤",
	"v","Ø±",".","Ø²",
	"b","Ù„Ø§", 
	"n","Ù‰",
	"m","Ø©",
	"<","Ùˆ",
	",","Ùˆ",
	"-","Ø¸","/","Ø¸",
	"D","Ø°","Y","Ø¥","Q","ÙŽ","W","Ù‹","E","Ù","A","Ù","S","Ù",
	"G","Ù„Ø£","H","Ø£","T","Ù„Ø¥","Y","Ø¥","B","Ù„Ø¢","N","Ø¢","J","Ù€","K","ØŒ",
	//German 
	"Ã¤","Ø·","Ã¶","Ùƒ","Ã¼","Ø¬", "+","Ø¯" 
	);
 
	
    br=sl("area").value;
	for(i=0;i<en2ar.length;i=i+2){
		br=br.replace(en2ar[i],en2ar[i+1]); 
	}			
	sl("area").value=br;
}	


function change(inhalt,no,a){
	sl('cse-search-box').action=inhalt;
	sl('bild').src=no;
	sl('sbi').focus();
	var El=sl('auswahl').getElementsByTagName("a")
	var c=El.length;
	for(i=0; i<c; i++ ){
	El[i].style.borderBottom="0px solid #fff";
	El[i].style.color="#999";}
	a.style.borderBottom="2px solid #FF3333";
	a.style.color="#444"; 
}

function OnSubmitForm()
{
  if(document.pressed == '1')
  {  sl('send').action ="/save.php"; }
  else if(document.pressed == '2') {
    sl('send').action ="/print.php";
  }
  else if(document.pressed == '3') {
    sl('send').action ="/editor/index.php";
  }
  else if(document.pressed == '4') {
    sl('send').action ="/translate/index.php";
  }
 
	sl('send').submit();
  return true;
}

var timeout    = 300; //dropdown hide
var closetimer = 0;
var ddmenuitem = 0;
var ok=0;
function jsddm_open()
{  jsddm_canceltimer();
   jsddm_close();
    ddmenuitem = $(this).find('ul').css('visibility', 'visible');
}
function jsddm_close()
{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}
function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}
function jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;}}



function op(el){
	var input=sl("area").value;
	var encode = encodeURI(input);
 if(el=="back"){
 		var target = sl("area");
		target.focus();
        if (target.setSelectionRange) {
         var srt = target.selectionStart;
         var len = target.selectionEnd;
        if (srt < len) srt++;
         target.value = target.value.substr(0, srt - 1) + 
		 target.value.substr(len);
         target.setSelectionRange(srt - 1, srt - 1);
		 target.focus();
        } else 
		if (target.createTextRange) {
		 self.VKI_range = document.selection.createRange();
         try { self.VKI_range.select(); } 
		catch(e) {}
		  self.VKI_range = document.selection.createRange();
          if (!self.VKI_range.text.length) 
		  self.VKI_range.moveStart('character', -1);
          self.VKI_range.text = "";
		  target.focus(); }	
		else target.value = target.value.substr(0, target.value.length - 1);
		     target.focus();
			return true;
 
  }
  else if(el=="search"){  
	sl("sbi").value = input;
	 sl('sbi').style.borderColor='#55B5ED';
  }
  else if(el=="google"){  


	MeinFenster = window.open("http://www.arabic-keyboard.org/search/?q="+encode+"&sa=&cx=partner-pub-1712545686841324%3Achjry2-kwko&cof=FORID%3A9&ie=UTF-8#883");
   }
    else if(el=="ssg"){
	MeinFenster = window.open("http://www.arabic-keyboard.org/search/?cx=partner-pub-1712545686841324%3Achjry2-kwko&cof=FORID%3A9&ie=UTF-8&q="+sl('ssg').firstChild.nodeValue);
   }
    else if(el=="youtube"){
 MeinFenster = window.open("http://www.youtube.com/results?search_type=&search_query="+encode);
   }
   
    else{
 	MeinFenster = window.open("http://www.arabic-keyboard.org/search/?q="+encode+"&sa=&cx=partner-pub-1712545686841324%3Achjry2-kwko&cof=FORID%3A9&ie=UTF-8#883");
  }
}
 


function showChar(e){
	var h;
	if(document.selection){
	var g=window.event.keyCode;} else {
	var g=e.charCode;}
	var t=String.fromCharCode(g);
switch (t) {
case "3": tip = " 3'=&#1594; ";break;
case "2": tip = " ee = &#1609; /  i' = &#1574; / o' =  &#1572; " ;break;
case "a": tip = " # = Ù‰ / a = &#1575; / a' = &#1571; / A = &#1573;  ";break;

case "b": tip = " p = &#1576;  ";break;
case "c": tip = " s = &#1587;  /  ss = &#1579; ";break;
case "h": tip = " 7' = Ø®   /  x = Ø®  / H = Ø© ";break;
case "7": tip = " 7' = Ø®    ";break;
case "k": tip = " q = &#1602; ";break;
case "g": tip = " j = &#1580; ";break;
case "q": tip = " k = &#1603; ";break;
case "d": tip = " d' = &#1584; / D = &#1590;";break;
case "e": tip = " 2 = &#1569; /  i' = &#1574; / o' =  &#1572;";break;
case "r": tip = " r' = &#1586;  / R = &#1586; ";break;
case "s": tip = " c = &#1579; / S = &#1589; / ch = &#1588;  ";break;
case "9": tip = " ch = &#1588;  / s' = &#1588; / S = &#1589;";break;
case "i": tip = " A = &#1573;  / i = &#1610; / y = &#1610;";break;
case "y": tip = " A = &#1573;  / i = &#1610; / y = &#1610;";break;
case "z": tip = " d' = &#1584; / r' = &#1586; / R = &#1586;";break;
case "t": tip = " T = &#1591;  / T' = &#1592; / t' = &#1579;";break;
default:  tip ="";  
	}
 sl("hinweis").innerHTML=tip;
}

(function($){var textarea,staticOffset;var iLastMousePos=0;var iMin=32;var grip;$.fn.TextAreaResizer=function(){return this.each(function(){textarea=$(this).addClass('processed'),staticOffset=null;$(this).wrap('<div class="resizable-textarea"><span></span></div>').parent().append($('<div class="grippie"></div>').bind("mousedown",{el:this},startDrag));var grippie=$('div.grippie',$(this).parent())[0];grippie.style.marginRight=(grippie.offsetWidth-$(this)[0].offsetWidth)+'px'})};function startDrag(e){textarea=$(e.data.el);textarea.blur();iLastMousePos=mousePosition(e).y;staticOffset=textarea.height()-iLastMousePos;textarea.css('opacity',0.25);$(document).mousemove(performDrag).mouseup(endDrag);return false}function performDrag(e){var iThisMousePos=mousePosition(e).y;var iMousePos=staticOffset+iThisMousePos;if(iLastMousePos>=(iThisMousePos)){iMousePos-=5}iLastMousePos=iThisMousePos;iMousePos=Math.max(iMin,iMousePos);textarea.height(iMousePos+'px');if(iMousePos<iMin){endDrag(e)}return false}function endDrag(e){$(document).unbind('mousemove',performDrag).unbind('mouseup',endDrag);textarea.css('opacity',1);textarea.focus();textarea=null;staticOffset=null;iLastMousePos=0}function mousePosition(e){return{x:e.clientX+document.documentElement.scrollLeft,y:e.clientY+document.documentElement.scrollTop}}})(jQuery);

this.searchfield = function(){
	
	var suggestion = true;
	var suggestionText =""; 	
	var field = sl("sbi");	
	var jfield =$("#sbi");
	var classInactive = "sf_inactive";
	var classActive = "sf_active";
	var classText = "sf_text";
	var list=sl('liste');

	this.safari = ((parseInt(navigator.productSub)>=20020000)&&(navigator.vendor.indexOf("Apple Computer")!=-1));

	if(field && !safari){
		
		field.c = field.className;		
		field.className = field.c + " " + classInactive;
		
		field.onfocus = function(){
			this.className = this.c + " "  + classActive;  
		
			
		};
		field.onblur = function(){
			this.className = (this.value != "") ? this.c + " " +  classText : this.c + " " +  classInactive;
			clearList();
		};
		if (suggestion){
			
			var selectedIndex = 0;
			 
			field.setAttribute("autocomplete", "off");
			field.onkeypress = function(e){
				
				var key = getKeyCode(e);
			
				if(key == 13){ // enter
					selectList();						
					selectedIndex = 0;
					clearList();
					return true;
				};	
			
			};
			
			
			jfield.bind("keyup", function(e){
			
				var key = getKeyCode(e);
		
				switch(key){
				case 13:
					//sl('cse-search-box').submit();
					break;			
				case 27:  // esc
					field.value = "";
					selectedIndex = 0;
					clearList();
					break;				
				case 38: // up
					navList("up"); 
					selectList(this.i);	
					break;
				case 40: // down
					navList("down");
					selectList(this.i);						
					break;
				default:
				
					ajax();		
								
					break;
				};
			});
			
			function ajax(){	
				$.ajax({
				   type: "GET",
				   url: "/function/hole.php",
				    data: "q1="+encodeURI(field.value),
				   success: function(msg){
				   suggestionText=msg;

				   startList();
					
				   }
				});
			}
			
			this.startList = function(){
				var arr = getListItems(field.value);
				if(field.value.length > 0 && field.value.length<30){
					createList(arr);
				} else {
					clearList();
				};	
			};
			
			this.getListItems = function(value){
				var arr = new Array();
				var src = suggestionText;
				var src = src.replace(/, /g, ",");
				var arrSrc = src.split(",");
				for(i=0;i<arrSrc.length;i++){
					if(arrSrc[i].substring(0,value.length).toLowerCase() == value.toLowerCase()){
						arr.push(arrSrc[i]);
						}
				};				
				return arr;
			};
			
			this.createList = function(arr){				
				resetList();			
				if(arr.length > 0) {
					for(i=0;i<arr.length;i++){				
						li = document.createElement("li");
						a = document.createElement("a");
						a.href = "javascript:void(0);";
						a.i = i+1;
						a.innerHTML = arr[i];
						li.i = i+1;
						li.onmouseover = function(){
							navListItem(this.i);
											
						};
						a.onmousedown = function(){
							selectedIndex = this.i;
							selectList(this.i);	
							sl('cse-search-box').submit();
							clearList();
							return false;
						};					
						li.appendChild(a);
						list.setAttribute("tabindex", "-1");
						list.appendChild(li);	
					};	
					$('.sf_suggestion ul').slideDown("fast");			
				} else {
					clearList();
				};
			};	
			
			this.resetList = function(){
				var li = list.getElementsByTagName("li");
				var len = li.length;
				for(var i=0;i<len;i++){
					list.removeChild(li[0]);
				};
			};
			
			this.navList = function(dir){			
				selectedIndex += (dir == "down") ? 1 : -1;
				li = list.getElementsByTagName("li");
				if (selectedIndex < 1) selectedIndex =  li.length;
				if (selectedIndex > li.length) selectedIndex =  1;
				navListItem(selectedIndex);
			};
			
			this.navListItem = function(index){	
				selectedIndex = index;
				li = list.getElementsByTagName("li");
				for(var i=0;i<li.length;i++){
					li[i].className = (i==(selectedIndex-1)) ? "selected" : "";
				};
			};
			
			this.selectList = function(){
				li = list.getElementsByTagName("li");	
				a = li[selectedIndex-1].getElementsByTagName("a")[0];
				field.value = a.innerHTML;
			
			};			
			
		};
	};
	
	this.clearList = function(){
		if(list){ 
			$('.sf_suggestion ul').fadeOut("fast");
			selectedIndex = 0;
		};
	};		
	this.getKeyCode = function(e){
		var code;
		if (!e) var e = window.event;
		if (e.keyCode) code = e.keyCode;
		return code;
	};
	
};



jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); 
        }
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { 
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
						if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
function getSearch(){
	
	var a=sl('area').value;
	if(a.length>0 && a.length<10){
		$.get("/function/onesug.php", { q: sl('area').value },
		function(data){
		 sl('ssg').innerHTML="";
		 sl('ssg').innerHTML=data;
		 if(data!='' && data.length<65){
		 $('#to-search').fadeIn("normal");
		 } else{ $('#to-search').fadeOut("slow")}
		});
	}
	else{ 
			
			$('#to-search').fadeOut("fast"); 
			if(a.length>30){		
				$('area').unbind("click",getSearch);
				$('#area').unbind("keyup",getSearch);
			}
			
	}

} 
function toSearch(){
	sl('sbi').value=sl('ssg').firstChild.nodeValue; 
	sl('cse-search-box').submit();
}
function setArea(){		
	$("#to-search").animate({ 
		opacity: 0,
		top:'8px',
		right:'-5px'
	
	}, 300 ).hide("slow");
	sl('area').value=sl('ssg').firstChild.nodeValue+" "; 
	sl('area').focus();
}	 

$(document).ready(function() {		
		$('textarea.resizable:not(.processed)').TextAreaResizer();

		$('#nav > li').bind('mouseover', jsddm_open);
		$('#nav > li').bind('mouseout',  jsddm_timer);   
		
	
		$('#sbb').one("mouseenter",function(){
			$.ajax({
			type: "POST",
			url: "/function/suggest.php",
			data: "q="+encodeURI(sl('sbi').value)
			}); 
	
		});
		
	
		$("#sbi").bind("focus",function(){
		$(this).css({borderColor:'#55B5ED'})  
		 });
		$("#sbi").bind("blur",function(){
		$(this).css({borderColor:'#ccc'})  
		 });
		
		$('area').bind("click",getSearch);
		$('#area').bind("keyup",getSearch);
		
		$('#to-search').bind("click",setArea);
		
		if($.cookie("transMethode")=="trans"){check("trans")}
		if($.cookie("transMethode")=="virtual"){check("virtual")}
		if($.cookie("transPlus")=="sbi"){check('sbi')}
		//autosuggest
		searchfield(); 
			
});



