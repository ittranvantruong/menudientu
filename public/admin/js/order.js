function getTotalPrice(elm = 'table tbody tr'){
    var total = 0;
    if($(elm).length == 0){
        return total;
    }
    $(elm).each(function(index, elm){
        total += $(elm).find('input[name="quantity[]"]').val() * $(elm).find('select[name="price[]"]').val();
    });
    return total;

}
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Vui lòng chọn',
        allowClear: true,
        theme: "classic",
        width: '100%'
    });
    
})
$(document).on('click', '#choosProduct', function(e) {
    var that = $(this), target = $(that.data('target')), 
    route = that.data('route'), 
    preview = $(that.data('preview'));
    if($(that.data('target')+':checked').length == 0){
        $.toast({
            heading: 'Thất bại',
            text: 'Vui lòng chọn món ăn',
            position: 'top-right',
            icon: 'warning'
        });
        return;
    }
    var values = target.map(function(index, el){
        if(el.checked){
            return $(this).val();
        }
    }).get();
    $.ajax({
        url: route,
        type: 'GET',
        data: { product_id: values },
    }).done(function(response) {
        preview.find('.default').remove();
        preview.append(response.html);
        target.prop('checked', false);
        $(".total-order").html(formatNumber(getTotalPrice('table.product-order tbody tr')) + currency);
    }).fail(function(response) {
        $.toast({
            heading: 'Thất bại',
            text: 'Chọn món ăn không thành công',
            position: 'top-right',
            icon: 'error'
        });
    })
});
$(document).on('submit', '#formAdd', function(e) {
    if($(this).find('input[name="product_id[]"]').length == 0){
        $.toast({
            heading: 'Thất bại',
            text: 'Vui lòng chọn món ăn',
            position: 'top-right',
            icon: 'warning'
        });
        e.preventDefault();
        endAjax($(this), 'Thêm');
        return;
    }
});
$(document).on('change', 'input[name="quantity[]"]', function(e) {
    var that = $(this), 
    price = $(that.parent('td').next()).find('select[name="price[]"]').val(), quantity = that.val(), 
    parent = $(that.parents('tr'));
    
    parent.find('td:last-child').html(formatNumber(price * quantity) + currency);
    $(".total-order").html(formatNumber(getTotalPrice('table.product-order tbody tr')) + currency);

})

$(document).on('change', 'select[name="price[]"]', function(e) {
    var that = $(this), 
    quantity = $(that.parent('td').prev()).find('input[name="quantity[]"]').val(), 
    price = that.val(), 
    parent = $(that.parents('tr'));
    
    parent.find('td:last-child').html(formatNumber(quantity * price) + currency);

    $(".total-order").html(formatNumber(getTotalPrice('table.product-order tbody tr')) + currency);
});
$(document).on('click', '.remove-product-order', function(e) {
    var that = $(this), parent = that.parents('tr');
    parent.remove();
    
    $(".total-order").html(formatNumber(getTotalPrice('table.product-order tbody tr')) + currency);
})

