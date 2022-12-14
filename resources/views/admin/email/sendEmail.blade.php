<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {}
        
        .e-content {
            display: block;
            text-align: center;
            border: 1px solid #ccc;
            margin: 0 30%;
            background-color: rgb(255, 228, 220);
        }

        .e-header{
            background: #000;
            height: 100px;
            color: yellow;
            align-items: center;
            text-align: center;
        }

        .e-header h2{
           margin: 0;
        }
        
        .col-md-12 {
            padding: 0;
        }
        
        .e-body {
            padding: 20px;
        }
        
        .e-body a {
            word-wrap: break-word;
        }
        
        .e-body h2 {
            color: red;
            font-weight: bold;
            font-size: 20px;
        }
        
        .e-body h3 {
            color: brown;
            font-style: italic;
        }
        
        .e-body p a {
            color: red;
            text-decoration: none;
        }
        
        .e-body p a:hover {
            color: rgb(214, 9, 9);
            text-decoration: none;
        }
        
        footer {
            border: 1px solid black;
            background-color: rgb(14, 13, 13);
            color: yellow;
        }
        
        @media only screen and (max-width: 480px) {
            .e-content {
                margin: 0;
            }
        }
        
        @media only screen and (min-width: 480px) and (max-width: 920px) {
            .e-content {
                margin: 0 15%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row e-content">
            <header class="col-md-12 e-header  ">
                <h2>{{$coupon['coupon_name']}}</h2>
            </header>
            @php
                $result = '';
                if($coupon['coupon_feature'] == 1){
                    $result .= number_format($coupon['coupon_number'],0,',','.').'%';
                    
                }
                else{
                    $result .= number_format($coupon['coupon_number'],0,',','.').' VND';
                }
            @endphp
            <div class="col-md-12 e-body">
                <h2>M?? khuy???n m??i t??? <a href="https://robertphi.shop/home">https://robertphi.shop</a></h2>
                <h3>Gi???m {{$result}} cho t???ng ????n h??ng ch??? t??? {{number_format($coupon['coupon_condition'],0,',','.').' VND'}}</h3>
                <p>Qu?? kh??ch ???? t???ng mua h??ng t???i shop <a href="https://robertphi.shop/home">robertphi.shop</a> n???u ???? c?? t??i kho???n xin vui l??ng
                    <a href="https://robertphi.shop/login-checkout">????ng nh???p</a> v??o t??i kho???n d??? mua h??ng v?? nh???p m?? code ph??a d?????i ????? ???????c gi???m gi?? mua h??ng, xin ch??n th??nh c???m ??n qu?? kh??ch. Ch??c qu?? kh??ch th???t nhi???u s???c kh???e v?? b??nh an trong cu???c
                    s???ng.
                </p>
                <p style="font-size: 20px"> M?? code: <b>{{$coupon['coupon_code']}}</b></p>
                <p style="font-size: 12px; color:rgb(214, 9, 9)">Ng??y gia h???n: {{$coupon['coupon_date_start']}}</p>
                <p style="font-size: 12px; color:rgb(214, 9, 9)">Ng??y h???t h???n: {{$coupon['coupon_date_end']}}</p>
            </div>
            <footer class="col-md-12">
                <h2>Th??ng tin li??n h???</h2>
                {{-- <img width="50px" src="{{url('storage/app/public/uploads/logo/'.$contact->contact_images)}}" alt=""> --}}
                <p>{!!$contact->contact_info!!}</p>
            </footer>
        </div>
    </div>
</body>

</html>