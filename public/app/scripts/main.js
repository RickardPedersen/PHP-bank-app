$(function() {
    $.ajax({
        url: '../../api/getUsersInfo.php',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            //console.log(data[0])
            $('#username').html(data[0].firstName + ' ' + data[0].lastName);
            $('#currency').html(data[0].currency)
            $('#balance').html(data[0].balance)

            for (let user of data) {
                $('<option>', {
                    html: user.firstName,
                    value: user.accountID
                }).appendTo(['#usersDrop', '#changeUserDrop']);
            }
        }
    });

    $('#changeUserForm').on('submit', (e) => {
        e.preventDefault();

        let userIdInput = parseInt($('select[name=changeUserSelect]').val());
        let user = {
            userID: userIdInput
        }
        console.log(user)
        
        $.ajax({
            type: 'POST',
            url: '../../api/changeUser.php',
            dataType: 'json',
            data: user,
            success: function(data) {
                console.log(data)
                $('#username').html(data[0].firstName + ' ' + data[0].lastName);
                $('#currency').html(data[0].currency)
                $('#balance').html(data[0].balance)
            },
            error: function() {
                console.log('asdasd')
            }
            
        });
    })

    $('#transferForm').on('submit', (e) => {
        e.preventDefault();
        console.log('Transfer')
    })
});