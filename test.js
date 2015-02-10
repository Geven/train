function Test() {
    var check = '2066';

     $.ajax({
        url: "12.php",
        method: "POST",
        data: {testdata: check},
        success: function (check) {
            $('body').html(check);
        }
    });

}