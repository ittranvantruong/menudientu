<div class="modal fade" id="modalAddToCart">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddToCart" action="{{ route('store.cart') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="modal2">{{ __('layout.addToCart') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-3">
                        <input type="number" class="form-control" name="quantity" min="1" required value="1">
                    </div>
                    <div class="col-9">
                        <select class="form-control" required name="size">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ __('layout.confirm') }}</button>
                </div>
        </div>
        </form>
    </div>
</div>