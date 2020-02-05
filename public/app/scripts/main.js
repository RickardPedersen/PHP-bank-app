$(function() {
    $.ajax({
        url: '../../api/getUserInfo.php',
        dataType: 'json',
        success: function(data) {
            console.log(data);

            for (let user of data) {
                $('<option>', {
                    html: user.firstName,
                    value: user.firstName
                }).appendTo('#usersDrop');
            }
        }
    });

    $('#transferForm').on('submit', (e) => {
        e.preventDefault();
        console.log('Transfer')
    })
});