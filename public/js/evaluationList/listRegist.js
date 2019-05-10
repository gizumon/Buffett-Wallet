$(function(){
    /**
     * Set serch stock code.
     */
    $('#serch_code').blur(function(){
        if (String($(this).val()).length == 4){
            //検索リンク一覧を表示処理
            $("#displaySearch").css("display","block");

            var cnt = 0;
            var setLink = [
                "https://www.buffett-code.com/company/",
                "https://kabuyoho.ifis.co.jp/index.php?action=tp1&sa=report_top&bcode=",
                "https://twitter.com/search?src=typd&q="
            ];
            //リンクをセット
            $('a.setSearchValue').each(function (){
                const link = setLink[cnt] + $('#serch_code').val() + "";
                $(this).attr('href',link);

                cnt = cnt + 1;
            });

            $("#setStockCode").text($("#setStockCode").text() + "    [ Stock code : " + $('#serch_code').val() + " ]");

        } else {
            $("#displaySearch").css("display","none");
        }
    });

    /**
     * Validater setting for evaluation list regist
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

    /**
     * Regist new evaluation list.
     */
    $('#list-regist').click(function(){
        //フォームバリデーション
        $('#regist').validate(listValid);
        if (!$('#regist').valid()) {
            return false;
        };

        //送信ボタンを不活性にする。 
        var button = $(this);
        button.attr("disabled", true);

        var data= {
            evaluate_date: $('#regist').find('input[name="evaluate_date"]').val(),
            stock_code: $('#regist').find('input[name="stock_code"]').val(),
            name: $('#regist').find('input[name="name"]').val(),
            comment: $('#regist').find('textarea[name="comment"]').val(),
            point: $('#regist').find('input[name="point"]').val(),
            next_check: $('#regist').find('input[name="next_check"]').val(),
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
                }
                console.log(json_data.data);
                location.reload();
            },
            error: function(data) {
                alert("Server Error. Please try again later.\n" + data);
            },
            always: function() {
                button.attr("disabled",false);
            }
        })
    });

    /**
     * Editボタン押下時に、
     */
    $('.btnInfo').click(function() {
        // レコードIDを取得。
        var id = $(this).attr("data-id");
        console.log(id);
        
        //セットデータの取得。
        var stockCode = $("td#stockCodeRow_" + id).text();
        var name = $("td#nameRow_" + id).text();
        var comment = $("td#commentRow_" + id).text();
        var point = $("td#pointRow_" + id).text();

        //モーダルにデータをセット
        $("#targetStockCode").val(stockCode);
        $("#targetName").val(name);
        $("#targetComment").val(comment);
        $("#targetPoint").val(point);

        return true;
    });
    
    /**
     * Update existing evaluation list.
    */
    $('#list-update').click(function(){
        //バリデーション
        $('#update').validate(listValid);
        if (!$('#update').valid()) {
            return false;
        };

        //送信ボタンを不活性にする。 
        var button = $(this);
        button.attr("disabled", true);

        var data= {
            id: $('#update').find('input[name="evaluation_id"]').val(),
            evaluate_date: $('#update').find('input[name="evaluate_date"]').val(),
            stock_code: $('#update').find('input[name="stock_code"]').val(),
            name: $('#update').find('input[name="name"]').val(),
            comment: $('#update').find('textarea[name="comment"]').val(),
            point: $('#update').find('input[name="point"]').val(),
            next_check: $('#update').find('input[name="next_check"]').val(),
        };

        console.log(data);

        $.ajaxSetup();
        $.ajax({
            type: "PATCH",
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
                }
                console.log(json_data.data);
                location.reload();
            },
            error: function(data) {
                alert("Server Error. Please try again later.\n" + data);
            },
            always: function() {
                button.attr("disabled",false);
            }
        })
    });
});