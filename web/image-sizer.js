function modalView() {
    $('table tbody tr').find('td:last a:first').click(function () {
        $.get(
                $(this).attr('href'),
                {},
                function (data) {
                    $('.modal .modal-content').html(data);
                    $('.modal').modal();
                }
        );

        return false;
    });
}

function openWindow() {
    $('table tbody tr').find('td:last a:first').next().click(function(){
        var url = $(this).attr('href');
        window.open(url, 'Update book', 'left=300px,top=200px,width=500px,height=600px');
        
        return false;
    });
}
