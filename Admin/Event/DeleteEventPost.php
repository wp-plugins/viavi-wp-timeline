<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_GET)){

    (int)$id=mysql_real_escape_string(trim(stripslashes($_GET['event_id'])));

    if( empty($id) ){
    ?>
        <p class="WordPress_hata"><?php echo _e('An error has occurred.','viavi-wordpress-timeline'); ?></p>
    <?php
    }else{

        $sql=mysql_query('DELETE FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE event_id="'.$id.'" AND type="event" ');

        if ($sql){
            ?>
            <p class="WordPress_ok"><?php echo _e('Event deleted successfully.','viavi-wordpress-timeline'); ?></p>
            <?php
        }else{
            ?>
            <p class="WordPress_hata"><?php echo _e('An error occurred while deleting this event.','viavi-wordpress-timeline'); ?></p>
            <?php
        }                
    }
}
?>