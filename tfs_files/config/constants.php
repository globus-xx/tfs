<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/*
|--------------------------------------------------------------------------
| Titles
|--------------------------------------------------------------------------
|
| All the static titles using in portal
|
*/
define("SITE_NAME", 			'Asian Chess Federation');
define('SUPERADMIN_TITLE',		'SuperAdministor :: '.SITE_NAME);
define('COUNTRYADMIN_TITLE',	'Country Administrator :: '.SITE_NAME);


/*
|--------------------------------------------------------------------------
| Database Tables
|--------------------------------------------------------------------------
|
| Constants for Database Tables
 * 
 * <?php
   // header("Content-Type: application/rss+xml; charset=ISO-8859-1");
 
    DEFINE ('DB_USER', 'root');   
    DEFINE ('DB_PASSWORD', '');   
    DEFINE ('DB_HOST', 'localhost');   
    DEFINE ('DB_NAME', 'acf-new'); 
 
   $rssfeed  ="header('Content-Type: application/rss+xml; charset=ISO-8859-1') ";   
   $rssfeed  = '<rss version="2.0">';
   $rssfeed .= '<channel>';
   
    $rssfeed .= '<title>News Feed</title>';
    $rssfeed .= '<link>dsffd</link>';
    $rssfeed .= '<description>Welcome</description>';
    $rssfeed .= '<pubDate>date of publish</pubDate>';
    $rssfeed .= '<image><url>http://www.alainchess.com/acf/images/news/1358173824_chess2r.jpg</url><title>W3Schools.com</title><link>http://www.w3schools.com</link></image>';
    
    
 
    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to database');
    mysql_select_db(DB_NAME)
        or die ('Could not select database');
 
    $query = "SELECT * FROM acf_news  ORDER BY date_added DESC LIMIT 10";
    $result = mysql_query($query) or die ("Could not execute query");
 
    while($row = mysql_fetch_array($result)) {
//        extract($row);                        
 
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $row['title'] . '</title>';
        $rssfeed .= '<description>' . $row['content'] . '</description>';
        
        $rssfeed .= '<imglink>http://www.alainchess.com/acf/images/news/1358173824_chess2r.jpg</imglink>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s ", strtotime($row['date_added'])) . '</pubDate>';
        $rssfeed .= '</item>';
        
        $rssfeed .= '<image><url>http://www.alainchess.com/acf/images/news/1358173824_chess2r.jpg</url><title>W3Schools.com</title><link>http://www.w3schools.com</link></image>';
    }
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    //echo $rssfeed;
    
   
$xmlobj=new SimpleXMLElement($rssfeed);
$xmlobj->asXML("feed/".date("m.d.y").".xml");





?>
 * 
 * 
 * 
 * 
 * 
 * 
 * 
|
*/
define("PREFIX", 		 "acf_");
define("PREFIX_TBL", 		 "tbl_");
define("PREFIX2", 		 "trychess_");
define("USER_CHATS", 	 PREFIX.'user_chat');
define("USERS",			 PREFIX.'users');


define("COMPANY",	 PREFIX_TBL.'company');
define("USERSPROFILE",	 PREFIX.'users_profile');
define("USERFRIENDS",	 PREFIX.'user_friends');
define("WORLDCOUNTRIES", 'world_countries');
define("WORLDCITIES", 	 'world_cities');
define("COUNTRIES",		 PREFIX.'member_countries');
define("TOPPLAYERS",	 PREFIX.'topplayers');
define("HEADERSLIDERS",	 PREFIX.'header_sliders');
define("NEWS",			 PREFIX.'news');
define("NEWSCATEGORIES", PREFIX.'news_categories');
define("ARTICLES",		 PREFIX.'articles');
define("EVENTS",	 	 PREFIX.'events');
define("TOURNAMENTS",	 PREFIX.'tournaments');
define("PAGECONTENT",	 PREFIX.'content_pages');
define("GALLERIES",	 	 PREFIX.'galleries');
define("GALLERYIMAGES",	 PREFIX.'gallery_images');
define("VIDEOS",	 	 PREFIX.'gallery_videos');
define("GAME",	 	 	 PREFIX.'games');
define("GAMES",	 	 	 PREFIX2.'game');
define("FIELD",	 	 	 PREFIX2.'field');

define("TAGS",	 	 	 PREFIX.'tags');
define("TAGSRELATIONS",	 PREFIX.'tags_relations');

define("GALLERYCOMMENTS",PREFIX.'user_gallery_comments');

define("MENUS",	 PREFIX.'submenus');
define("COMPANIES",	PREFIX.'companies');

define("VIDEOCOMMENTS",	 PREFIX.'user_video_comments');

define("MESSAGES",	 	 PREFIX.'user_messages');

define("LEARNINGVIDEOS", 	PREFIX.'learning_videos');
define("LEARNINGVIDEOSCAT",	PREFIX.'learning_videos_categories');


/*
|--------------------------------------------------------------------------
| Directories
|--------------------------------------------------------------------------
|
| Directories
|
*/
define("SUPERADMINFOLDER", 	"superadmin");
define("ADMINFOLDER", 		"admincontrol");
define("IMAGES",			"images");
define("CSS", 				"css");
define("CSSADMIN", 			CSS."/admin");



/* End of file constants.php */
/* Location: ./application/config/constants.php */