$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Vui lòng chọn',
        allowClear: true,
        theme: "classic",
        width: '100%'
    });
    $("#choosProduct").click(function() {
        var that = $(this), target = $(that.data('target')), route = target.data('route'), preview = $(target.data('preview'));
        $.ajax({
            url: route,
            type: 'GET',
            data: { product_id: target.val() },
        }).done(function(response) {
            preview.html(response.html);
            $(".total-order").html(formatNumber(response.total_price) + 'đ');
        }).fail(function(response) {

        })
    })
})
$(document).on('change', 'input[name="quantity[]"]', function(e) {
    var that = $(this), 
    price = $(that.parent('td').next()).find('select[name="price[]"]').val(), quantity = that.val(), 
    parent = $(that.parents('tr')), siblings = parent.siblings(), price_total = 0;
    if(siblings.length > 0) {
        $.each(siblings, function( index, elm ) {
            var siblings_quantity = $(elm).find('input[name="quantity[]"]').val(), 
            siblings_price = $(elm).find('select[name="price[]"]').val();
            price_total += siblings_quantity*siblings_price;
        });
        $(".total-order").html(formatNumber(price_total + price * quantity) + 'đ');
    }
    parent.find('td:last-child').html(formatNumber(price * quantity) + 'đ');
})

$(document).on('change', 'select[name="price[]"]', function(e) {
    var that = $(this), 
    quantity = $(that.parent('td').prev()).find('input[name="quantity[]"]').val(), 
    price = that.val(), 
    parent = $(that.parents('tr')), siblings = parent.siblings(), price_total = 0;
    if(siblings.length > 0) {
        $.each(siblings, function( index, elm ) {
            var siblings_quantity = $(elm).find('input[name="quantity[]"]').val(), 
            siblings_price = $(elm).find('select[name="price[]"]').val();
            price_total += siblings_quantity*siblings_price;
        });
        $(".total-order").html(formatNumber(price_total + quantity * price) + 'đ');
    }
    parent.find('td:last-child').html(formatNumber(quantity * price) + 'đ');
})