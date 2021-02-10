$(document).ready(function() {


    $('#app_users_menu').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/users/view_users_menu.php'
        },
        'columns': [
            { data: 'user_id' },
            { data: 'user_image' },
            { data: 'user_name' },
            { data: 'names' },
            { data: 'user_email' },
            { data: 'user_department' },
            { data: 'user_status' },
            { data: 'user_level' },
            { data: 'user_actions' },
        ]
    });
});

