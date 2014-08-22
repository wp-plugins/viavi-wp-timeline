<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_GET)){

    (int)$id=mysql_real_escape_string(trim(stripslashes($_GET['group_id'])));

    if( empty($id) ){
    ?>
        <p class="WordPress_hata"><?php echo _e('An error has occurred.','viavi-wordpress-timeline'); ?></p>
    <?php
    }else{

        $sql=mysql_query('DELETE FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE group_id="'.$id.'"');

        if ($sql){
            ?>
            <p class="WordPress_ok"><?php echo _e('Timeline deleted successfully.','viavi-wordpress-timeline'); ?></p>
            <?php
        }else{
            ?>
            <p class="WordPress_hata"><?php echo _e('An error occurred while deleting the timeline.','viavi-wordpress-timeline'); ?></p>
            <?php
        }                
    }
}
?>