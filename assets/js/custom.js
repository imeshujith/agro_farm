$(document).ready(function () {
    $("#success-alert").fadeTo(2000, 0).slideUp(500, function(){
        $("#success-alert").alert('close');
    });

    getAllUsers();
    $('#user_error').hide();
    $('#add_product_errors').hide();

    $('#button_save').click(function() {
        let url = $('#user_form').attr('action');
        let data =$('#user_form').serialize();
        $.ajax({
            type: 'post',
            async: false,
            url: $('#user_form').attr('action'),
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response.error == true) {
                    $('#error_message').html(response.message);
                    $('#user_error').slideDown(500);
                }
                else {
                    $('#user_error').hide();
                    $('#user_form')[0].reset();
                    $('#user_modal').modal('hide');
                    getAllUsers();
                    $.notify({
                        message: response.message
                    },
                    {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },
                    });
                }
            },
        });
    });

    $('#add_product').click(function() {
        let url = $('#add_product_form').attr('action');
        let data = $('#add_product_form').serialize();
        $.ajax({
            type: 'post',
            async: false,
            url: $('#add_product_form').attr('action'),
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response.error == true) {
                    $('#error_message').html(response.message);
                    $('#add_product_errors').slideDown(500);
                }
            },
        });
    });

    $('#create_user').click(function () {
        $('#user_modal').modal('show');
        $('#user_modal').find('.modal-title').text('Create New User');
        $('#user_form').attr('action', base_url + 'users/users/create_user');
        $('#user_error').hide();
        $('#user_form')[0].reset();
    });

    $('#all_users').on('click', '#edit_user', function () {
        $('#user_error').hide();
        let user_id = $(this).attr('data');
        $('#user_modal').modal('show');
        $('#user_modal').find('.modal-title').text('Update User');
        $('#user_form').attr('action', base_url + 'users/users/update_user');
        $.ajax({
            type: 'post',
            async: false,
            url: base_url + 'users/users/get_edit_user',
            dataType: 'json',
            data: {id: user_id},
            success: function (response) {
                $('input[name=first_name]').val(response.first_name);
                $('input[name=last_name]').val(response.last_name);
                $('input[name=email]').val(response.email);
                $('input[name=user_id]').val(response.id);
            },
        });
    });

    $('#all_users').on('click', '#delete_user', function () {
        let delete_user_id = $(this).attr('data');
        $('#user_delete_modal').modal('show');
        $('#button_delete').click(function () {
            $.ajax({
                type: 'post',
                async: false,
                url: base_url + 'users/users/delete_user',
                dataType: 'json',
                data: {id: delete_user_id},
                success: function (response) {
                    $('#user_delete_modal').modal('hide');
                    getAllUsers();
                    $.notify({
                        message: "User deleted successfully"
                    },
                    {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },
                    });
                },
            })
        });
    });

    $('#all_users').on('click', '#active', function () {
        let user_id = $(this).attr('data');
        $.post(base_url + 'users/users/inactive_user', {id: user_id}, function() {
            getAllUsers();
        })
    });

    $('#all_users').on('click', '#inactive', function () {
        let user_id = $(this).attr('data');
        $.post(base_url + 'users/users/active_user', {id: user_id}, function() {
            getAllUsers();
        })
    });

    $('#users_permissions').on('change', '#new_operation', function () {
        let user_id = $(this).attr('data-row-id');
        let new_operaton = $(this).val();
        console.log(new_operaton);
        $.ajax({
            type: 'post',
            url: base_url + 'users/UserManagement/update_permission',
            async: false,
            dataType: 'json',
            data: {id: user_id},
            success: function (response) {
                console.log(response);
            },
        });
    });


    function getAllUsers() {
        $.ajax({
            type: 'ajax',
            url: base_url + 'users/users/all_users',
            async: false,
            dataType: 'json',
            success: function (response) {
                $('#all_users').html(response);
            },
        });
    }
});

