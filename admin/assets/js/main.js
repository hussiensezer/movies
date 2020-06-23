
$(function(){
    
    'use strict';
// FOR NAVBAR IN DASHBOARD TO OPEN THE SLIDE AND CLOSE IT AUTOMATIC
    $('#door').mouseover(function(){
        $('.left-side').addClass('active-fadeOut');
        $('.right-side').removeClass('full-width');
    });
    $('#door').mouseleave(function(){
        $('.left-side').removeClass('active-fadeOut');
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

// TO DISPLAY THE ACTION IN LASTEST TO LIKE ACTIVE DELETE EDIT
// $('.child-link').hover(function(){
//     $(this).find('.show-action').fadeIn(200);
// },function () {
//     $(this).find('.show-action').fadeOut(200);
//     });




$('.toggel-info').click(function(){
    
    $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(200);
    
    if($(this).hasClass('selected')) {
        $(this).html('<i class="fas fa-plus fa-lg"></i>');
    }else {
        $(this).html('<i class="fas fa-minus fa-lg"></i>');
    }
    
});


