<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
$event_id=(int)$_GET['event_id'];

$event=mysql_fetch_array(mysql_query('SELECT * FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE event_id='.$event_id.' AND type="event" '));


$exp_date=explode(' ',$event['timeline_date']);


// event_date Value
if ($exp_date[0] == '0000-00-00'){
    $event_date_val='';
}else{
    $event_date_val=explode('-',$exp_date[0]);
    
    if ($event_date_val[0]=='0000'){ $event_date_val[0]=''; }
    if ($event_date_val[1]=='00'){ $event_date_val[1]=''; }
    if ($event_date_val[2]=='00'){ $event_date_val[2]=''; }
}


// event_time Value
if($exp_date[1]=='00:00:00'){
    $event_time_val='';
}else{
    $event_time_val=$exp_date[1];
}


// event_bc Value
if(empty($event['timeline_bc'])){
    $event_bc_val='';
}else{
    $event_bc_val=$event['timeline_bc'];
}





?>
<?php
function ShowTinyMCE() {
    // conditions here
    wp_enqueue_script( 'common' );
    wp_enqueue_script( 'jquery-color' );
    wp_print_scripts('editor');
    if (function_exists('add_thickbox')) add_thickbox();
    wp_print_scripts('media-upload');
    if (function_exists('wp_tiny_mce')) wp_tiny_mce();
    wp_admin_css();
    wp_enqueue_script('utils');
    do_action("admin_print_styles-post-php");
    do_action('admin_print_styles');
}
add_filter('admin_head','ShowTinyMCE');

wp_register_style( 'WordPressTimelineJqueryUiCss', plugins_url().'/viavi-wp-timeline/Admin/Css/smoothness/jquery-ui-1.10.3.custom.min.css',array(),'','screen' );
wp_enqueue_style( 'WordPressTimelineJqueryUiCss' );

?>
<div class="viavi-content">
<h2><?php echo _e('Edit Event','viavi-wp-timeline'); ?></h2>


    <form id="form_gonder" action="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=EditEventPost" method="post">
    
    <table>
    	<tr>
        	<td>
            <h3><?php echo _e('Event Title','viavi-wp-timeline'); ?></h3>
            <input type="text" name="event_title" size="40" value="<?php echo $event['title']; ?>"/>            
            </td>
        	<td>
            <h3><?php echo _e('Timeline Name','viavi-wp-timeline'); ?></h3>
            <select name="group_id">
                <option><?php echo _e('Select Timeline...','viavi-wp-timeline'); ?></option>
                <?php
                    $group_list=mysql_query('SELECT group_id,title FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="group_name" ORDER BY title ASC');
                    while($group_row=mysql_fetch_array($group_list)){
                        ?>
                        <option value="<?php echo $group_row['group_id']; ?>" <?php if($event['group_id']==$group_row['group_id']){ echo 'selected="selected"'; } ?>><?php echo $group_row['title']; ?></option>
                        <?php
                    }
                ?>
            </select>            
            </td>
        </tr>
    </table>
        
	<table>
    	<tr>
        	<td>
            <h3><?php echo _e('Event Time (If Anno Domini)','viavi-wp-timeline'); ?></h3>
            </td>
            <td>
            <h3><?php echo _e('Event Time (If Before Christ)','viavi-wp-timeline'); ?></h3>
            </td>
        </tr>
        <tr>
        	<td>
            <!--<input type="text" id="MyDate" name="event_date" size="40" value="<?php echo $event_date_val; ?>"/> <?php echo _e('[ ! ] e.g.: 2010-01-30 [Year-Month-Day]','viavi-wp-timeline'); ?>-->
                    
            <input type="text" class="WordPressDate" name="event_date" size="1" />
                        
            <?php echo _e('Year','viavi-wp-timeline'); ?>
            <input type="text" class="WordPressDateYear" name="event_date_year" size="4" value="<?php echo $event_date_val[0]; ?>"/>
                        
            <?php echo _e('Month','viavi-wp-timeline'); ?>
            <input type="text" class="WordPressDateMonth" name="event_date_month" size="2" value="<?php echo $event_date_val[1]; ?>"/>
                        
            <?php echo _e('Day','viavi-wp-timeline'); ?>
            <input type="text" class="WordPressDateDay" name="event_date_day" size="2" value="<?php echo $event_date_val[2]; ?>"/>
                    
            <input type="text" name="event_time" id="EventTime" size="10" maxlength="8" value="<?php echo $event_time_val; ?>"/>
			<p><small><?php echo _e('If you want you can also add time. [ ! ] e.g.: 14:30:45 [Hour-Minute-Second]','viavi-wp-timeline'); ?></small></p>
            </td>
            <td>
            <input type="text" name="event_bc" size="40" id="event_bc_input" value="<?php echo ltrim($event_bc_val,'-'); ?>"/>
			<p><small><?php echo _e('[ ! ] e.g.: 2000','viavi-wp-timeline'); ?></small></p>
            </td>
        </tr>
    </table>
	<?php wp_editor($event['event_content'],'event_content',$settings = array('textarea_rows'=> 20 ,'wpautop' => false));?>
    <br />
        <input type="hidden" value="<?php echo $event['event_id']; ?>" name="event_id" />
        <input type="submit" value="<?php echo _e('Update Event','viavi-wp-timeline'); ?>" class="button" id="gonder_button"/>
        
    </form>
</div>