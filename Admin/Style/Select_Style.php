<?php if(!defined('WordPress_WP_TIMELINE_KONTROL')){ echo 'Bu dosyaya erşiminiz engellendi.'; exit(); } ?>

<?php if($_GET['settings-updated']=="true"){?> 

<p class="WordPress_ok"><?php echo _e('Timeline style set successfully.','viavi-wp-timeline'); ?></p>    

<?php }?>

<div class="viavi-content" <?php if($_GET['settings-updated']=="true"){?> style="display:none;"<?php }?>>

<h2><?php echo _e('Select Style','viavi-wp-timeline'); ?></h2>

<div style="display: block;padding: 0 0 10px 0">
    
    <form method="post" action="options.php">
         
        <?php settings_fields( 'WordPress-fields' ); ?>
         
         <select name="WordPress_TL_style">
            <option value=""><?php echo _e('Default Style','viavi-wp-timeline'); ?></option>
             
                    <option value="WordPress_style1" <?php if(get_option('WordPress_TL_style')=="WordPress_style1"){?>selected="selected"<?php }?>>Style 1</option>
                    <option value="WordPress_style2" <?php if(get_option('WordPress_TL_style')=="WordPress_style2"){?>selected="selected"<?php }?>>Style 2</option>
                    <option value="WordPress_style3" <?php if(get_option('WordPress_TL_style')=="WordPress_style3"){?>selected="selected"<?php }?>>Style 3</option>
                    <option value="WordPress_style4" <?php if(get_option('WordPress_TL_style')=="WordPress_style4"){?>selected="selected"<?php }?>>Style 4</option>
                    <option value="WordPress_style5" <?php if(get_option('WordPress_TL_style')=="WordPress_style5"){?>selected="selected"<?php }?>>Style 5</option>
                   
        </select>
        <!--<input type="text" name="WordPress_style2" id="WordPress_style2" value="<?php echo get_option('WordPress_style2'); ?>" />-->
        <br/><br/>
        <input type="submit" name="WordPress_submit" value="<?php _e('Save Changes') ?>" class="button" id="gonder_button"/>
    </form>
</div>

</div>