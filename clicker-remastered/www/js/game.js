$(document).ready(function () {
    var $gainingPerSecond = $('.gaining-per-second');
    var $totalMoneyAmount = $('.total-money-amount');

    var getFormattedAmount = function (amount) {
        if (amount == 0) {
            return currency.chlebu;
        } else if (amount == 1) {
            return amount + ' ' + currency.chleba;
        } else if (amount >= 2 && amount <= 4) {
            return amount + ' ' + currency.chleby;
        } else {
            return amount + ' ' + currency.chlebu;
        }
    }
    load();

    function refreshInventory() {
        console.log(inventory);
        var content = '';
        for (let item of inventory) {
            var elementImg = '<img class="item-img" src ="' + item.img + '">';
            var elementCount = '<span class="item-count">' + item.count + 'x</span>';
            var elementPrice = '<span class="item-price">' + getFormattedAmount(buyItemFromStore(item.namePrivate, true, false)) + '</span>';
            var elementName = '<span class="item-name">' + item.namePublic + '</span>';
            content += '<li id="' + item.namePublic + '" class="product-row" data-name-private="' + item.namePrivate + '">' +
                elementImg + elementName + elementCount + elementPrice + '</li>';
        }
        $('#inventory').html(content);
        // drawMiddleContent(inventory);
    }

    function getProductFromInvetoryByName(name) {
        for (let item of inventory) {
            if (item.namePrivate == name) {
                return item;
            }
        }

        return null;
    }

    function getTotalAmountOfProperty(property) {
        var result = 0;
        for (let item of inventory) {
            result = item.property * item.count;
        }

        return result;
    }

    function buyItemFromStore(privateName, getPriceForNextLevel, refresh) {
        for (let item of inventory) {
            if (item.namePrivate == privateName) {
                var nextLevel = getPriceForNextLevel ? 1 : 0;
                var currentPrice = item.price * item.increasment * (item.count + nextLevel);
                if (getPriceForNextLevel) {
                    return currentPrice;
                }
                if (money >= currentPrice) {
                    item.count++;
                    money -= currentPrice;
                    if (refresh) {
                        update();
                        refreshInventory();
                    }
                }
            }
        }
        return null;
    }

    $('body').on('click', '.product-row', function () {
        var privateName = $(this).data('name-private');
        buyItemFromStore(privateName, false, true);
    });

    $('body').on('click', '#save', function () {
        save();
    });

    $('body').on('click', '#load', function () {
        load();
    });

    $('#click-btn').on('click', function () {
        add();
    });

    function update() {
        document.title = getFormattedAmount(money);
        $totalMoneyAmount.text(getFormattedAmount(money));
        $gainingPerSecond.text(getFormattedAmount(getTotalAmoutOfPerSecondGenerate()) + ' per/s');
    };

    function save() {

    }

    function load() {
        inventory = getDefaultInventory();
        refreshInventory();
    }

    var amountToCallApi = 5;
    var amountCurrent = 0;

    function add() {
        money = money + 1;
        amountCurrent++;
        if (amountCurrent >= amountToCallApi) {
            $.get(links.increaseMoney, function (data, status) {
                console.log(data);
                console.log(status);
            });
            amountCurrent = 0;
        }
        update();
    }

    function getTotalAmoutOfPerSecondGenerate() {
        var result = 0;
        for (let item of inventory) {
            result += (item.count * item.perSecondGenerate);
        }

        return result;
    }

    setInterval(function () {
        var getTotalAmoutOfPerSecondGenerateVar = getTotalAmoutOfPerSecondGenerate();
        money += getTotalAmoutOfPerSecondGenerateVar;
        $gainingPerSecond.text(getTotalAmoutOfPerSecondGenerateVar);
        $totalMoneyAmount.text(money);
        update();
        save();
    }, 1000);
});