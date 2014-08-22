<?php
/*
    Plugin Name: Viavi WordPress Timeline
    Description: A Viavi WordPress Timeline plugin that allows you to make a timeline about anything.
		Plugin URI: http://viaviweb.com		
    Version: 1.0
		Author URI: http://viaviweb.com
		Author: viaviwebtech
		License: GPLv2 or later
*/
 

define('WordPress_WP_TIMELINE_KONTROL',true);

global $wpdb;
define('WordPress_WP_TIMELINE_DB_PREFIX',$wpdb->prefix);

require_once 'WordPressTimelineFunction.php';


/*
 *  OPTION LIST
 * 
 *  get_option('WordPressTimelinePageLimit')  // Sayfa listeleme limiti
 * 
 */


if ( isset($_GET['activate']) && @$_GET['activate'] == 'true' )
{
    // Eğer kullanıcı "Etkinleştir" bağlantısına tıkladıysa, fonksiyonunu çağır
    /* Kurulum */
    add_action('init', 'WordPress_Timeline_Kurulum');
}



if (!is_admin()) {
    // Wp User Head
    
    add_action('wp_enqueue_scripts', 'WordPress_Timeline_Head');
    
    add_shortcode( 'ViaviWordPressTimeline', 'WordPressTimelineShortCodeOutput' );
    
}else{
    /* Wp Admin Head */
    add_action('admin_enqueue_scripts', 'WordPress_Timeline_Admin_Head');
    
    // Admin Panel - Yonetim Paneli Olustur
    add_action('admin_menu', 'WordPress_Timeline_Admin');    
    
    // Add Editor Button Short Code
    new WordPressTimelineAddEditorButton();
} 


function WordPress_Timeline_Index(){   //WordPress_index
    
    
    

    
    
    require_once 'header.php';

    
    /*      A C T I O N S     */
    
	
    
    /* Group Actions */
    if      (@$_GET['isvav']=='NewGroupForm'){
        require_once 'Admin/Group/NewGroupForm.php';
        
    }elseif (@$_GET['isvav']=='NewGroupPost'){
        require_once 'Admin/Group/NewGroupPost.php';
        
    }elseif (@$_GET['isvav']=='EditGroupForm'){
        require_once 'Admin/Group/EditGroupForm.php';
        
    }elseif (@$_GET['isvav']=='EditGroupPost'){
        require_once 'Admin/Group/EditGroupPost.php';
        
    }elseif (@$_GET['isvav']=='DeleteGroupPost'){
        require_once 'Admin/Group/DeleteGroupPost.php';        

        
        
    /* Event Actions */
    }elseif (@$_GET['isvav'] == 'EventList'){
        require_once 'Admin/Event/EventList.php';
        
    }elseif (@$_GET['isvav']=='NewEventForm'){
        require_once 'Admin/Event/NewEventForm.php';
            
    }elseif (@$_GET['isvav']=='NewEventPost'){
        require_once 'Admin/Event/NewEventPost.php';

    }elseif (@$_GET['isvav']=='EditEventForm'){
        require_once 'Admin/Event/EditEventForm.php';
        
    }elseif (@$_GET['isvav']=='EditEventPost'){
        require_once 'Admin/Event/EditEventPost.php';
        
    }elseif (@$_GET['isvav']=='DeleteEventPost'){
        require_once 'Admin/Event/DeleteEventPost.php';
    
		/* Style */    
		 }elseif (@$_GET['isvav']=='NewStyleSelect'){
        require_once 'Admin/Style/Select_Style.php';
		
		/* HelpFile */    
		 }elseif (@$_GET['isvav']=='HelpFile'){
        require_once 'Admin/Help.php';
    /* Anasyafa */
    }else{
        require_once 'Admin/Group/GroupList.php';
    }

    
    require_once 'footer.php';
}
?>