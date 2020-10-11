$(document).ready(function () {

    // add product btn
$('.add-product-btn').on('click', function(e){
    e.preventDefault();
    var name = $(this).data('name');
    var id = $(this).data('id');
    var price = $.number($(this).data('price'), 2);


    var html2 = 
    `<tr>
        <td>${name}</td>
        <td><input type="number" name="quantities[]" data-price=${price} class="form-control input-sm product-quantity" min="1" value="1"></td>
        <td class="product-price">${price}</td>
        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id=${id}><span class="fa fa-trash"></span></button></td>

    </tr>`;
    $('.order-list').append(html2);
    calculate_total();

    $(this).removeClass('btn-success').addClass('btn-default disabled');
});

//disabled btn
$('body').on('click', '.disabled', function(e){
    e.preventDefault();
});


// remove product btn
$('body').on('click','.remove-product-btn', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
    $(this).closest('tr').remove();
    calculate_total();

}); //end of remove-product-btn

//change quantity btn
$('body').on('change keyup', '.product-quantity', function(e){
    e.preventDefault();
    var price = $(this).data('price');
    var quantity = Number($(this).val());
    $(this).closest('tr').find('.product-price').html($.number(price * quantity, 2));
    calculate_total();
}); //end of oriduct quantity


}); //end of document ready


//calculate total
function calculate_total(){
    var price = 0;
    $('.order-list .product-price').each(function(index){
        price += parseFloat($(this).html().replace(/,/g,''));
        //price += Number($(this).html());
    });

    $('.total-price').html($.number(price,2));

    //check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled');
    } else {
        $('#add-order-form-btn').addClass('disabled');
    }
}