/*global $, jQuery, alert ,console, confirm*/

$(function () {
    'use strict';
    var response = $(".response");
    
    function getData() {
        $("#show-data").load("process/categories_show.php?status=show");
    }
    
    getData();
    // Start Active
    $(document).on("click", ".active_cate", function (e) {
        e.preventDefault();
        var id = $(this).data("id"),
            link = $(this);
        
        $.ajax({
            //data:{id: id, status = 'active'}
            method: 'GET',
            url: 'process/categories_active.php?id=' + id + "&status=active",
            dataType : 'json',
            beforeSend: function () {
                console.log("before Send");
            },
            success: function (data, status, xhr) {
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
            },
            error: function (xhr, status, error) {
                response.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
            },
            complate: function () {
                //console.log("Request Is Complate");
            }
            
        });
        
    }); // End Active
    
    // Start Delete
    $(document).on("click", ".delete-cate", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            method: 'GET',
            url: 'process/categories_delete.php',
            data: {id : id, status : 'delete'},
            dataType : 'html',
            success: function (data, status, xhr) {
                response.prepend("<img src='assets/images/loading.gif' alt='loading' class='loading-ajax'>");
                $("img[alt=loading]").fadeOut(1000, function () {
                    response.html(data);
                    $(".message").delay(1500).fadeOut();
                });
                getData();
            },
            error: function (xhr, status, error) {
                response.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");
            }
        });// Ajax          
    });
    // End Delete
    
    // Create Categories
    $("#create-category").on("submit", function (e) {
        e.preventDefault();
        var form = $(this),
            dataForm = form.serialize(),
            addButton = $(":submit"),
            messageBox = $(".respone-message");
        $.ajax({
            method : 'POST',
            url : 'process/categories_create.php',
            data:  dataForm,
            dataType : 'html',
            success: function (data) {
                addButton.prop("disabled", true);
                addButton.append("<i class='fas fa-spinner fa-pulse ml-2'></i>");
                $(".fa-pulse").fadeOut(2000, function () {
                    messageBox.html(data);
                    addButton.prop("disabled", false);
                });
            },
            error: function (xhr, status, error) {
                messageBox.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");

            }
            
        }); // Ajax
        
    }); // From
    
    // Update Categories
    $("#update-form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this),
            dataForm = form.serialize(),
            addButton = $(":submit"),
            messageBox = $(".respone-message");
        $.ajax({
            method : 'POST',
            url : 'process/categories_update.php',
            data:  dataForm,
            dataType : 'html',
            success: function (data) {
                addButton.prop("disabled", true);
                addButton.append("<i class='fas fa-spinner fa-pulse ml-2'></i>");
                $(".fa-pulse").fadeOut(2000, function () {
                    messageBox.html(data);
                    addButton.prop("disabled", false);
                });
            },
            error: function (xhr, status, error) {
                messageBox.append("<div class='alert alert-warning'> <h3> AJAX Request Error</h3> <b>Error</b> => " + error + "<br> <b>Status Error</b> => " + status + "</div>");

            }
            
        }); // Ajax
    });
    
});