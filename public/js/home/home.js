$(function() {
    //共通関数の呼び出し
    var sleep = window.commonLib.sleep;


    //名言リスト
    var quoteList = [
      "Price is what you pay. Value is what you get.",
      "Predicting rain doesn’t count. Building arks does.",
      "Be fearful when others are greedy and greedy only when others are fearful.",
      "Beware the investment activity that produces applause. The great moves are usually greeted by yawns.",
      "Buy a stock the way you would buy a house. Understand and like it such that you’d be content to own it in the absence of any market.",
      "Culture, more than rule books, determines how an organization behaves.",
      "Derivatives are financial weapons of mass destruction.",
      "Do not save what is left after spending. Instead spend what is left after saving.",
      "Games are won by players who focus on the playing field, not by those whose eyes are glued to the scoreboard.",
      "Honesty is a very expensive gift. Don’t expect it from cheap people.",
      "I always knew I was going to be rich. I don’t think I ever doubted it for a minute.",
      "I don’t look to jump over 7-foot bars. I look around for 1-foot bars that I can step over.",
      "I learned to go into business only with people whom I like, trust, and admire.",
      "I measure success by how many people love me.",
      "I never attempt to make money on the stock market. I buy on the assumption that they could close the market the next day and not reopen it for five years.",
      "If a business does well, the stock eventually follows."
    ];

    /**
     * 名言リストランダム表示(初回)
     */
    $(document).ready(function(){
      var displayQuote = getRandomQuote(quoteList);
      $('div#quote').text(displayQuote);
    });

    /**
     * 名言リストランダム表示(3秒間隔)
     */
    setInterval(function() {
      var displayQuote = getRandomQuote(quoteList);
      showQuote(displayQuote);
    }, 7000);
    
    /**
     * 名言リストからランダムな名言を取得
     * @param array list 
     * @return string quote
     */
    var getRandomQuote = function(list){
      var idx = Math.floor( Math.random() * list.length );
      var quote = String(idx + 1) + ".  " + list[idx];
      return quote;
    };

    /**
     * 名言を表示
     * @param {*} word
     */
    var showQuote = function(word){
      $('div#quote').hide().text(word).fadeIn("slow");
    };
});