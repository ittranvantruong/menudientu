<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href=" {{asset('public/css/cart.css')}} " />
    <title>Giỏ hàng</title>
</head>
<body>
    <div class="container">
        <div class="row no-gutters head">
            <div class="col-1 col-sm-1 backward-button">
                <i class="fas fa-angle-left"></i>
            </div>
            <div class="col-9 col-sm-9 list ">Danh sách món đã chọn</div>
            <div class="col-2 col-sm-2 delete-all-button">
                <button type="" >Xóa giỏ</button>
            </div>
        </div>
        <div class="row no-gutters menu">
            <div class="col-12 col-sm-12 items">
                <div class="row item">
                    <div class="col-3 col-sm-3 pic">
                        <img src="D:/pic/ui/goiCuonBoPia.JPG">
                    </div>
                    <div class="col-7 col-sm-7 text">
                        <div class="row food-name">
                            <div class="col-12 col-sm-12"> 1x Gỏi Cuốn Bò Pía</div>
                        </div>
                        <div class="row price">
                            <div class="col-12 col-sm-12">150.000 VND</div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 delete-button">
                        <div class="row delete">
                            <div class="col-12 col-sm-12">
                                <button value="" style="
                                border-style: hidden;
                                background-color: white;
                                color: rgb(23, 136, 8);
                                font-size: 120%;
                            ">Xóa</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters confirm-button">
            <div class="col-12 col-sm-12 d-flex justify-content-center">
                <button value="" type="" 
                style="padding: 10px;
                border-radius: 10px;
                background-color: rgb(23, 136, 8);
                color: white; 
                width: 100%;
                height: auto;
                margin: 0px 10px 10px 10px;"
                >Gửi yêu cầu đặt món 600.000 VND</button> 
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
        crossorigin="anonymous"></script>
</body>
</html>