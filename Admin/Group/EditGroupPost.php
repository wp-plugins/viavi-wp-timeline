<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_POST)){

    $id=mysql_real_escape_string(trim(stripslashes($_POST['group_id'])));
    $title=mysql_real_escape_string(trim(stripslashes($_POST['group_name'])));

    if( empty($title) || empty($id) ){
        ?>
        <p class="WordPress_hata"><?php echo _e('Do not leave empty fields.','viavi-wp-timeline'); ?></p>
        <?php
    }else{

        $sql=mysql_query('UPDATE '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline SET title="'.$title.'" WHERE group_id="'.$id.'" AND type="group_name" ');

        if ($sql){
            ?>
            <p class="WordPress_ok"><?php echo _e('Timeline successfully updated.','viavi-wp-timeline'); ?></p>
            <?php
        }else{
            ?>
            <p class="WordPress_hata"><?php echo _e('An error occurred while updating the timeline.','viavi-wp-timeline'); ?></p>
            <?php
        }                
    }
}
?>