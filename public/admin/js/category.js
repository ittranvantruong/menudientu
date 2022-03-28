
$(document).ready(function () {

});
// thêm khu vực
$(document).on('submit', '#formAdd', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form.serialize(),
    }).done(function (response) {

        $('table tbody').prepend(response.data);
        $.toast({
            heading: 'Thành công',
            text: response.message,
            position: 'top-right',
            icon: 'success'
        });
        form.parsley().reset();
        form.trigger("reset");
    }).fail(function(response){
        $.map(response.responseJSON.errors, function(value) {
            value.forEach(element => {
                $.toast({
                    heading: 'Thất bại',
                    text: element,
                    position: 'top-right',
                    icon: 'error', 
                    hideAfter: 10000
                });
            })
        })
    }).always(function() {
        endAjax(form, 'Thêm');
    });
});


//hiển thị dữ liệu để sửa khu vực
$(document).on('click', '.edit-load', function () {
    var modal = $(this).data('modal'), 
    url = $(this).data('url'), 
    element = modal+' form';
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            // console.log($(element).find('img.show-avatar-user-secondary').attr('src'));
            $(element+' input[name="id"]').val(response.id);
            $(element+' input[name="name"]').val(response.name);
            $(element+' select[name="status"] option[value="'+response.status+'"]').prop('selected', true);
            $(element+' input[name="sort"]').val(response.sort);
            $(element+' input[name="type"]').prop('checked', response.type);
            $(modal).modal('show');
        },
        error: function () {
            $.toast({
                heading: 'Thất bại',
                text: 'Vui lòng tải lại trang',
                position: 'top-right',
                icon: 'error', 
                hideAfter: 10000
            });
        }
    });
});
//cập nhật khu vực
$(document).on('submit', '#formUpdate', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        type: "PUT",
        url: form.attr('action'),
        data: form.serialize(),
    }).done(function (response) {
        $('table tbody tr.item-'+response.replace).replaceWith(response.data);
        $.toast({
            heading: 'Thành công',
            text: response.message,
            position: 'top-right',
            icon: 'success'
        });
        $("#modalCategory").modal('hide');
        form.parsley().reset();
        form.trigger("reset");
    }).fail(function(response){
        $.map(response.responseJSON.errors, function(value) {
            value.forEach(element => {
                $.toast({
                    heading: 'Thất bại',
                    text: element,
                    position: 'top-right',
                    icon: 'error', 
                    hideAfter: 10000
                });
            })
        })
    }).always(function() {
        endAjax(form, 'Cập nhật');
    });
});
//xóa khu vực
$(document).on('click', '.delete', function (e) {
    if(!confirm('Bạn có chắc muốn xóa không')){
        return;
    }
    var that = $(this);
    $.ajax({
        url: that.data('action'),
        type: 'DELETE',
        data: { _token: token}
    }).done(function(response) {
        that.parents('tr').remove();
        $.toast({
            heading: 'Thất bại',
            text: response.message,
            position: 'top-right',
            icon: 'success', 
            hideAfter: 10000
        });
        
      })
      .fail(function() {
        $.toast({
            heading: 'Thất bại',
            text: "Thực hiện không thành công",
            position: 'top-right',
            icon: 'error', 
            hideAfter: 10000
        });
      })
    .always(function() {
        
      });
});