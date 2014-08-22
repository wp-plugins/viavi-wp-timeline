<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>
 

<div id="WordPress_wrap" style="padding:10px">
    <h1 style="font:oblique 30px/30px Georgia,serif; color:grey;background-image: url('<?php echo plugins_url('/viavi-wp-timeline/images/viavi-wp-timeline-logo.png',1); ?>');background-repeat: no-repeat;padding: 0px 10px 10px 47px;background-position: 0 0;">Viavi WordPress Timeline<sup style="font-size: 14px">1.0</sup></h1>
    
    <div class="header-tabs">

    <a class="button <?php if($_GET['isvav']=="" or $_GET['isvav']=="DeleteGroupPost"){echo "active";} ?>" href="<?php echo    admin_url().'admin.php?page=viavi-wp-timeline/index.php';?>"><?php echo _e('Timeline List','viavi-wp-timeline'); ?></a>
    <a class="button <?php if($_GET['isvav']=="NewGroupForm"){echo "active";}?>" href="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=NewGroupForm"><?php echo _e('Add New Timeline','viavi-wp-timeline'); ?></a>

    <a class="button <?php if($_GET['isvav']=="EventList" or $_GET['isvav']=="EditEventForm" or $_GET['isvav']=="EditEventPost" or $_GET['isvav']=="DeleteEventPost"){echo "active";}?>" href="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=EventList"><?php echo _e('Event List','viavi-wp-timeline'); ?></a>
    <a class="button <?php if($_GET['isvav']=="NewEventForm"){echo "active";}?>" href="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=NewEventForm"><?php echo _e('Add New Event','viavi-wp-timeline'); ?></a>
    
    <a class="button <?php if($_GET['isvav']=="NewStyleSelect"){echo "active";}?>" href="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=NewStyleSelect"><?php echo _e('Timeline Style','viavi-wp-timeline'); ?></a>
    
    <a class="button <?php if($_GET['isvav']=="HelpFile"){echo "active";}?>" href="<?php echo admin_url().'admin.php?page=viavi-wp-timeline/index.php'; ?>&isvav=HelpFile"><?php echo _e('Help','viavi-wp-timeline'); ?></a>
    
    </div>    