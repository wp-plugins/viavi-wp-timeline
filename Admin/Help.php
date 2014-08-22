<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<?php if($_GET['settings-updated']=="true"){?> 

<p class="WordPress_ok"><?php echo _e('Timeline style set successfully.','viavi-wp-timeline'); ?></p>    

<?php }?>

<div class="viavi-content" <?php if($_GET['settings-updated']=="true"){?> style="display:none;"<?php }?>>

<h2><?php echo _e('Help','viavi-wp-timeline'); ?></h2>

<div style="display: block;padding: 0 0 10px 0">
    
	<h4>Installation</h4>
    <ul>
        <li>Send the file "viavi-wp-timeline" inside .zip into "/wp-content/plugins"</li>
        <li>Go to Admin Panel > Plugins menu to activate plugin.</li>
        <li>After clicking the button, you can select which timeline to show by entering "Timeline_ID" value and hit "ADD" button.</li>
    </ul>
    
    <h4>Shortcodes</h4>
	<p>For call in the page or post use "[ViaviWordPressTimeline timelineid="1"]"</p>
	<p>For call php template use "echo do_shortcode('[ViaviWordPressTimeline timelineid="1"]');" </p>
    
</div>

</div>