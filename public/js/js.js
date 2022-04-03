var flag = true;
function endAjax(element, text) {

    element = element.find('button[type="submit"]');
    element.removeAttr('disabled');
    element.html(text);

    // $('.select2-selection__rendered').empty();
}
$(document).ready(function(){
    $("form").submit(function () {
        $(this).find("button[type='submit']").attr("disabled", "disabled");
        $(this).find("button[type='submit']").html('<span class="spinner-grow spinner-grow-sm"></span> Đang xử lý..');
    });
});
$(document).on("click", ".add-to-cart", function(){
    var route = $(this).data("route");
    $.ajax({
        url: route,
        method: "GET",
        success: function(response){
            $("#modalAddToCart").modal("show");
            $("#formAddToCart select[name='size']").html(response.html);
            $("#formAddToCart input[name='id']").val(response.id);
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        }
    });
});

$(document).on("submit", "#formAddToCart", function(e){
    e.preventDefault();
    var form = $(this), action = $(this).attr("action"), cart = $(".cart span.badge"), count = parseInt(cart.data("count")) + parseInt(form.find("input[name='quantity']").val());
    $.ajax({
        url: action,
        method: "POST",
        data: form.serialize(),
        success: function(response){
            $("#modalAddToCart").modal("hide");
            cart.data("count", count);
            cart.text(count);
            $.toast({
                heading: 'Thông báo',
                text: 'Thêm thành công',
                position: 'top-right',
                icon: 'success'
            });
            form.trigger("reset");
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        },
        complete: function(){
            endAjax(form, 'Xác nhận');
        }
    });
});

$(document).on("change", "input[name='item_quantity']", function(e){
    flag = false;
    var input = $(this), quantity = input.val(), 
    size = input.parent('.item-quantity').siblings('.item-size').find("select[name='item_size']").val(), 
    id = input.parents(".item-cart").data("id"), 
    form = $("#formUpdateCart"), action = form.attr("action");

    form.find("input[name='id']").val(id);
    form.find("input[name='quantity']").val(quantity);
    form.find("input[name='size']").val(size);
    $.ajax({
        url: action,
        method: "PUT",
        data: form.serialize(),
        success: function(response){
            form.trigger("reset");
            flag = true;
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        }
    });
});
$(document).on("change", "select[name='item_size']", function(e){
    flag = false;
    var input = $(this), size = input.val(), 
    quantity = input.parent('.item-size').siblings('.item-quantity').find("input[name='item_quantity']").val(), 
    id = input.parents(".item-cart").data("id"), 
    form = $("#formUpdateCart"), action = form.attr("action");

    form.find("input[name='id']").val(id);
    form.find("input[name='quantity']").val(quantity);
    form.find("input[name='size']").val(size);
    $.ajax({
        url: action,
        method: "PUT",
        data: form.serialize(),
        success: function(response){
            form.trigger("reset");
            flag = true;
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        }
    });
});
$(document).on("click", ".delete-item-cart", function(e){
    if(!confirm('Bạn có chắc muốn xóa ?')){
        return;
    }
    var that = $(this), action = that.data("route"), form = $("#formDeleteItemCart");
    form.attr("action", action);
    $.ajax({
        url: action,
        method: "DELETE",
        data: form.serialize(),
        success: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Đã xóa món ăn khỏi giỏ hàng',
                position: 'top-right',
                icon: 'success'
            });
            that.parents('.item-cart').remove();
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        }
    });
});
$(document).on("submit", "#formOrder", function(e){
    
    if(!flag){
        e.preventDefault();
        endAjax($(this), 'Đặt món ăn');
    }
});
$(document).on('click', '#quick-alo-phoneIcon', function(e){
    $("#formCallEmployee").submit();    
});

$(document).on('submit', '#formCallEmployee', function(e){
    e.preventDefault();
    var form = $(this), action = form.attr('action');
    $.ajax({
        url: action,
        method: "POST",
        data: form.serialize(),
        success: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Đã gọi nhân viên',
                position: 'top-right',
                icon: 'success'
            });
        },
        error: function(response){
            $.toast({
                heading: 'Thông báo',
                text: 'Vui lòng chọn tải lại trang',
                position: 'top-right',
                icon: 'error'
            });
        }
    });
});
