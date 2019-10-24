
$(function(){
    
    'use strict';
// FOR NAVBAR IN DASHBOARD TO OPEN THE SLIDE AND CLOSE IT AUTOMATIC
    $('#door').mouseover(function(){
        $('.left-side').addClass('active');
        $('.right-side').removeClass('full-width');
    });
    $('#door').mouseleave(function(){
        $('.left-side').removeClass('active');
            $('.right-side').addClass('full-width');
    });
    
    $('.hover').hover(function(){
    $(this).find('.hide').fadeIn(200);
    },function () {
    $(this).find('.hide').fadeOut(200);
});

//HIDE THE PLACEHOLDER IN FOUCES AND ADD AGAIN ON BLUR
$('[placeholder]').focus(function(){
    $(this).attr('data-text',$(this).attr('placeholder'));
    $(this).attr('placeholder', '');
    
}).blur(function() {
    $(this).attr('placeholder',$(this).attr('data-text'));

});

// CONFIRMED MESSAGE FOR DELETE
    $('.confirmed').click(function(){
        
        return confirm('Are You Sure To Delete ');
    })
    
});

// THE FILE NAME TO SHOW
$('#customFile').change(function(e){
    var fileName = e.target.files[0].name;
    $('.custom-file-label').html(fileName);
});

// FOR RICH TEXT EDITOR
$(document).ready(function(){
    $('.content').richText();
});
