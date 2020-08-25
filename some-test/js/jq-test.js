$('#send-data-1').click(function () {
    let val = $("input[name=send-data-1]").val();

    $.ajax({
        url: "/some-test/post.php",
        method: "POST",
        data: { number : val },
        dataType: "json"
    })
    .done(function() {
        alert( "success" );
    })
    .fail(function() {
        alert( "error" );
    });

    console.log(val);
});