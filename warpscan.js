
function getItem(tag) {
    $.ajax({
        type: 'GET',
        url: 'index.php/items/get/' + tag,
        async: false,
        dataType: 'json',
        success: function(data) {
            $('.tag').html(tag);
            $('#start').addClass('hidden message');
            $('#message').addClass('hidden message');
            if(data == false) {
                $('#unknown').removeClass('hidden message');
            }
            else {
                $('.name').html(data[0]['name']);
                $('.amount').html(data[0]['amount']);
                $('.chevrons').find('input[name="amount"]').val(1);
                $('#item').removeClass('hidden message');
            }
        }
    });
}

function newItem(tag, name, amount) {
    $.ajax({
        type: 'GET',
        url: 'index.php/items/new/' + tag + '/' + name + '/' + amount,
        async: false,
        dataType: 'json',
        success: function(data) {
            $('#message').html('<i class="checkmark icon"></i><div class="content"><div class="header">New item successfully added!</div></div>');
            $('#message').removeClass('hidden message');
            $('#message').addClass('success icon message');
            $('#new').addClass('hidden message');
            $('#startTag').val('');
            $('#start').removeClass('hidden message');
            $("#startTag").focus();
        }
    });
}

function addItem(tag, amount) {
    $.ajax({
        type: 'GET',
        url: 'index.php/items/add/' + tag + '/' + amount,
        async: false,
        dataType: 'json',
        success: function(data) {
            $('#message').html('<i class="checkmark icon"></i><div class="content"><div class="header">Item inventory successfully updated!</div></div>');
            $('#message').removeClass('hidden message');
            $('#message').addClass('success icon message');
            $('#item').addClass('hidden message');
            $('#startTag').val('');
            $('#start').removeClass('hidden message');
            $("#startTag").focus();
        }
    });
}

function removeItem(tag, amount) {
    $.ajax({
        type: 'GET',
        url: 'index.php/items/remove/' + tag + '/' + amount,
        async: false,
        dataType: 'json',
        success: function(data) {
            $('#message').html('<i class="checkmark icon"></i><div class="content"><div class="header">Item inventory successfully updated!</div></div>');
            $('#message').removeClass('hidden message');
            $('#message').addClass('success icon message');
            $('#item').addClass('hidden message');
            $('#startTag').val('');
            $('#start').removeClass('hidden message');
            $("#startTag").focus();
        }
    });
}

$('.scan').click(function () {
    var tag = $('#start').find('input[name="tag"]').val();
    document.getElementById('item-barcode-known').src = 'index.php/barcodes/' + tag + '.png';
    document.getElementById('item-barcode-unknown').src = 'index.php/barcodes/' + tag + '.png';
    getItem(tag);
});

$('.unknownAdd').click(function () {
    $('#unknown').addClass('hidden message');
    $('#new').removeClass('hidden message');
    $('.chevrons').find('input[name="amount"]').val(1);
});

$('.cancel').click(function () {
    location.reload(true);
});

$('.newSubmit').click(function () {
    var tag = $('.tag').html();
    var name = $('#new').find('input[name="name"]').val();
    var amount = $('#new').find('input[name="amount"]').val();
    newItem(tag, name, amount);
});

$('.itemAdd').click(function () {
    var tag = $('.tag').html();
    var amount = $('#item').find('input[name="amount"]').val();
    addItem(tag, amount);
});

$('.itemRemove').click(function () {
    var tag = $('.tag').html();
    var amount = $('#item').find('input[name="amount"]').val();
    removeItem(tag, amount);
});

$('.amountinc').click(function () {
    var amount = $('.chevrons').find('input[name="amount"]').val();
    amount = parseInt(amount) + 1;
    $('.chevrons').find('input[name="amount"]').val(amount);
});

$('.amountdec').click(function () {
    var amount = $('.chevrons').find('input[name="amount"]').val();
    amount = parseInt(amount) - 1;
    $('.chevrons').find('input[name="amount"]').val(amount);
});