<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<div class="viavi-content">

<h2><?php echo _e('Add New Timeline','viavi-wp-timeline'); ?></h2>

<div style="display: block;padding: 0 0 10px 0">
    <form id="form_gonder" action="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=NewGroupPost" method="post">
        <h3><?php echo _e('Timeline Name','viavi-wp-timeline'); ?></h3>
        <input type="text" name="group_name" size="40"/>
        <br/><br/>
        <input type="submit" value="<?php echo _e('Add Timeline','viavi-wp-timeline'); ?>" class="button" id="gonder_button"/>
    </form>
</div>

</div>