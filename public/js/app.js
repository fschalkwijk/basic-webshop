$(document).ready(function(){
    $('.add-product, .remove-product').click(changeProductAmount);
});

function changeProductAmount(e){
    e.preventDefault();

    ajaxChangeProductAmount($(this).attr('href'), $(this).data('product-id'));
}

function ajaxChangeProductAmount(url, product_id){
    ajaxRequest({
        url: url,
        method: 'GET',
        dataType: 'json'
    }, function(data){
        if(data.result){
            $('#product-amount-'+product_id).val(data.items[product_id].amount);

            updateProductsTable(data);

            $(".total-product-amount").html(data.total_products);
        } else{
            alert(data.error);
        }
    });
}

function ajaxRequest(setup, callback){
    $.ajax(setup)
        .done(callback)
        .error(function(data){
            console.log(data);
        });
}

function updateProductsTable(data){
    var table = $('.cart-table');

    if(!table)
        return;

    $(".total-vat", table).html('&euro; '+formatMoney(data.total_vat));
    $(".total-price", table).html('&euro; '+formatMoney(data.total_price));

    var tbody = $("tbody", table);
    tbody.children().remove();

    for(i in data.items)
        tbody.append(createProductTableRow(data.items[i]));

    $('.add-product, .remove-product', tbody).click(changeProductAmount);
}

function createProductTableRow(item){
    var row = $('<tr></tr>');

    row.append('<td>'+item.product.id+'</td>');
    row.append('<td>'+item.product.title+'</td>');
    row.append('<td>&euro; '+formatMoney(item.product.price)+'</td>');
    row.append(createProductTableAmountField(item));
    row.append('<td>&euro; '+formatMoney(item.product.price * item.amount)+'</td>');

    return row;
}

function createProductTableAmountField(item){
    return '<td> \
        <div class="input-group" style="max-width: 150px"> \
        <span class="input-group-btn"> \
        <a class="btn btn-default add-product" \
        href="'+product_remove_url.replace('product_id', item.product.id).replace('amount', 1)+'" \
        data-product-id="'+item.product.id+'"> \
        <span class="glyphicon glyphicon-minus"></span> \
        </a> \
        </span> \
        <input \
        type="number" \
        min="0" \
        step="1" \
        value="'+item.amount+'" \
        name="amount" \
        class="form-control product-amount" \
        id="product-amount-'+item.product.id+'" \
        data-product-id="'+item.product.id+'"> \
        <span class="input-group-btn"> \
        <a class="btn btn-default remove-product" \
        href="'+product_add_url.replace('product_id', item.product.id).replace('amount', 1)+'" \
        data-product-id="'+item.product.id+'"> \
        <span class="glyphicon glyphicon-plus"></span> \
        </a> \
        </span> \
        </div> \
        </td>';
}

function formatMoney(number){
    decPlaces = 2;
    thouSeparator = '.';
    decSeparator = ',';

    var n = number,
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSeparator = decSeparator == undefined ? "." : decSeparator,
        thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
        sign = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + (n-i == 0? '-' : Math.abs(n - i).toFixed(decPlaces).slice(2)) : "");
};
