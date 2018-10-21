// A simple templating method for replacing placeholders enclosed in curly braces.
if (!String.prototype.supplant) {
    String.prototype.supplant = function (o) {
        return this.replace(/{([^{}]*)}/g,
            function (a, b) {
                var r = o[b];
                return typeof r === 'string' || typeof r === 'number' ? r : a;
            }
        );
    };
}

$(function () {
   
    var ticker = $.connection.stockTickerMini, // the generated client-side hub proxy
        upcss =  'S_Up',
        downcss =  'S_Down',
        unchangedcss = 'S_UnChanged',
        up = USGFXPath+'ImagesN/Symbols/up.png',
        down = USGFXPath+'ImagesN/Symbols/down.png',
        unchanged = USGFXPath + 'ImagesN/Symbols/unchanged.png',
        $stockTable = $('#Usg-Marquee'),
        $stockTableBody = $stockTable.find('#marq'),
        //rowTemplate = '<tr data-symbol="{Symbol}"><td>{Symbol}</td><td>{Price}</td><td>{PPrice}</td><td>{Direction} {Change}</td><td>{PercentChange}</td></tr>';
        rowTemplate = '<li data-symbol="{Symbol}" class="marqContent" style="visibility: hidden"><img src="{SymbolA}"  /><img src="{SymbolB}"  /><img class="StockReplayce" src={Direction}  /><span class="StockReplayce">{Symbol} {Price}/{PPrice}</span></li>',
        replaceImage = '<div class="StockReplayce {Direction}"   ></div>',
        replaceSpan = '<span class="StockReplayce text-nowrap">{Symbol} {Price}/{PPrice}</span>';

    function formatStock(stock) {
        return $.extend(stock, {
            SymbolA: USGFXPath + 'ImagesN/Symbols/' + stock.SymbolA + '.png',
            SymbolB: USGFXPath + 'ImagesN/Symbols/' + stock.SymbolB + '.png',
            Price: stock.Price,
            PercentChange: (stock.PercentChange * 100).toFixed(2) + '%',
            Change: stock.Change.toFixed(7),
            Direction: stock.Change === 0 ? unchangedcss : stock.Change >= 0 ? upcss : downcss
        });
    }

    function init() {
        //ticker.server.getAllStocks().done(function (stocks) {
        //    $stockTableBody.empty();
        //    $.each(stocks, function () {
        //        var stock = formatStock(this);
        //        $stockTableBody.append(rowTemplate.supplant(stock));
        //    });
        //});
    }

    // Add a client-side hub method that the server will call
    //ticker.client.updateStockPrice = function (stock) {
    //    var displayStock = formatStock(stock),
    //        //$row = $(rowTemplate.supplant(displayStock));
    //        $replace = $(replaceImage.supplant(displayStock));

    //    //$stockTableBody.find('li[data-symbol=' + stock.Symbol + ']')
    //    //    .replaceWith($row);
    //    $target=$stockTableBody.find('li[data-symbol=' + stock.Symbol + ']');//
    //    $target.find('img.StockReplayce').replaceWith($replace);
    //    $replace = $(replaceSpan.supplant(displayStock));
    //    $target.find('span.StockReplayce').replaceWith($replace);
    //}
    ticker.client.updateStockPrices = function (list) {
        //var displayStock = formatStock(stock),
        //    //$row = $(rowTemplate.supplant(displayStock));
        //    $replace = $(replaceImage.supplant(displayStock));

        ////$stockTableBody.find('li[data-symbol=' + stock.Symbol + ']')
        ////    .replaceWith($row);
        //$target = $stockTableBody.find('li[data-symbol=' + stock.Symbol + ']');//
        //$target.find('img.StockReplayce').replaceWith($replace);
        //$replace = $(replaceSpan.supplant(displayStock));
        //$target.find('span.StockReplayce').replaceWith($replace);
        list.forEach(function addNumber(value) {
            var displayStock = formatStock(value), $replace = $(replaceImage.supplant(displayStock));
            $target = $stockTableBody.find('li[data-symbol=' + value.Symbol + ']');//
            $target.find('div.StockReplayce').replaceWith($replace);
            $replace = $(replaceSpan.supplant(displayStock));
            $target.find('span.StockReplayce').replaceWith($replace);
        });
        //for (var stock in list) {
        //    alert(stock);
        //}
        
    }
    // Start the connection
    $.connection.hub.start().done(function () {
        //ticker.server.getUpdateInfo();
    });
    

});