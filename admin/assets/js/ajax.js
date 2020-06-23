/*global $, jQuery, alert ,console, confirm*/
  
// When Document Is Ready
$(function () {
    'use strict';
    // START ACTIVE ROLE
    var responseAssign = $(".response");
    function done(search, no) {
        $.ajax({
            dataType: 'html',
            method: 'POST',
            asyc: false,
            url: 'process/roles_process.php',
            data: {status: 'show', search : search, page : no},
            success: function (data) {
                $("#table-response").html(data);
            },
            error: function (xhr, status, error) {
                responseAssign.prepend("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
            }
            
        });
     
    }
    done();
 
    $(document).on("click", '.activeRole', function (e) {
        e.preventDefault();
        
        var activeHref = $(this).attr("href"),
            activeId = $(this).data('id'),
            href = $(this);
        $.ajax({
            dataType: 'json',
            method: 'POST',
            url: activeHref,
            data: {status: 'active', id: activeId},
            beforeSend: function () {
                
            },
            success: function (data, status, xhr) {
                responseAssign.prepend("<img src='assets/images/loading.gif' alt='loading' class='loading-ajax'>");
                $("img[alt=loading]").fadeOut(1000, function () {
                    responseAssign.html(data.message);
                    $(".message").delay(1500).fadeOut();
                    if (data.status === 'text-success') {
                        $(href).children("span").addClass(data.status).removeClass('text-muted');
                    } else if (data.status === 'text-muted') {
                        $(href).children("span").addClass(data.status).removeClass('text-success');
                    
                    }
                });
              
            },
            error: function (xhr, status, error) {
                responseAssign.prepend("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
                
            }
        }); //Ajax
    }); //Click
   // END ACTIVE ROLE
    
    
    
    
        // START DELETE ROLE
    $(document).on("click", '.deleteRole', function (e) {
        e.preventDefault();
        var deleteHref = $(this).attr("href"),
            deleteId = $(this).data('id'),
            href = $(this);
          
        $.ajax({
            dataType: 'html',
            method: "POST",
            url: deleteHref,
            data: {status: 'delete', id: deleteId},
            success: function (data) {
                responseAssign.prepend("<img src='assets/images/loading.gif' alt='loading' class='loading-ajax'>");
                $("img[alt=loading]").fadeOut(1000, function () {
                    responseAssign.html(data);
                    $(".message").delay(1500).fadeOut();
                });
                done();
            },
            error: function (xhr, status, error) {
                responseAssign.prepend("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
                
            }
            
        });
    });
    
  // START SEARCH
    $("#search").on('keyup', function () {
        var search = $(this).val();
        done(search);
    });
    
    // START pagination
    $(document).on('click', '.page-item', function (e) {
        e.preventDefault();
        var page = $(this).children().data("page");
        done('', page);
       
    });
    
    // ADD NEW ROLE
    

        
    $(":submit").on("click", function (e) {
        e.preventDefault();
        //Varible
        var button =  $(this),
            roleName = $("input[name=name]#role_name").val(),
            active = $("input[name=active]:checked").val(),
            messageBox = $(".message-box"),
            addButton = $(this),
            errorName = true,
            errorActive = true;
        // If Condition
        if (roleName.length < 3 || roleName.length > 51) {
            errorName = false;
            $(".valid-role").fadeIn().delay(3000).fadeOut(1000);
        }
        if (active === undefined) {
            $(".valid-active").fadeIn().delay(3000).fadeOut(1000);
            errorActive = false;
        }
        
        if (errorActive === true && errorName === true) {
            $.ajax({
                dataType: 'html',
                method: 'POST',
                url: "process/roles_process.php",
                data: {status: 'add', name: roleName, active : active},
                success: function (data) {
                    addButton.attr("disabled", "disabled");
                    addButton.append("<i class='fas fa-spinner fa-pulse ml-2'></i>");
                    $(".fa-pulse").fadeOut(2000, function () {
                        messageBox.html(data);
                        addButton.removeAttr("disabled");
                    });
                   
                },
                error: function (xhr, status, error) {
                    messageBox.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
                }
              
                
            }); // Ajax
        } // end if
       
    });
    
}); // Document Ready