function cr_range_option(option_id) {
    var range_wrapper = jQuery("#rangeInput-" + option_id);
    var cr_min = parseFloat(range_wrapper.attr("data-min"));
    var cr_max = parseFloat(range_wrapper.attr("data-max"));
    var cr_step = parseFloat(range_wrapper.attr("data-step"));
    var cr_value = parseFloat(range_wrapper.attr("data-value"));
    range_wrapper.slider({
        value: cr_value,
        min: cr_min,
        max: cr_max,
        step: cr_step,
        slide: function(event, ui) {
            range_wrapper.siblings(".range-input-selector").val(ui.value);
        }
    });
}
jQuery(document).ready(function($){

    //radio image vc param
    $("body").on('change','.n_radio_image_val',function(){
        
        var group_id = $(this).parents('.cr_img_select').data("grp-id");
        $("#cr_img_select-"+group_id).val($(this).val());
    });    

    setTimeout( function() {
        $('.creativo_customization').show();
    }, 100 );

    // Tabs
    //When page loads...
    
    $('.creativo_customization').each(function() {
        $(this).find(".pyre_metabox_tab").hide(); //Hide all content
        $(this).find("ul.cr_metabox_tabs li:first").addClass("active").show(); //Activate first tab
        $(this).find(".pyre_metabox_tab:first").show(); //Show first tab content
    });
   
    //On Click Event
    $("ul.cr_metabox_tabs li").click(function(e) {
        $(this).parents('.creativo_customization').find("ul.cr_metabox_tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(this).parents('.creativo_customization').find(".pyre_metabox_tab").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(this).parents('.creativo_customization').find('#pyre_tab_' + activeTab).fadeIn(); //Fade in the active ID content
        
        e.preventDefault();
    });
    
    $("ul.cr_metabox_tabs li a").click(function(e) {
        e.preventDefault();
    })      
});