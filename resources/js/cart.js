
(function($){

    $('.item-quantity').on('change',function(e){
        $.ajax({
            url:'/cart/'+$(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            }
        });
    });
    $('.remove-item').on('click',function(e){
        let id = $(this).data('id');
        $.ajax({
            url:"/cart/" + id,
            method: 'delete',
            data: {
                _token: csrf_token,
            },
            success: response => {
                $(`#${id}`).remove();
            }
        });
    });
    $('.add-to-cart').on('click',function(e){
        let id = $('#quantity').val();
        $.ajax({
            url:"/cart",
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity:  id,
                _token: csrf_token,
            },
            success: response => {
                alert('product was added');
            }
        });
    });
})(jQuery);
