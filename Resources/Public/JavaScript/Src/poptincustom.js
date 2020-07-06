jQuery('document').ready(function (e) {
  'use strict';
    var windowWidth = window.screen.width < window.outerWidth ?
                  window.screen.width : window.outerWidth;
    var mobile = windowWidth < 500;
    if(mobile){
        setTimeout(function(){console.log($(".ytp-cued-thumbnail-overlay .ytp-cued-thumbnail-overlay-image"));},5000);
        $(".ytp-cued-thumbnail-overlay .ytp-cued-thumbnail-overlay-image").css("background-size","100%");
    }
    $('body').click(function (event) 
	{
	    console.log(event.target);
		if(jQuery('#deactivate_poptin_popup').hasClass("open") && !$(event.target).is(".pplogout")){
			jQuery('#deactivate_poptin_popup').addClass('hide').removeClass('open');
			removebacklayer();
		}
		if(jQuery('.whereis_myid').hasClass("open") && !$(event.target).is(".wheremyid")){
			jQuery('.whereis_myid').addClass('hide').removeClass('open');
			removebacklayer();
		}    
	});
  /* jQuery(".ppcontrolpanel").on("click",function(e){
	  e.preventDefault();
	   show_loader();
	  setTimeout(function(){ hide_loader(); }, 4000);
	  var href=$(this).attr("href");
	  var html='<embed src="'+href+'" width="100%" height="100%" id="controlembed" >';
	  $(".poptin_logged.indirect").html(html);
	   jQuery('.poptin_registration').addClass('hide').removeClass('show');
	   jQuery('.poptinLogo').removeClass('show').addClass('hide');
	   jQuery('.poptin_footer').removeClass('show').addClass('hide');
	   
  }); */
  jQuery('.ppcontrolpanel.with_token').on('click', function (e) {
      e.preventDefault();
      var account_id = $(this).attr("data-account");
      var dash_url = TYPO3.settings.ajaxUrls['update-token'];
      show_loader();
      window.open(dash_url);
      setTimeout(function(){hide_loader();},1500);
   
  });
   jQuery('.ppcontrolpanel.without_token').on('click', function (e) {
      e.preventDefault();
      show_loader();
	  setTimeout(function(){ hide_loader(); }, 4000);
      var href = "https://app.popt.in/login";
      
             window.open(href);
           
       setTimeout(function(){hide_loader();},1500);
    });
  jQuery('.pplogout1').on('click', function (e) {
    e.preventDefault();
	var u_id=jQuery("#deactivate_url").val();
	
    var url = TYPO3.settings.ajaxUrls['logout-user'];
    show_loader();
	
    jQuery.ajax({url: url, type: 'POST',dataType:'json', data:{user_id : u_id,remove:1 } ,success: function (response) {
      var jsonres = response;
      hide_loader();
	  console.log(typeof jsonres);
      if (jsonres.status === 1) {
        jQuery('#deactivate_poptin_popup').addClass('hide').removeClass('open');
        jQuery('.byebyeModal').removeClass('hide').addClass('open');
      }
      else {
        var error_s = jsonres.message;
        swal('Error', error_s, 'error');
      }
    }
	});
  });
  jQuery('.close_bybye').on('click', function (e) {
    jQuery('.byebyeModal').addClass('hide').removeClass('open');
    jQuery('.poptin_registration').removeClass('hide').addClass('show');
	jQuery('.poptinLogo').removeClass('hide').addClass('show');
		jQuery('.poptin_footer').removeClass('hide').addClass('show');
    jQuery('.poptin_logged').addClass('hide').removeClass('show');
    removebacklayer();
  });
  jQuery('.close_where').click(function (e) {
    jQuery('.whereis_myid').addClass('hide').removeClass('open');
    removebacklayer();
  });
  jQuery('.close_lookfamiliar').click(function (e) {
    jQuery('.lookfamiliar').addClass('hide').removeClass('open');
    removebacklayer();
  });
  jQuery('.close_oopsiewrongid').click(function (e) {
    jQuery('.oopsiewrongid').addClass('hide').removeClass('open');
    removebacklayer();
  });
  jQuery('.close_oopsiewrongemailid').click(function (e) {
    jQuery('.oopsiewrongemailid').addClass('hide').removeClass('open');
    removebacklayer();
  });
  jQuery('.wheremyid').click(function (e) {
    jQuery('.whereis_myid').removeClass('hide').addClass('open');
    jQuery('.oopsiewrongid').addClass('hide').removeClass('open');
    addbacklayer();
  });
  jQuery('.pplogin').click(function (e) {
    e.preventDefault();
   
    var user_id = jQuery('#user_id').val();
    jQuery('#deactivate_url').val(user_id);
   
 
    if (user_id === '' || user_id.length !== 13 || !user_id.match("^[a-zA-Z0-9]*$")) {
      jQuery('.oopsiewrongid').removeClass('hide').addClass('open');
      addbacklayer();
      return;
    }
    var login_url = TYPO3.settings.ajaxUrls['login-user'];
    show_loader();
    jQuery.ajax({url: login_url, type: 'POST',dataType:'json', data: {userid: user_id,login:1}, success: function (response) {
      hide_loader();
      var jsonres = response;
      if (jsonres.status === 1) {
        jQuery('.poptin_registration').addClass('hide').removeClass('show');
		jQuery('.poptin_registration.whychoose_sec').addClass('show').removeClass('hide');
        jQuery('.poptin_registration.digital_marketers').addClass('show').removeClass('hide');
        jQuery('.poptin_registration.video_sec').addClass('show').removeClass('hide');
        jQuery('.poptin_logged').removeClass('show').addClass('hide');
		 jQuery('.poptin_logged.indirect').removeClass('hide').addClass('show');
		jQuery('.poptinLogo').removeClass('hide').addClass('show');
		jQuery('.poptin_footer').removeClass('hide').addClass('show');
        jQuery('.without_token').removeClass('hide').addClass('show');
        jQuery('.with_token').addClass('hide').removeClass('show');
         

      }
      else {
        var error_s = 'Someting Goes Wrong';
        swal('Error', error_s, 'error');
       
      }
    }, error: function (ts) {
      hide_loader();
      swal('Error', ts.responseText, 'error');
    }});
  }); 
  jQuery('.ppsubmit').click(function (e) {
    e.preventDefault();
   
    var email_id = jQuery('#popin_email').val(); 
	
    if (email_id === '') {
      jQuery('.oopsiewrongemailid').removeClass('hide').addClass('open');
      addbacklayer();
      return;
    }
    
    var register_url = TYPO3.settings.ajaxUrls['register-user'];
    show_loader();
   
    if(email_id.indexOf("+")!=-1){
        hide_loader();
        swal("Wrong email address", "Please use your email address without the '+' sign","error");
        return false;
    }
    jQuery.ajax({url: register_url, type: 'POST',dataType:'json', data: {email: email_id}, success: function (result) {
      hide_loader();
      var jsonres =(result);
	  console.log(jsonres);
	  console.log(jsonres.status);
      if (jsonres.status === 1) {
        jQuery('.poptin_registration').addClass('hide').removeClass('show');
        jQuery('.poptin_registration.whychoose_sec').addClass('show').removeClass('hide');
        jQuery('.poptin_registration.digital_marketers').addClass('show').removeClass('hide');
        jQuery('.poptin_registration.video_sec').addClass('show').removeClass('hide');
        
		jQuery('.poptin_logged').removeClass('show').addClass('hide');
		 jQuery('.poptin_logged.indirect').removeClass('hide').addClass('show');
		jQuery('#deactivate_url').val(jsonres.user_id);
		jQuery('.without_token').removeClass('show').addClass('hide');
		/* jQuery('.poptinLogo').removeClass('show').addClass('hide');
		jQuery('.poptin_footer').removeClass('show').addClass('hide'); */
        jQuery('.with_token').addClass('show').removeClass('hide');
		jQuery('.lookfamiliar').removeClass('open').addClass('hide');
        
      }
      else {
        //jQuery('.lookfamiliar').removeClass('hide').addClass('open');
        var error_s = jsonres.message;
        swal('Error', error_s, 'error');
		
        
      }
    },
      error: function (ts) {
        hide_loader();
        swal('Error', ts.responseText, 'error');
      }
    });
  });
  function show_loader() {
    jQuery('.poptin-overlay').attr('style');
    jQuery('.poptin-overlay').css('display', 'block');
    jQuery('.poptin-overlay').fadeIn(500);
  }
  function hide_loader() {
    jQuery('.poptin-overlay').attr('style');
    jQuery('.poptin-overlay').fadeOut(500);
    jQuery('.poptin-overlay').css('display', 'none');
  }
  jQuery('#login_form').click(function (event) {
    event.preventDefault();
    jQuery('.login_form').attr('style', ' ');
    jQuery('.register_form').attr('style', ' ');
    jQuery('.login_form').css('display', 'block');
    jQuery('.register_form').css('display', 'none');
  });
  jQuery('.pplogout').click(function (event) {
    jQuery('#deactivate_poptin_popup').removeClass('hide').addClass('open').show();
    addbacklayer();
  });
  jQuery('.close_confirm').click(function (event) {
    jQuery('#deactivate_poptin_popup').addClass('hide').removeClass('open');
    removebacklayer();
  });
  jQuery('#register_form').click(function (event) {
    event.preventDefault();
    jQuery('.register_form').attr('style', ' ');
    jQuery('.login_form').attr('style', ' ');
    jQuery('.register_form').css('display', 'block');
    jQuery('.login_form').css('display', 'none');
  });
  function addbacklayer() {
    jQuery('body').append('<div class="modal-backdrop fade in"></div>');
  }
  function removebacklayer() {
    jQuery('.modal-backdrop').remove();
  }
  function swal(Error, msg, error) {
    jQuery('.swal_d_display').css('display', 'block');
    jQuery('.swal-text').html(msg);
    jQuery('.swal-title').html(Error);
  }
  jQuery('.swal-button').click(function () {
    jQuery('.swal_d_display').css('display', 'none');
  });
});
function ddscript(){
    console.log("loaded");
}
function AddJS(user_id,ddscript){
  
      var script = document.createElement("script");
      script.setAttribute("src", '//example.com/myapp/store' + user_id + '.js');
      script.charset = "utf-8";
      script.setAttribute("type", "text/javascript");
      script.onreadystatechange = script.onload = ddscript;
      document.body.appendChild(script);
}
