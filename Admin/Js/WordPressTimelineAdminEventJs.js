jQuery(document).ready(function() {
    
    jQuery(".WordPressDate").datepicker({
        dateFormat : "yy-mm-dd",
        showOn: "both",
        buttonImageOnly: true,
        buttonImage: WordPressTimelineJsData.pluginUrl+'images/calendar.gif',
        buttonText: "Calendar",
        onSelect: function(dateText, inst) {
            var date_Array=dateText.split("-");
            
            console.log(date_Array);
            
            jQuery(".WordPressDateYear").val(date_Array[0]);
            jQuery(".WordPressDateMonth").val(date_Array[1]);
            jQuery(".WordPressDateDay").val(date_Array[2]);
            jQuery("#event_bc_input").val("");
        }
    });
    
    
    jQuery("#event_bc_input").keyup(function() {
            jQuery(".WordPressDateYear").val("");
            jQuery(".WordPressDateMonth").val("");
            jQuery(".WordPressDateDay").val("");
    });
    
});
