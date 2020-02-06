$(function() {
    $.ajax({
        url: '../../api/getUsersInfo.php',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            //console.log(data[0])
            $('#username').html(data[0].firstName + ' ' + data[0].lastName);
            $('#account').html(data[0].accountID)
            $('#currency').html(data[0].currency)
            $('#balance').html(data[0].balance)

            for (let user of data) {
                $('<option>', {
                    html: user.firstName,
                    value: user.userID
                }).appendTo('#changeUserDrop');
            }

            for (let user of data) {
                $('<option>', {
                    html: user.firstName,
                    value: user.accountID
                }).appendTo('#usersDrop');
            }

            // '#usersDrop'
        },
        error: function(a, b, c) {
            console.log(a)
            console.log(b)
            console.log(c)
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
                $('#account').html(data[0].accountID)
                $('#currency').html(data[0].currency)
                $('#balance').html(data[0].balance)
            },
            error: function() {
                //console.log('asdasd')
            }
            
        });
    })

    $('#bankTransferForm').on('submit', (e) => {
        e.preventDefault();
        console.log('Transfer')

        let fromAccountID = parseInt($('#account').html());
        let accountIdInput = parseInt($('select[name=bankTransferSelect]').val());
        let amountInput = parseInt($('#transferAmount').val());
        let transferData = {
            fromAccount: fromAccountID,
            toAccount: accountIdInput,
            amount: amountInput
        }
        //console.log(user)
        
        $.ajax({
            type: 'POST',
            url: '../../api/BankTransfer.php',
            dataType: 'json',
            data: transferData,
            success: function(data) {
                //let oldBalance = $('#balance').html();
                //let newBalance = parseInt(oldBalance - amountInput);
                console.log(data)
                //$('#username').html(data[0].firstName + ' ' + data[0].lastName);
                //$('#currency').html(data[0].currency)
                //$('#balance').html(newBalance)
            },
            error: function(a, b, c) {
                console.log(a)
                console.log(b)
                console.log(c)
            }
        });
        
    });
});