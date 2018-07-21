jQuery(".frm-toggle").click(function() {
    // change view between login and registration forms
    jQuery(".frm-div").toggleClass("frm-hidden");
});
jQuery(".close").click(function() {
    // close alert
    jQuery(this).parent().addClass('frm-hidden');
});
jQuery(".forgot-toggle").click(function() {
    // change view between login and forgot password forms
    jQuery(".frm-div2").toggleClass("frm-hidden");
});
jQuery("#login-btn").click(function() { // login button handler
	var data = jQuery("#form-login").serialize();
    // call login script via ajax
	$.ajax({
        type: "POST",
        url: "login.php",
        data: data,
        success: function (resp) {
         	console.log(resp);
			if (resp.status) {
                // if everything OK and user logged in - redirect to contacts list
				window.location.href = 'main.php';
			} else {
                // if user not logged in - show error
				jQuery(".login-alert").removeClass('frm-hidden');
			}               
        },
        error: function (resp, textStatus, errorThrown) {
            console.log(textStatus, errorThrown, resp);
            jQuery(".login-alert").removeClass('frm-hidden');
        },
        dataType: 'json'
    });
});
jQuery("#register-btn").click(function() { // register button handler
    // check if all fields are filled
    var emptyField = 0;
    jQuery("#form-register input").each(function() {
        if (jQuery(this).val() == "") {
            jQuery(this).css("border-color", "red");
            emptyField = 1;
        } else {
            jQuery(this).css("border-color", "#ccc");
        }
    });
    if (emptyField) {
        jQuery(".register-alert-fail").find("p").text("Please, fill all fields");
        jQuery(".register-alert-fail").removeClass('frm-hidden');
        return false;
    }
    // check if password is verified
    if (jQuery("#frm-reg-pass").val() !== jQuery("#frm-reg-verify").val()) {
        jQuery("#frm-reg-pass").css("border-color", "red");
        jQuery("#frm-reg-verify").css("border-color", "red");
        jQuery(".register-alert-fail").find("p").text("Password missmatch");
        jQuery(".register-alert-fail").removeClass('frm-hidden');
        return false;
	} else {
        jQuery("#frm-reg-pass").css("border-color", "#ccc");
        jQuery("#frm-reg-verify").css("border-color", "#ccc");
    }
    // call registration script via ajax
	var data = jQuery("#form-register").serialize();
	$.ajax({
        type: "POST",
        url: "register.php",
        data: data,
        success: function (resp) {
            if (resp.status) {
                jQuery(".register-alert-ok").removeClass('frm-hidden');
            } else {
                jQuery(".register-alert-fail").find("p").text(resp.description);
                jQuery(".register-alert-fail").removeClass('frm-hidden');
            }
        },
        error: function (resp, textStatus, errorThrown) {
            console.log(textStatus, errorThrown, resp);
        },
        dataType: 'json'
    });
});
jQuery("#forgot-btn").click(function() { // forgot button handler
    var data = jQuery("#form-forgot").serialize();
    $.ajax({
        type: "POST",
        url: "tokengen.php",
        data: data,
        success: function (resp) {
            console.log(resp);
            if (resp.status) {
                jQuery(".forgot-alert-ok").removeClass('frm-hidden');
            } else {
                jQuery(".forgot-alert-fail").removeClass('frm-hidden');
            }
        },
        error: function (resp, textStatus, errorThrown) {
            console.log(textStatus, errorThrown, resp);
            jQuery(".forgot-alert-fail").removeClass('frm-hidden');
        },
        dataType: 'json'
    });
});