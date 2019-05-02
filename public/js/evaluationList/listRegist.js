$(function(){
/*
-- Validater setting for evaluation list regist
*/
var listValid = {
    rules:{
        evaluate_date:{
            required:true,
            dateType:true
        },
        stock_code:{
            required:true,
            stockCodeType:true
        },
        name:{
            required:true,
            maxlength:20
        },
        comment:{
            required:false
        },
        point:{
            required:true,
            numType:true
        },
        next_check:{
            required:false,
            dateType:true
        }
    }
}

/*
-- Regist new evaluation list.
*/
$('#list-regist').click(function(){
    //Form validation
    $('#regist').validate(listValid);
    if (!$('#regist').valid()) {
        return false;
    };

    //送信ボタンを不活性にする。 
    var button = $(this);
    button.attr("disabled", true);

    var data= {
        evaluate_date: $('input[name="evaluate_date"]').val(),
        stock_code: $('input[name="stock_code"]').val(),
        name: $('input[name="name"]').val(),
        comment: $('textarea[name="comment"]').val(),
        point: $('input[name="point"]').val(),
        next_check: $('input[name="next_check"]').val(),
    };
    console.log(data);

    $.ajaxSetup();
    $.ajax({
        type: "POST",
        url: "/list",
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
        beforeSend: function(xhr){
            xhr.overrideMimeType('application/json;charset=utf-8');
        },
        success: function(json_data){
            console.log(json_data.data);
            if (!json_data.data[0]) {
                alert("Transaction error. " + json_data[1]);
                return;
            }
            console.log(json_data.data);
            location.reload();
        },
        error: function(data) {
            alert("Server Error. Please try again later.\n" + data);
        },
        always: function() {
            button.attr("disable",false);
        }
    })
});
});