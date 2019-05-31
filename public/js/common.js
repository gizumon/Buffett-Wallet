(function(){
    "use strict"

    /*
    ------------------
    -- Common script--
    ------------------
    */
    //初期値に本日日付けを定義
    $(document).ready(function(){
	    var today = new Date();
        today.setDate(today.getDate());
        var yyyy = today.getFullYear();
        var mm = ("0"+(today.getMonth()+1)).slice(-2);
        var dd = ("0"+today.getDate()).slice(-2);
        $('.today').val(yyyy+'-'+mm+'-'+dd);
    });

    /*
    ------------------
    --- Validator ---
    ------------------
    */
    //Date format
    jQuery.validator.addMethod("dateType", function(value, element) {
        return this.optional(element) || /\d{4}\-\d{2}\-\d{2}/.test(value);
    }, "Please input in yyyy/mm/dd format...");

    //Stock code format
    jQuery.validator.addMethod("stockCodeType", function(value, element) {
        return this.optional(element) || /^\d{4}/.test(value);
    }, "Please input stock code in 4 number...");

    //number type format
    jQuery.validator.addMethod("numType", function(value, element) {
        return this.optional(element) || /^\d{1,3}/.test(value);
    }, "Please input in only number...");

    /*
    ------------------------
    -- ajax csrf setup --
    ------------------------
    */
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

  //他ファイルから参照
    /**
    * Sleep機能
    */
    function sleep(waitSec, callbackFunc) {
      var spanedSec = 0;
      var waitFunc = function () {
      spanedSec++;
    
        if (spanedSec >= waitSec) {
            if (callbackFunc) callbackFunc();
            return;
        }
        clearTimeout(id);
        id = setTimeout(waitFunc, 1000);
    };
  
    var id = setTimeout(waitFunc, 1000);
    };

  window.commonLib = window.commonLib || {};
  window.commonLib.sleep = sleep;
})();
