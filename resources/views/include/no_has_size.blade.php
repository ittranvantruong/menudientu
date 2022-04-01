@foreach($product as $item1)
                    <div class="row no-gutters item">
                        <div class="col-3 col-sm-3 pic">
                            <img src="{{asset($item1->avatar)}}">
                        </div>
                        <div class="col-9 col-sm-9 text">
                            <div class="row food-detail no-gutters">
                                <div class="col-6 col-sm-6 food-name">{{$item1->name}}</div>
                                <div class="col-2 col-sm-2 unit">{{$item1->quantity}}{{$item1->unit}}</div>
                                <div class="col-2 col-sm-2 price"></div>
                                <div class="col-2 col-sm-2 price">{{$item1->price}}</div>
                            </div>
                        </div>
                        <div class="col-7 col-sm-7 desc">{{$item1->desc}}</div>
                        <div class="col-5 col-sm-5 button-item d-flex justify-content-end align-items-end">
                            <button value="" style="border-radius: 20px; background-color: orange;height: 40px;
                            width: 113px;" data-toggle="modal" data-target="#modal3">Thêm vào giỏ</button>
                        </div>
                    </div>  
                    
                
            @endforeach