<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<div class="viavi-content">

<h2><?php echo _e('Timeline List','viavi-wordpress-timeline'); ?></h2>

<?php

/* Start */
$page=@$_GET['is_page'];
(int)$page_limit=get_option('WordPressTimelinePageLimit');

$group_say=mysql_fetch_assoc(mysql_query('SELECT COUNT(group_id) FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="group_name"'));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}

$toplam_sayfa=(int)$group_say['COUNT(group_id)'];
$baslangic=($baslangic-1)*$page_limit;

$group_list=mysql_query('SELECT group_id,title FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="group_name" ORDER BY group_id DESC LIMIT '.$baslangic.','.$page_limit);

if($toplam_sayfa > 0){
    ?>
       
    <table width="100%" class="WordPresswptablestd">
        <tr>
            <th><?php echo _e('Timeline ID','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Timeline Name','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Edit','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Delete','viavi-wordpress-timeline'); ?></th>
        </tr>
        <?php
        while ($group_name=mysql_fetch_assoc($group_list)){
        ?>
        <tr>
            <td><?php echo $group_name['group_id']; ?></td>
            <td><?php echo $group_name['title']; ?></td>
            <td>
                <a href="<?php echo admin_url().'admin.php?page=viavi-wordpress-timeline/index.php'; ?>&isvav=EditGroupForm&group_id=<?php echo $group_name['group_id']; ?>"><img style="width: 20px" src="<?php echo plugins_url('/viavi-wordpress-timeline/images/edit.png',1); ?>" /></a>
            </td>
            <td>
                <a onclick="return confirm('<?php echo _e('Events belonging to the timeline will also be deleted. Are you sure you want to delete this timeline?','viavi-wordpress-timeline'); ?>')" href="<?php echo admin_url().'admin.php?page=viavi-wordpress-timeline/index.php'; ?>&isvav=DeleteGroupPost&group_id=<?php echo $group_name['group_id']; ?>"><img style="width: 20px" src="<?php echo plugins_url('/viavi-wordpress-timeline/images/delete.png',1); ?>" /></a>
            </td>            

        </tr>
        <?php
        }

        ?>
    </table>

    <?php            

        
        WordPressTimelineSayfala(admin_url().'admin.php?page=viavi-wordpress-timeline/index.php',$toplam_sayfa,$page,$page_limit,'&isvav=GroupList');

}else{
    // Söz yok ise uyarı mesajı ver.
    ?>
    <p class="WordPress_hata"><?php echo _e('You have not added any group :(','viavi-wordpress-timeline'); ?></p>
    <?php
}
?>
</div>