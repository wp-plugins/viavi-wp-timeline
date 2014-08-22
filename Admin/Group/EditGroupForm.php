<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
<?php
$group_id=(int)$_GET['group_id'];

$group_name=mysql_fetch_array(mysql_query('SELECT group_id,title FROM '.WordPress_WP_TIMELINE_DB_PREFIX.'WordPress_Timeline WHERE group_id="'.$group_id.'" AND type="group_name" '));
?>
<div class="viavi-content">

<h2><?php echo _e('Edit Timeline','viavi-wordpress-timeline'); ?></h2>
<div style="display: block;">
    <form id="form_gonder" action="<?php echo admin_url().'admin.php?page=viavi-wordpress-timeline/index.php'; ?>&isvav=EditGroupPost" method="post">
        <h3 style="margin-bottom: 1px;"><?php echo _e('Timeline Name','viavi-wordpress-timeline'); ?></h3>
        <input type="text" name="group_name" size="40" value="<?php echo $group_name['title']; ?>"/>
        <input type="hidden" name="group_id" value="<?php echo $group_name['group_id']; ?>"/>
        <br/><br/>
        <input type="submit" value="<?php echo _e('Update Timeline','viavi-wordpress-timeline'); ?>" class="button" id="gonder_button"/>
    </form>
</div>

</div>