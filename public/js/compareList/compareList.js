$(function() {
    /**
     * Set serch stock code.
     */
    $('#serch_code').change(function(){
        if (String($(this).val()).length == 4){
            //検索リンク一覧を表示処理
            $("#displaySearch").css("display","block");

            var cnt = 0;
            var setLink = [
                "https://www.buffett-code.com/company/",
                "https://kabuyoho.ifis.co.jp/index.php?action=tp1&sa=report_top&bcode=",
                "https://twitter.com/search?src=typd&q="
            ];
            var setName = "WEB SITE";
            //リンクをセット
            $('a.setSearchValue').each(function (){
                const link = setLink[cnt] + $('#serch_code').val() + "";
                $(this).attr('href',link);

                cnt = cnt + 1;
            });

            $("#setStockCode").text( setName + "    [ Stock code : " + $('#serch_code').val() + " ]");

        } else {
            $("#displaySearch").css("display","none");
        }
    });

    /**
     * Validater setting for evaluation list regist
     */
    var buyValid = {
        rules:{
            evaluation_id:{
                required:true,
                numType:true
            },
            date:{
                required:true,
                dateType:true
            },
            stock_code:{
                required:true,
                stockCodeType:true
            },
            price:{
                required:true,
                numType:true
            },
            expectancy:{
                required:true,
                numType:true
            }
        }
    };

    /**
     * Validater setting for evaluation list regist
     */
    var sellValid = {
        rules:{
            evaluation_id:{
                required:true,
                numType:true
            },
            date:{
                required:true,
                dateType:true
            },
            stock_code:{
                required:true,
                stockCodeType:true
            },
            price:{
                required:true,
                numType:true
            },
            description:{
                required:true
            }
        }
    };

    /**
     * 購入リスト新規追加
     */
    $('#buy-regist').click(function() {
        // evaluation_idの取得と反映
        var evaluation_id = $('[name="stock_code"] option:selected').attr("data-id");
        $('#buy').find('input[name="evaluation_id"]').val(evaluation_id); 

        //フォームバリデーション
        $('#buy').validate(buyValid);
        if (!$('#buy').valid()) {
            return false;
        }

        //送信ボタンを不活性にする。 
        var button = $(this);
        button.attr("disabled", true);

        var data= {
            evaluation_id: $('#buy').find('input[name="evaluation_id"]').val(),
            date: $('#buy').find('input[name="date"]').val(),
            price: $('#buy').find('input[name="price"]').val(),
            expectancy: $('#buy').find('input[name="expectancy"]').val()
        };

        $.ajaxSetup();
        $.ajax({
            type: "POST",
            url: "/compare/buy",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            beforeSend: function(xhr){
                xhr.overrideMimeType('application/json;charset=utf-8');
            },
            success: function(json_data){
                console.log(json_data.data);
                // if (!json_data.data[0]) {
                //     alert("Transaction error. " + json_data[1]);
                // }
                console.log(json_data.data);
                location.reload();
            },
            error: function(data) {
                alert("Server Error. Please try again later.\n" + data);
            },
            always: function() {
                button.attr("disabled",false);
            }
        });
    });

    /**
     * 売却リスト新規追加
     */
    $('#sell-regist').click(function() {
        //フォームバリデーション
        $('#sell').validate(sellValid);
        if (!$('#sell').valid()) {
            return false;
        }

        //送信ボタンを不活性にする。 
        var button = $(this);
        button.attr("disabled", true);

        var data= {
            evaluation_id: $('#sell').find('input[name="evaluation_id"]').val(),
            date: $('#sell').find('input[name="date"]').val(),
            price: $('#sell').find('input[name="price"]').val(),
            expectancy: $('#sell').find('textarea[name="description"]').val()
        };

        $.ajaxSetup();
        $.ajax({
            type: "POST",
            url: "/compare/sell",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            beforeSend: function(xhr){
                xhr.overrideMimeType('application/json;charset=utf-8');
            },
            success: function(json_data){
                console.log(json_data.data);
                // if (!json_data.data[0]) {
                //     alert("Transaction error. " + json_data[1]);
                // }
                console.log(json_data.data);
                location.reload();
            },
            error: function(data) {
                alert("Server Error. Please try again later.\n" + data);
            },
            always: function() {
                button.attr("disabled",false);
            }
        });
    });
});