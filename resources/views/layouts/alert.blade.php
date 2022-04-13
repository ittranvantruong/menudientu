<style>
	.alert{
		text-align: center;
		padding: 15px !important;
	}
</style>
<script>
$(document).ready(function(){
@if ($message = Session::get('success'))
	$.toast({
            heading: 'Notification',
            text: '{{ $message }}',
            position: 'top-right',
            icon: 'success'
        });
@endif


@if ($message = Session::get('error'))
	$.toast({
            heading: 'Notification',
            text: '{{ $message }}',
            position: 'top-right',
            icon: 'error'
        });
@endif


@if ($message = Session::get('warning'))
	$.toast({
            heading: 'Notification',
            text: '{{ $message }}',
            position: 'top-right',
            icon: 'warning',
            hideAfter: 10000
        });
@endif


@if ($message = Session::get('info'))
	$.toast({
            heading: 'Notification',
            text: '{{ $message }}',
            position: 'top-right',
            icon: 'warning'
        });
@endif


@if ($errors->any())
@foreach($errors->all() as $val)
	$.toast({
            heading: 'Notification',
            text: '{{ $val }}',
            position: 'top-right',
            icon: 'warning',
            hideAfter: 10000
        });
@endforeach
@endif
});
</script>