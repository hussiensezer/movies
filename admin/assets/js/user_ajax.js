/*global $, jQuery, alert ,console, confirm, FormData*/

$(function () {
    'use strict';
    // Get Table Of Users
    function userData() {
        $("#table-response").load("process/users_show.php?status=show");
    }
    userData();
    
    $(document).on("click", "#active-user", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            response = $(".response-message"),
            link = $(this);
        // Ajax
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: 'process/users_active.php',
            data: {status: 'active', 'id': id},
            success : function (data) {
                response.prepend("<img src='assets/images/loading.gif' alt='loading' class='loading-ajax'>");
                $("img[alt=loading]").fadeOut(1000, function () {
                    response.html(data.message);
                    $(".message").delay(1500).fadeOut();
                    if (data.status === 'text-success') {
                        $(link).children("span").addClass(data.status).removeClass('text-muted');
                    } else if (data.status === 'text-muted') {
                        $(link).children("span").addClass(data.status).removeClass('text-success');
                    
                    }
                });
            },// Success
            error: function (xhr, status, error) {
                response.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
            }// Error
            
        });// End Ajax
        
    });// End Active Function
    
    // Start Delete
    $(document).on("click", "#delete-user", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            response = $(".response-message");
        $.ajax({
            method: 'GET',
            url: 'process/users_delete.php',
            data: {id : id, status : 'delete'},
            dataType : 'html',
            success: function (data, status, xhr) {
                response.prepend("<img src='assets/images/loading.gif' alt='loading' class='loading-ajax'>");
                $("img[alt=loading]").fadeOut(1000, function () {
                    response.html(data);
                    $(".message").delay(1500).fadeOut();
                });
                userData();
            },
            error: function (xhr, status, error) {
                response.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
            }
        });// Ajax          
    });
    // End Delete
    
    
    $("#create-user").on("submit", function (e) {
        e.preventDefault();
        var form = $(this)[0],
            dataForm = new FormData(form),
            message = $(".respone");
        $.ajax({
            method : 'POST',
            url: 'process/users_create.php',
            data: dataForm,
            contentType : false,
            cashe: false,
            processData: false,
            dataType: 'html',
            success: function (data) {
                message.html(data);
            },
            error: function (xhr, status, error) {
                message.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");

            }
        });
            
            
    });
 
});


   /*    // Create Categories
    $("#create-user").on("submit", function (e) {
        e.preventDefault();
        var form = $(this),
            dataForm = new FormData(form[0]),
            addButton = $(":submit"),
            message = $(".respone");
        console.log(form[0]);
        console.log(dataForm);
        $.ajax({
            method : 'POST',
            url : 'process/users_create.php',
            data:  dataForm,
            dataType: 'html',
            contentType: false,
            cashe: false,
            processData: false,
            success: function (data) {
                console.log(data);
                message.html(data);
                
            },
            error: function (xhr, status, error) {
                message.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");

            }
            
        }); // Ajax
        
    }); // From*/