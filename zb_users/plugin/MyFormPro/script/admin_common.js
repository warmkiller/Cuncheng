function ToggleConfirmation(isInit){

    var isRedirect = jQuery("#form_confirmation_redirect").is(":checked");
    var isPage = jQuery("#form_confirmation_show_page").is(":checked");

    if(isRedirect){
        show_element = "#form_confirmation_redirect_container";
        hide_element = "#form_confirmation_message_container, #form_confirmation_page_container";
    }
    else if(isPage){
        show_element = "#form_confirmation_page_container";
        hide_element = "#form_confirmation_message_container, #form_confirmation_redirect_container";
    }
    else{
        show_element = "#form_confirmation_message_container";
        hide_element = "#form_confirmation_page_container, #form_confirmation_redirect_container";
    }

    var speed = isInit ? "" : "slow";

    jQuery(hide_element).hide(speed);
    jQuery(show_element).show(speed);

}

function ToggleQueryString(isInit){
    var speed = isInit ? "" : "slow";
    if(jQuery('#form_redirect_use_querystring').is(":checked")){
        jQuery('#form_redirect_querystring_container').show(speed);
    }
    else{
        jQuery('#form_redirect_querystring_container').hide(speed);
        jQuery("#form_redirect_querystring").val("");
    }

}


function InsertVariable(element_id, callback, variable){

                if(!variable)
                    variable = jQuery('#' + element_id + '_variable_select').val();

                var messageElement = jQuery("#" + element_id);

                if(document.selection) {
                    // Go the IE way
                    messageElement[0].focus();
                    document.selection.createRange().text=variable;
                }
                else if(messageElement[0].selectionStart) {
                    // Go the Gecko way
                    obj = messageElement[0]
                    obj.value = obj.value.substr(0, obj.selectionStart) + variable + obj.value.substr(obj.selectionEnd, obj.value.length);
                }
                else {
                    messageElement.val(variable + messageElement.val());
                }

                jQuery('#' + element_id + '_variable_select')[0].selectedIndex = 0;


                if(callback && window[callback]){
                    window[callback].call();
                }
            }
