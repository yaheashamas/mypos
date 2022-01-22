$(document).ready(function(){

    //make button form disabled
    document.getElementById("add-oder-form-btn").disabled = true;

    //add require to order
    $('.add-product-btn').on('click',function(e){
        e.preventDefault();

        // info product
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');

        // table body
        var html =
            `<tr>
                <input type="hidden" value=${id} name="products[]">
                <td>${name}</td>
                <td>
                    <div class="input-group input-group-sm mb-3">
                        <input type="number" name="quantities[]" min='1' max='100' value="1" data-price=${price} class="form-control mb-3 product-quantities" >
                    </div>
                </td>
                <td class="product-price">${price}</td>
                <td><button class="btn btn-danger remove-product-btn" data-id=${id}><i class="fa fa-trash"></i></button></td>
            </tr>`;

        $('.order-list').append(html);

        //after click change button to disabled
        $(this).removeClass('btn-success').addClass('btn-default disabled');
        calculator();
    });

    //button delete
    $('body').on('click','.remove-product-btn',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        $(this).closest('tr').remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        calculator();
    });

    //change quantities input products
    $('body').on('keyup change','.product-quantities',function(){
        var quantities = $(this).val();
        var unitPrice = $(this).data('price');
        $(this).closest('tr').find('.product-price').html(quantities * unitPrice);
        calculator();
    });

});//end function document ready

// cal sum price
function calculator(){
    var sumPrice = 0 ;
    $('.order-list .product-price').each(function(index){
        sumPrice += parseInt($(this).html());
    });
    $('.total-price').html(sumPrice);

    //disabled button add order
    if (sumPrice > 0){
        document.getElementById("add-oder-form-btn").disabled = false;
    }else{
        document.getElementById("add-oder-form-btn").disabled = true;
    }
}

