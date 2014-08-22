<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
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

<h2><?php echo _e('Add New Event','viavi-wp-timeline'); ?></h2>

    <form id="form_gonder" action="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=NewEventPost" method="post">
    	
        <table>
        	<tr>
            	<td>
                    <h3><?php echo _e('Event Title','viavi-wp-timeline'); ?></h3>
                    <input type="text" name="event_title" size="40"/>                
                </td>
            </tr>
            <tr>
            	<td>
                <h3><?php echo _e('Timeline Name','viavi-wp-timeline'); ?></h3>
                <select name="group_id" style="width:100%;">
                    <option><?php echo _e('Select Timeline...','viavi-wp-timeline'); ?></option>
                    <?php
                        $group_list=mysql_query('SELECT group_id,title FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="group_name" ORDER BY title ASC');
                        while($group_row=mysql_fetch_array($group_list)){
                            ?>
                            <option value="<?php echo $group_row['group_id']; ?>"><?php echo $group_row['title']; ?></option>
                            <?php
                        }
                    ?>
                </select>                
                </td>            
            </tr>
        </table>
        
        <table width="100%">
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
                    <input type="text" class="WordPressDate" name="event_date" size="1" />
					<?php echo _e('Year','viavi-wp-timeline'); ?>
                    <input type="text" class="WordPressDateYear" name="event_date_year" size="4" value=""/>
					<?php echo _e('Month','viavi-wp-timeline'); ?>
                    <input type="text" class="WordPressDateMonth" name="event_date_month" size="2" value=""/>
					<?php echo _e('Day','viavi-wp-timeline'); ?>
                    <input type="text" class="WordPressDateDay" name="event_date_day" size="2" value=""/>                
                	<?php echo _e('Time', 'viavi-wp-timeline'); ?>
                    <input type="text" name="event_time" id="EventTime" size="10" maxlength="8" />
					<p><small><?php echo _e('If you want you can also add time. [ ! ] e.g.: 14:30:45 [Hour-Minute-Second]','viavi-wp-timeline'); ?></small></p>
                </td>
                <td>
                    <input type="text" name="event_bc" id="event_bc_input" size="40"/>
                    <p><small><?php echo _e('[ ! ] e.g.: 2000','viavi-wp-timeline'); ?></small></p>
                </td>
            </tr>        
        </table>
		<?php wp_editor('','event_content',$settings = array('textarea_rows'=> 10 ,'wpautop' => false));?>
        <br />
        <input type="submit" value="<?php echo _e('Add Event','viavi-wp-timeline'); ?>" class="button" id="gonder_button"/>
        
    </form>

</div>