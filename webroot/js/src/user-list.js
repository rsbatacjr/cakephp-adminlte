var userListPage = (function($, toastr, undefined) {
    var notification = notificationHelper,
        dialog = dialogHelper,
        private = {
            initialize: function() {
                $('#hdn-id').attr("value", 0);
                $('#txt-first_name').prop("value", "");
                $('#txt-last_name').prop("value", "");
                $('#txt-email').prop("value", "");
                $('#sel-role').val(0);
                $('#chk-active').attr('checked', false);
            },
            setDefaults: function() {
                $.ajax({
                    url: '/UserRoles/GetUserRoleOptions/',
                    success: function(s){
                        $.each(s, function(){
                            $('#sel-role').append("<option value='" + $(this)[0].id + "'>" + $(this)[0].role + "</option>");
                        })
                    }
                })
            },
            setEvents: function() {
                $('#add_user').on('click', function(e) {
                    $('#userEditor').attr("data-mode", "new");
                    $('#userEditor').find('#title').text("New User")
                    $('#userEditor').modal('show');
                    private.initialize();
                });

                $('#example2 tbody tr td:last-child').find('.delete-btn').on('click', function(e) {
                    private.delete($(this).data('id'));
                });
            },
            validateEntries: function(){
                return true;
            },
            save: function() {
                var valid = private.validateEntries(), data=[];

                if(valid) {
                    $.ajax({
                        url: "/users/add/",
                        type: "post", 
                        data: {
                            first_name: $('#txt-first_name').val(),
                            last_name: $('#txt-last_name').val(),
                            email: $('#txt-email').val(),
                            role_id: $('#sel-role').val(),
                            active: ($('#chk-active').is(':checked') ? 1: 0)
                        },
                        success: function(s) {
                            if(s.status == 'success') {
                                notification.showInformation({msg: s.message, title: "Success"});
                                //data = s.data;

                                window.location.reload();
                            } else {
                                notification.showError({msg: s.message, title: "Error"});
                            }
                        },
                        error: function(e) {
                            notification.showError({msg: "There was an error trying to contact the server, please try again later", title: "Error"});
                        }
                    });
                }
            },
            update: function() {
                $.ajax({
                    url: "/users/edit/",
                    type: "post", 
                    data: {
                        id: $('#hdn-id').val(),
                        first_name: $('#txt-first_name').val(),
                        last_name: $('#txt-last_name').val(),
                        email: $('#txt-email').val(),
                        role_id: $('#sel-role').val(),
                        active: ($('#chk-active').is(':checked') ? 1: 0)
                    },
                    success: function(s) {
                        if(s.status == 'success') {
                            notification.showInformation({msg: s.message, title: "Success"});
                            window.location.reload();
                        } else {
                            notification.showError({msg: s.message, title: "Error"});
                        }
                    },
                    error: function(e) {
                        notification.showError({msg: "There was an error trying to contact the server, please try again later", title: "Error"});
                    }
                })
            },
            delete: function(id) {
                $.ajax({
                    url: "/users/delete/",
                    type: "post",
                    data: {
                        id: id
                    },
                    success: function(s) {
                        if(s.status == 'success') {
                            notification.showInformation({msg: s.message, title: "Success"});
                            window.location.reload();
                        } else {
                            notification.showError({msg: s.message, title: "Error"});
                        }
                    },
                    error: function(e) {
                        notification.showError({msg: "There was an error trying to contact the server, please try again later", title: "Error"});
                    }
                })
            }
        },
        public = {
            onLoad: function(options) {
                options.saveMethod = function() {
                    var mode = $('#userEditor').data('mode');
                    if(mode == 'new') {
                        private.save();
                    } else {
                        private.update();
                    }
                }

                dialog.AddDialog(options);
                private.setEvents();
                private.setDefaults();
            }
        }

    return public;
})(jQuery, toastr);

$(document).ready(function() {
    var primary_key = "",
        options = {},
        userList = userListPage;


    options.id = "userEditor";
    options.height = 380;
    options.content =
    "<div class='row'>" +
        "<div class='form-horizontal'>" +
            "<input type='hidden' id='hdn-id'>" +
            "<div class='form-group'>" +
                "<label for='txt-first_name' class='control-label col-xs-3'>First Name</label>" +
                "<div class='col-xs-9'>" +
                    "<input type='text' id='txt-first_name' class='form-control' />" +
                "</div>" +
            "</div>" +
            "<div class='form-group'>" +
                "<label for='txt-last_name' class='control-label col-xs-3'>Last Name</label>" +
                "<div class='col-xs-9'>" +
                    "<input type='text' id='txt-last_name' class='form-control' />" +
                "</div>" +
            "</div>" +
            "<div class='form-group'>" +
                "<label for='txt-email' class='control-label col-xs-3'>Email</label>" +
                "<div class='col-xs-9'>" +
                    "<input type='text' id='txt-email' class='form-control' />" +
                "</div>" +
            "</div>" +
            "<div class='form-group'>" +
                "<label for='sel-role' class='control-label col-xs-3'>Role</label>" +
                "<div class='col-xs-9'>" +
                    "<select id='sel-role' class='form-control'>" +
                        "<option value=''>-- Select Role --</option>" +
                    "</select>" +
                "</div>" +
            "</div>" +
            "<div class='form-group'>" +
                "<label for='chk-active' class='control-label col-xs-3'>Active</label>" +
                "<div class='col-xs-9'>" +
                    "<input type='checkbox' id='chk-active' />" +
                "</div>" +
            "</div>" +
        "</div>" +
    "</div>";

    $("#example2").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    $(".dataTables_wrapper > .row > .col-sm-6:first-child").html("<button id=\'add_user\' class=\'btn btn-primary\'>New</button>");

    $("input[type=search]").css({"width": "400px"});

    $("#example2 tbody tr").find("td:first-child").on("click", function(){
        primary_key = $(this).find("a").data("id");

        $.ajax({
            url: '/Users/GetUserById/' + primary_key,
            success: function(r){
                u = r[0];
                $('#userEditor').attr("data-mode", "edit");
                $('#' + options.id).find('#title').text("Edit User");
                $('#' + options.id).modal('show');

                $('#hdn-id').attr("value", u.id);
                $('#txt-first_name').attr("value", u.person.first_name);
                $('#txt-last_name').attr("value", u.person.last_name);
                $('#txt-email').attr("value", u.email);
                $('#sel-role').val(u.role_id);
                $('#chk-active').attr('checked', u.active);
            }
        })
    });

    userList.onLoad(options);
});