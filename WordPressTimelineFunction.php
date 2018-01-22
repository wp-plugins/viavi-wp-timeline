<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Your Access to this file is Denied.'; exit(); } ?>
<?php
function WordPress_Timeline_Kurulum()
{
    global $wpdb;
    
    // Create Database
    $create_table = WordPress_WP_TIMELINE_DB_PREFIX . 'WordPress_Timeline';
  

     // Tables...
    $table_list_array=array();
    
    $sql = "SHOW TABLES LIKE '%'";
    $results = $wpdb->get_results($sql);
    
    foreach($results as $index => $value) {
        foreach($value as $tableName) {
            $table_list_array[] = $tableName;
        }
    }

    
    // Tables
    if (in_array('WordPress_Timeline',$table_list_array)){
        // Tablo var
    }else{
        // SQL 
        $db_sql="CREATE TABLE IF NOT EXISTS `$create_table` (
        `event_id` bigint(20) NOT NULL AUTO_INCREMENT,
        `group_id` smallint(6) NOT NULL DEFAULT '0',
        `timeline_bc` bigint(20) DEFAULT '0',
        `timeline_date` datetime DEFAULT '0000-00-00 00:00:00',
        `title` varchar(255) DEFAULT NULL,
        `event_content` mediumtext,
        `type` enum('event','group_name') NOT NULL DEFAULT 'event' COMMENT 'grup adları almak için group_name listele, diğerleri event olacaktır.',
        PRIMARY KEY (`event_id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;
        ";
        $wpdb->query( $db_sql );
    }  
    

    // Settring Meta Exit
    if (get_option('WordPressTimelinePageLimit') == false ){
        add_option('WordPressTimelinePageLimit', '10');
    }

}



function WordPress_Timeline_Admin_Head()
{
    /* Wp Admin Head */
    
    load_plugin_textdomain('viavi-wp-timeline', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
     
    wp_enqueue_script('jquery');
    
    wp_register_script('WordPressTimelineAdminJs', plugins_url().'/viavi-wp-timeline/Admin/WordPressTimelineAdmin.js', array( 'jquery' ));
    wp_enqueue_script('WordPressTimelineAdminJs');
    
    /* Start Add Js Variables */
    $JsData = array('pluginUrl' => plugins_url().'/viavi-wp-timeline/' );
    wp_localize_script('WordPressTimelineAdminJs', 'WordPressTimelineJsData', $JsData);
    /* End Add Js Variables */
    
    wp_register_style( 'WordPressTimelineAdminCss', plugins_url().'/viavi-wp-timeline/Admin/WordPressTimelineAdmin.css',array(),'','screen' );
    wp_enqueue_style( 'WordPressTimelineAdminCss' );
    
    if (@$_GET['isvav']=='NewEventForm' || @$_GET['isvav']=='EditEventForm'){
        wp_enqueue_script('jquery-ui-datepicker');
        wp_register_script('WordPressTimelineAdminEventJs', plugins_url().'/viavi-wp-timeline/Admin/Js/WordPressTimelineAdminEventJs.js', array( 'jquery' ));
        wp_enqueue_script('WordPressTimelineAdminEventJs');   
    }
}



function WordPress_Timeline_Head()
{
    /* Wp User Head */
    load_plugin_textdomain('viavi-wp-timeline', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
    
    /* JS */
    wp_enqueue_script('jquery');
    
    wp_register_script('timelinerColorboxJs', plugins_url().'/viavi-wp-timeline/TimelineJquery/inc/colorbox.js', array( 'timelinerTimelinerJs' ));
    wp_enqueue_script('timelinerColorboxJs');
    
    wp_register_script( 'timelinerTimelinerJs', plugins_url().'/viavi-wp-timeline/TimelineJquery/js/timeline.min.js', array( 'jquery' ));
    $translation_array = array( 'ExpandAll' => __('+ Expand All','viavi-wp-timeline'), 'CollapseAll' => __('- Collapse All','viavi-wp-timeline') );
    wp_localize_script( 'timelinerTimelinerJs', 'timelinerTimelinerJsObject', $translation_array );
    wp_enqueue_script('timelinerTimelinerJs');
    
    
    
    /* CSS */
    wp_register_style( 'timelinerColorboxCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/inc/colorbox.css',array(),'','screen' );
    wp_enqueue_style( 'timelinerColorboxCss' );
    
   	if(get_option('WordPress_TL_style')=="WordPress_style1")
		{
	  wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/style1.css',array(),'','screen' );
		}
		else if(get_option('WordPress_TL_style')=="WordPress_style2")
		{
	  wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/style2.css',array(),'','screen' );
		}
		else if(get_option('WordPress_TL_style')=="WordPress_style3")
		{
	  wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/style3.css',array(),'','screen' );
		}
		else if(get_option('WordPress_TL_style')=="WordPress_style4")
		{
	  wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/style4.css',array(),'','screen' );
		}
		else if(get_option('WordPress_TL_style')=="WordPress_style5")
		{
	  wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/style5.css',array(),'','screen' );
		}
		else
		{
			wp_register_style( 'timelinerScreenCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/screen.css',array(),'','screen' );
		}
	  wp_enqueue_style( 'timelinerScreenCss' );
    
    wp_register_style( 'timelinerResponsiveCss', plugins_url().'/viavi-wp-timeline/TimelineJquery/css/responsive.css',array(),'','screen' );
    wp_enqueue_style( 'timelinerResponsiveCss' );
    
}
 


function WordPress_Timeline_Admin()
{
    /* Admin Menü */
    add_menu_page( 'Viavi WordPress Timeline', 'Viavi Timeline', '5', 'viavi-wp-timeline/index.php', 'WordPress_Timeline_Index', plugins_url('viavi-wp-timeline/images/viavi-wp-timeline-icon.png'), 8 );
		 
    //load_plugin_textdomain('viavi-wp-timeline', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
}
 
add_action('admin_init', 'WordPress_register_fields' );
function WordPress_register_fields(){
	
	 
	register_setting( 'WordPress-fields', 'WordPress_TL_style' );
	 
}

if( function_exists('register_uninstall_hook') ){

	register_uninstall_hook(__FILE__,'WordPress_fields_uninstall');			
}

function WordPress_fields_uninstall(){ 

	delete_option('WordPress_TL_style');
	
	 
}

 
function WordPressTimelineDateTitle($mysqlDateTime)
{

    $explTime=explode(' ',$mysqlDateTime);
    // $explTime[0] // 2012-12-12
    // $explTime[1] // 00:00:00

    $explDate=explode('-',$explTime[0]);
    // $explDate[0] // Year
    // $explDate[1] // Month
    // $explDate[2] // Day	

    $WordPressTimelineDate='';

    if($explDate[0] > 0){
        $WordPressTimelineDate.=$explDate[0];
        if($explDate[1] > 0){
            $WordPressTimelineDate.='.'.$explDate[1];
            if($explDate[2] > 0){
                $WordPressTimelineDate.='.'.$explDate[2];
                if($explTime[1] != '00:00:00'){
                    $WordPressTimelineDate.=' '.$explTime[1];
                }
            }
        }
    }

    return $WordPressTimelineDate;
}



function WordPressTimelineGetYear($mysqlDateTime){
    
    $explDate=explode('-',$mysqlDateTime,2);
    return $explDate[0];
}



function WordPressTimelineShortCodeOutput( $atts ) {

    global $wpdb;
    
    /*
     * If you are in the same year, if you have a few events of the year, add into the ...
     * 
     */
    
    //echo _e('Hepsini_Ac','viavi-wp-timeline');
    
    
    $group_id=$atts['timelineid'];

    $WordPressTimelineEndSqlYear='';
    $WordPressTimelineOut='<div id="timelineContainer" unselectable="on">';
   // $WordPressTimelineOut.='<a class="expandAll">'.__('+ Expand All','viavi-wp-timeline').'</a><br/>';

    $WordPressSay=true;
       
	$sql_group= $wpdb->get_results('SELECT * FROM wp_WordPress_Timeline WHERE group_id="'.$group_id.'" AND type="event" ORDER BY timeline_bc ASC, timeline_date ASC ');
    
    
    
    foreach($sql_group as $key => $post){

        if ($post->timeline_bc < 0 ){
            $WordPressYear=$post->timeline_bc;
        }elseif( WordPressTimelineGetYear($post->timeline_date ) > 0 ){
            // Only Year
            $WordPressYear=WordPressTimelineGetYear($post->timeline_date);
        }
        
        if ($WordPressYear==$WordPressTimelineEndSqlYear){
            
            // Add into the year
            $WordPressTimelineOut.='
                <dl class="timelineMinor">
                    <dt id="event'.$post->event_id.'"><a>'.$post->title.'</a></dt>
                    <dd class="timelineEvent" id="event'.$post->event_id.'EX" style="display: none; ">
                        <div class="event_content">';
                            
                            // Date details
                            if($WordPressYear > 0){
                                $WordPressTimelineOut.='<span class="WordPressDate">'.WordPressTimelineDateTitle($post->timeline_date).'</span>';
                            }
                            $WordPressTimelineOut.='<div class="timeline-content">'.$post->event_content.'</div></div><!-- event_content -->
                    </dd><!-- /.timelineEvent -->
                </dl><!-- /.timelineMinor -->';
        }else{
            
            // How to survive the first cycle ...
            if ($WordPressSay != true){
                $WordPressTimelineOut.='</div><!-- /.timelineMajor -->';
            }
            
            // Add a new year, the major ...
            
						if($key%2==0)
						{
							$WordPressTimelineOut.='
							<div class="timelineMajor right" id="'.$key.'">';
            
						}
						else
						{
							$WordPressTimelineOut.='
            	<div class="timelineMajor left" id="'.$key.'">';
						}
						
						$WordPressTimelineOut.='   <h2 class="timelineMajorMarker"><span>';
            
            if($WordPressYear < 0){ $WordPressTimelineOut.=__('BC','viavi-wp-timeline').' '.ltrim($WordPressYear,'-'); }else{ $WordPressTimelineOut.=(int)$WordPressYear; }
            
            $WordPressTimelineOut.='</span></h2>
            
                <dl class="timelineMinor">
                    <dt id="event'.$post->event_id.'"><a>'.$post->title.'</a></dt>
                    <dd class="timelineEvent" id="event'.$post->event_id.'EX" style="display: none; ">
                        <div class="event_content">';
            
                            // Date details
                            if($WordPressYear > 0){
                                $WordPressTimelineOut.='<span class="WordPressDate">'.WordPressTimelineDateTitle($post->timeline_date).'</span>';
                            }
                            
                        $WordPressTimelineOut.='<div class="timeline-content">'.$post->event_content.'</div></div><!-- event_content -->
                    </dd><!-- /.timelineEvent -->
                </dl><!-- /.timelineMinor -->';
            
        }
        
        $WordPressTimelineEndSqlYear=$WordPressYear;
        
        $WordPressSay=false;
				 

    } // Foreach
    $WordPressTimelineOut.='</div><!-- /.timelineMajor -->';
    $WordPressTimelineOut.='</div><!-- /#timelineContainer -->';
    return $WordPressTimelineOut;
}


$pageslang=__('Pages','viavi-wp-timeline');

function WordPressTimelineSayfala($site_url,$top_sayfa,$page,$limit,$page_url)
{
    // our paging strip

    if($top_sayfa > $limit) :

        
        
        echo '<div id="sayfala"><span class="say_sabit">'.__('Pages','viavi-wp-timeline').'</span>';

        $x=5; // Active from page next / previous page impressions number of
        $lastP=ceil($top_sayfa / $limit);

        // Print this page 1
        if($page == 1){
            echo '<span class="say_aktif">1</span>';
        }else{
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'">1</a>';
        }

        // "..." or direct 2
        if($page - $x > 2){
            echo '<span class="say_b">...</span>';
            $i=$page - $x;
        }else{
            $i=2;
        }
        // +/- $x Print pages
        for($i; $i <= $page + $x; $i++){
            if($i == $page)
                echo '<span class="say_aktif">'.$i.'</span>';
            else
                echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$i.'">'.$i.'</a>';
            if($i == $lastP)
                break;
        }

        // "..." or last page
        if($page + $x < $lastP - 1){
            echo '<span class="say_b">...</span>';
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
        }elseif($page + $x == $lastP - 1){
            echo '<a class="say_a" href="'.$site_url.''.$page_url.'&is_page='.$lastP.'">'.$lastP.'</a>';
        }
        echo '</div>';//#to page
    endif;
}
    
    
class WordPressTimelineAddEditorButton{

    public function __construct()
    {
        add_action('admin_init',array($this,'action_admin_init'));
    }



    public function action_admin_init()
    {
        // only hook up these filters if we're in the admin panel, and the current user has permission
        // to edit posts and pages
        if(current_user_can('edit_posts') && current_user_can('edit_pages')){
            
            global $wp_version;

            if (version_compare($wp_version,'3.9','<')){

                // Old TinyMce 3.0
                add_filter('mce_buttons',array($this,'filter_mce_button')); // < WP 3.9
                add_filter('mce_external_plugins',array($this,'filter_mce_plugin')); // < WP 3.9
            }else{

                // New TinyMce 4.0
                add_filter( 'mce_external_plugins', array($this,'my_add_tinymce_plugin') );
                add_filter( 'mce_buttons', array($this,'my_register_mce_button') );

            }

        }
    }



    public function filter_mce_button($buttons)
    {
        // add a separation before our button, here our button's id is "mygallery_button"
        array_push($buttons,'|','mygallery_button');
        return $buttons;
    }



    public function filter_mce_plugin($plugins)
    {
        
        // this plugin file will work the magic of our button
        
        if (WPLANG == 'tr_TR'){
            $plugins['mygallery']=plugins_url().'/viavi-wp-timeline/Admin/EditorButton/EditorButton-tr_TR.js';
        }else{
            $plugins['mygallery']=plugins_url().'/viavi-wp-timeline/Admin/EditorButton/EditorButton-en_US.js';
        }
        return $plugins;
    }

    // Declare script for new button
    public function my_add_tinymce_plugin( $plugin_array ) {
            $plugin_array['my_mce_button'] = plugins_url().'/viavi-wp-timeline/Admin/EditorButton/EditorButtonTinyMce4.0.js';
            //$plugin_array['my_mce_button'] = plugins_url().'/viavi-wp-timeline/Admin/EditorButton/EditorButton-tr_TR.js';
            return $plugin_array;
    }

    // Register new button in the editor
    public function my_register_mce_button( $buttons ) {
            array_push( $buttons, 'my_mce_button' );
            return $buttons;
    }
    
    
}

?>