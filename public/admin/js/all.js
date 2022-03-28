//biến golbal
var urlHome = jQuery('meta[name="url-home"]').attr('content'), 
token = jQuery('meta[name="csrf-token"]').attr('content'), 
urlAvatar = '/public/sbadmin2/img/undraw_profile.svg';

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }

//chỉnh sửa text trong datatable
function customDatatable(element = '#tableDatatable', options = []) {
    $(element).DataTable({
        columnDefs: [
            { orderable: false, targets: options }
        ],
        "language": {
            "emptyTable": "Không có dữ liệu nào !",
            "info": "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
            "infoEmpty": "Hiển thị 0 đến 0 trong số 0 mục nhập",
            "infoFiltered": "(Có _TOTAL_ kết quả được tìm thấy)",
            "lengthMenu": "Hiển thị _MENU_ bản ghi",
            "search": "Tìm kiếm",
            "zeroRecords": "Không có bản ghi nào tìm thấy !",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": '<i class="fas fa-angle-right"></i>',
                "previous": '<i class="fas fa-angle-left"></i>'
            }
        }
    });
}
function selectFileWithCKFinder( preview, in_value, type ) {
    var url_home = $('meta[name="url-home"]').attr('content');
	CKFinder.popup( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {

			finder.on( 'files:choose', function( evt ) {

				if(type == 'MULTIPLE'){
					var files = evt.data.files;

				    var html = '', url_file;
				    var value = $(in_value).val() ? $(in_value).val()+',' : '' ;
				    files.forEach( function( file, i ) {
						url_file = file.getUrl().replace(url_home, ''); 
				    	html += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <span data-route="0" data-url="${url_file}" class="delete-image-ckfinder">
                                        <i class="fas fa-times pointer"></i>
                                    </span>
                                    <img src="${file.getUrl()}" width="100%">
                                </div>`;
						if(i < files.length - 1){
							value += url_file + ',';
						}else{
							value += url_file;
						}
				    } );
				    $(preview).append(html);
				    $(in_value).val(value);
				}
				else{
                    var file = evt.data.files.first();
					$(preview).attr('src', file.getUrl());
					$(in_value).val(file.getUrl().replace(url_home, ''));
				}
			} );
		}
		
	} );
}
// function startAjax(element){
//     element = element.find('button[type="submit"]');
//     element.attr('disabled', 'disabled');
//     element.html('<span class="spinner-grow spinner-grow-sm"></span> Đang xử lý..');
// }
//sau khi thực hiện load dữ liệu thì sẽ gọi hàm này để tắt loading
function endAjax(element, text){

    element = element.find('button[type="submit"]');
    element.removeAttr('disabled');
    element.html(text);
    
    // $('.select2-selection__rendered').empty();
}
$(document).ready(function () {
    $("form").submit(function(){
        $(this).find("button[type='submit']").attr("disabled", "disabled");
        $(this).find("button[type='submit']").html('<span class="spinner-grow spinner-grow-sm"></span> Đang xử lý..');
    });

    $("button.submit-form").click(function(){
        if(!confirm("Bạn có muốn thực hiện?")){
            return;
        }
        $($(this).data('target')).submit();
    });
    // $("textarea.ckeditor").ckeditor();
    
});
// Hiện popup
$(document).on('click', '.open-modal', function () {
    $($(this).data('target')).modal("show");
});
//thông báo lỗi khi chưa chọn bản ghi để xử lý
$(document).on('submit', '#formMultiple', function(e) {
    if($('.check-list:checked').length == 0){
        e.preventDefault();
        $.toast({
            heading: 'Thông báo',
            text: 'Vui lòng chọn bản ghi để thực hiện',
            position: 'top-right',
            icon: 'warning'
        });
        endAjax($(this), 'Áp dụng');
    }
})
$(document).on('click', '.btn-delete', function () {
    if(!confirm("Bạn có muốn thực hiện?")){
        return;
    }
    var form = $(this).data('target'), action = $(this).data('action');
    $(form).attr('action', action);
    $(form).submit();
});

//check all
$(document).on('click', '.check-all', function(e) {
    $(".check-list").prop('checked', $(this).prop('checked'));
    if($(this).prop('checked') == true){
        $('.check-all').prop('checked', true);
        $(".action-multiple").removeAttr('style');
    }
    else{
        $('.check-all').prop('checked', false);
        $(".action-multiple").css('display', 'none');
    }
});

$(document).on('click', '.check-list', function(e) {
if($(this).prop('checked') == false){
    $('.check-all').prop('checked', false);
}
if($('.check-list:checked').length == $('.check-list').length){
    $('.check-all').prop('checked', true);
}
if($('.check-list:checked').length > 0){
    $(".action-multiple").removeAttr('style');
}else{
    $(".action-multiple").css('display', 'none');
}
});

$(document).on('click', '.add-image-ckfinder', function(event) {
	/* Act on the event */
	var preview = $(this).data('preview');
	
	var in_value = $(this).data('input');

	var type = $(this).data('type');
	selectFileWithCKFinder( preview, in_value, type );
});

$(document).on('click', '.delete-image-ckfinder', function(e) {
    if(!confirm('Bạn có muốn thực hiện ?')){
        return;
    }
	var that = $(this), route = that.data('route'), input = $("input[name='gallery']"), flag = true;
	deleteItemGallery(that, input);
	if(route != 0 && route != null){
		flag = delete_attribute_variation(route);
	}
    if(flag){
		that.parent().remove();
    }
});

function deleteItemGallery(that, input) {
	var url = that.data('url'), 
		url_file = input.val().replace(url, ''); 
        
	if(url_file.indexOf(',,') !== -1) {
		url_file = url_file.replace(',,', ',');	
	}
	if(url_file.indexOf(',') == 0) {
		url_file = url_file.slice(1);	
	}
	if(url_file.lastIndexOf(',') == url_file.length - 1) {
		url_file = url_file.slice(0, -1);	
	}
	console.log(url_file);
	input.val(url_file);

}

function deleteItemGalleryData(that, route, input){
	var token = $('meta[name="csrf-token"]').attr('content'),
		gallery = input.val();
	$.ajax({
		type: "DELETE",
		url: route,
		data: { _token: token, gallery: gallery },
	}).done(function(){
		that.parent().remove();
	}).fail(function(){
		$.toast({
            heading: 'Thất bại',
            text: 'Thực hiện không thành công',
            position: 'top-right',
            icon: 'error'
        });
	}).always(function(){

	});
}
