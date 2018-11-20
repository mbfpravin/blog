
function apsl_open_in_popup_window(event, url){
    event.preventDefault();
    console.log('llll');
    window.open(url, 'fdadas', 'toolbars=0,width=640,height=320,left=200,top=200,scrollbars=1,resizable=1');
    parent.close();
}

jQuery(document).ready(function($){
    $('.show-apsl-container').on('click', function(e){
        e.preventDefault();
        $('.apsl-container').slideToggle();
    });

    $('.apsl-link-account-button').click(function(){
    	$('.apsl-buttons-wrapper').hide();
    	$('.apsl-login-form').show();
        $('.apsl-registration-wrapper').addClass('apsl-login-registration-form');
    });

    $('.apsl-create-account-button').click(function(){
    	$('.apsl-buttons-wrapper').hide();
    	$('.apsl-registration-form').show();
        $('.apsl-registration-wrapper').addClass('apsl-login-registration-form');
    });

    $('.apsl-back-button').click(function(){
    	$('.apsl-buttons-wrapper').show();
    	$('.apsl-login-form').hide();
		$('.apsl-registration-form').hide();
        $('.apsl-registration-wrapper').removeClass('apsl-login-registration-form');
    });
$('.heart').on('click',function(event){

var usr=$(this).data('user');
var post=$(this).data('postid');
var val = $(this);
    $.ajax({
            url: templateUri + '/ajax/favourite.php',
            type: "POST",
            data:{usrid: usr, postid: post},
            success: function (data) {
             if(data ==1) {
               val.addClass("is-active");
              }else{
              	val.removeClass("is-active");
              }
            }
        });
      return true;
  });

});

// $(function() {
//   $(".heart").on("click", function() {
//     $(this).toggleClass("is-active");
//   });
// });


jQuery('#book').on('click',function(e){
  e.preventDefault();
var usr=jQuery(this).data('user');
var post=jQuery(this).data('postid');
var eventname = jQuery('#ename').val();
var Name =jQuery('#contact-name').val();
var email =jQuery('#contact-email').val();
var phone = jQuery('#contact-phone').val();
var mesg =jQuery('#form-message').val();
var val = jQuery(this);
    $.ajax({
            url: templateUri + '/ajax/ajax-submit.php',
            type: "POST",
            data:{usrid: usr,postid: post,event_name: eventname,name:Name,email:email,phone :phone,message:mesg},
            success: function (data) {
             // if(data ==1) {
             //   val.addClass("is-active");
             //  }else{
             //    val.removeClass("is-active");
             //  }
             alert('gg');
            }
        });
      // return true;
  });
