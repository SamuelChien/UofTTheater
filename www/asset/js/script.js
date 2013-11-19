$( "#submitBtn" ).click(function() {
    //get the text of the field
    var firstname = $( "#firstname" ).val();
    var lastname = $( "#lastname" ).val();
    var creditcard = $( "#creditcard" ).val();

    // getting the current date variable 
    var today = new Date();
    var month = today.getMonth() + 1;
    var year = today.getFullYear()%100;
    var selectedMonth = $( "#month" ).val();
    var selectedYear = $( "#year" ).val();

    //client side validation for empty field, credit card digits, and expiration date
    if (!firstname || !lastname || !creditcard)
    {
        //add error message
        $( "#messageDiv" ).html('Make sure you filled in all fields');
        $( "#messageDiv" ).css('color','red');
    }
    else if(creditcard.length !=16 || parseInt(creditcard).toString() != creditcard)
    {
        //add error message
        $( "#messageDiv" ).html('Make sure credit card is 16 digits');
        $( "#messageDiv" ).css('color','red');
    }
    else if(parseInt(selectedYear) < year || (parseInt(selectedYear) == year && parseInt(selectedMonth) < month))
    {
        //add error message
        $( "#messageDiv" ).html('Credit Card Expired!');
        $( "#messageDiv" ).css('color','red');
    }
    else
    {
        //validation passed, submit the form
        $( "#creditForm" ).submit();
    }


});

//hide the intro div and show movie selection
$( "#buyTicket" ).click(function() {
  $( "#initialPage" ).hide();
  $( "#movieSelection" ).css("display","block");
});

//change the movie wen time selection changed using AJAX
$( "#time" ).change(function() {
    var timeSelected = $('#time').find(":selected").text();
    var theaterID = $('#theater_id').val();
    var path = "/main/getShowTimeMovieList/" + theaterID + "/" + timeSelected;
    $.get(path, function (movieList) {
          $("#movieList").html(movieList);
    });
});