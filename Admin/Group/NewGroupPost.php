<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
if (!empty($_POST)){

    $title=mysql_real_escape_string(trim(stripslashes($_POST['group_name'])));

    if(empty($title)){

        ?>
        <p class="WordPress_hata"><?php echo _e('Do not leave empty fields.','viavi-wordpress-timeline'); ?></p>
        <?php

    }else{

        @$last_group_id=mysql_fetch_array(mysql_query('SELECT group_id FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline ORDER BY group_id DESC LIMIT 0,1'));
        $group_id=(int)@$last_group_id['group_id'] + 1;
        
        $sql=mysql_query('insert into '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline (group_id,title,type,timeline_bc,timeline_date,event_content) values ("'.$group_id.'","'.$title.'","group_name","0","0000-00-00 00:00:00",null) ');

        if ($sql){
            ?>
            <p class="WordPress_ok"><?php echo _e('The Timeline has successfully added.','viavi-wordpress-timeline'); ?></p>
            <?php
        }else{
            ?>
            <p class="WordPress_hata"><?php echo _e('An error occurred while adding timeline.','viavi-wordpress-timeline'); ?></p>
            <?php
        }      
    }
}
?>