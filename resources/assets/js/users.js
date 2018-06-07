$(document).ready(function(){

    $('.delete-user').click(function (e) {

        const id = $(this).data('id');
        let link = '/users/' + id;
        $('#DeleteUserForm').attr('action', link);

        $('#modalCenter').modal('show');
        if (confirm) {
            return true;
        } else {
            return false;
        }
    });

});