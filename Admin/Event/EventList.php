<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<div class="viavi-content">
<h2><?php echo _e('Timeline Event List','viavi-wordpress-timeline'); ?></h2>
<?php

/* Sayfalama İçin */
$page=@$_GET['is_page'];
(int)$page_limit=get_option('WordPressTimelinePageLimit');

$group_say=mysql_fetch_assoc(mysql_query('SELECT COUNT(event_id) FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="event" '));

if(empty($page) || !is_numeric($page)){
    $baslangic=1;
    $page=1;
}else{
    $baslangic=$page;
}

$groupDb=array();
$grouplist=mysql_query('SELECT group_id,title FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="group_name"');
while($group=mysql_fetch_array($grouplist)){
    $groupDb[$group['group_id']]=$group['title'];
}

$toplam_sayfa=(int)$group_say['COUNT(event_id)'];
$baslangic=($baslangic-1)*$page_limit;

$event_list=mysql_query('SELECT event_id,group_id,title,timeline_bc,timeline_date FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE type="event" ORDER BY event_id DESC LIMIT '.$baslangic.','.$page_limit);

if($toplam_sayfa > 0){
    ?>
    <table class="WordPresswptablestd" width="100%">
        <tr>
            <th><?php echo _e('Event ID','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Timeline Name','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Event Title','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Event Time','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Edit','viavi-wordpress-timeline'); ?></th>
            <th><?php echo _e('Delete','viavi-wordpress-timeline'); ?></th>
        </tr>
        <?php
        while ($event=mysql_fetch_assoc($event_list)){
        ?>
        <tr>
            <td><?php echo $event['event_id']; ?></td>
            <td><?php echo $groupDb[$event['group_id']]; ?></td>
            <td><?php echo $event['title']; ?></td>
            <td>
                <?php 
                if ($event['timeline_bc'] > 0 ){
                    echo 'M.Ö. '.$event['timeline_bc'];
                }else{
                    echo $event['timeline_date'];
                }
                ?>
            </td>
            <td>
                <a href="<?php echo admin_url().'admin.php?page=viavi-wordpress-timeline/index.php'; ?>&isvav=EditEventForm&event_id=<?php echo $event['event_id']; ?>"><img style="width: 20px" src="<?php echo plugins_url('/viavi-wordpress-timeline/images/edit.png',1); ?>" /></a>
            </td>
            <td>
                <a onclick="return confirm('<?php echo _e('Are you sure you want to delete this event?','viavi-wordpress-timeline'); ?>')" href="<?php echo admin_url().'admin.php?page=viavi-wordpress-timeline/index.php'; ?>&isvav=DeleteEventPost&event_id=<?php echo $event['event_id']; ?>"><img style="width: 20px" src="<?php echo plugins_url('/viavi-wordpress-timeline/images/delete.png',1); ?>" /></a>
            </td>            

        </tr>
        <?php
        }

        ?>
    </table>

    <?php            

        
        WordPressTimelineSayfala(admin_url().'admin.php?page=viavi-wordpress-timeline/index.php',$toplam_sayfa,$page,$page_limit,'&isvav=EventList');

}else{
    // Söz yok ise uyarı mesajı ver.
    ?>
    <p class="WordPress_hata"><?php echo _e('You have not added any event :(','viavi-wordpress-timeline'); ?></p>
    <?php
}
?>
</div>