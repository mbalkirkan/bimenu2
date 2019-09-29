@extends('mobile.layout')


@section('title')
    Menü -
@stop


@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

    {{--    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">--}}


@stop

@section('js')

    <script type="text/javascript">


        var count_items = 0;
        var cart = new Array();
        $("body").on("click", ".AddToCart", function () {
            count_items++;
            var ids = _.map(cart, 'id');
            var item = {
                id: $(this).attr("id"),
                price: $(this).attr("price"),
                name: $(this).attr("item_name")
            };

            if (!_.includes(ids, item.id)) {
                item.quantity = 1;
                cart.push(item);
            } else {
                var index = _.findIndex(cart, item);
                cart[index].quantity = cart[index].quantity + 1
            }

            show_cart();
        });

        $("body").on("click", ".DecreaseToCart", function () {
            var item = {
                id: $(this).attr("data-id")
            };
            var index = _.findIndex(cart, item);

            if (cart[index].quantity == 1) {
                deleteItemFromCart(item);
            } else {
                cart[index].quantity = cart[index].quantity - 1;
            }
            //console.log(cart[index].quantity);
            //toastr.success('Successfully Updated')
            show_cart();

        });

        $("body").on("click", ".IncreaseToCart", function () {
            var item = {
                id: $(this).attr("data-id")
            };
            var index = _.findIndex(cart, item);
            cart[index].quantity = cart[index].quantity + 1;
            show_cart();
        });

        $("body").on("click", ".DeleteItem", function () {
            var item = {
                id: $(this).attr("data-id")
            };

            deleteItemFromCart(item);
        });

        function deleteItemFromCart(item) {
            var index = _.findIndex(cart, item);
            cart.splice(index, 1);
            show_cart();
        }

        function show_cart() {
            if (cart.length > 0) {
                var total = 0;
                var cart_html = "";
                var obj = cart;
                $.each(obj, function (key, value) {
                    cart_html += '<tr>';
                    cart_html += '<td width="10" valign="top"><a href="javascript:void(0)" class="text-danger DeleteItem" data-id=' + value.id + '><i class="fa fa-trash"></i></a></td>';
                    cart_html += '<td><h5 style="margin:0px;">' + value.name + '</h5></td>';
                    cart_html += '<td width="80" style="white-space: nowrap"><button class="btn btn-just-icon btn-link btn-reddit IncreaseToCart " data-id=' + value.id + '><i class="material-icons">add_circle_outline</i><div class="ripple-container"></div></button> ' + value.quantity + ' <button class="btn btn-just-icon btn-link btn-reddit DecreaseToCart " data-id=' + value.id + '><i class="material-icons">remove_circle_outline</i><div class="ripple-container"></div></button> </td>';
                    cart_html += '<td width="15%" class="text-right"><h4 style="margin:0px;"> ₺' + value.price + '</h4> </td>';
                    cart_html += '</tr>';
                    qty = Number(value.quantity);
                    total = Number(total) + Number(value.price * qty);
                });


                //// Discount

                // var discount = 0;

                // if ( Number( count_items ) >= 2 ) {

                // discount = 0;

                // }
                // $( "#discount" ).val( discount );

                // $( "#p_discount" ).html( "$" + discount.toFixed( 2 ) );
                // cart_html += '<div class="panel-footer"> Total Items' ;
                // cart_html += '<span class="pull-right"> ' + qty ;
                // cart_html += '</span></div>' ;

                var total_amount = Number(total);
                $(".TotalAmount").html("₺ " + total_amount.toFixed(2));
                +"  "
                $(".CartStatus").html("");
                $("#Cart").html("");
                $("#Cart").html(cart_html);

            } else {
                $(".TotalAmount").html("₺ 0  ");
                $("#Cart").html("");
                $(".CartStatus").html("Henüz sipariş eklemediniz ");
            }


        }


        $("body").on("click", "#completeOrder", function () {
            if (cart.length < 1) {

                //  $( "#myModal" ).modal( "hide" );

                //   swal( "", "Cart is Empty", "error" );

                return false;
            }

            var form_data = {

                items: _.map(cart, function (cart) {
                    return {
                        id: cart.id,
                        name: cart.name,
                        quantity: cart.quantity,
                        price: cart.price
                    }
                })

            };
            form_data.note = $('#order_note').val();


            $("#completeOrder").html('<i class="fa fa-spinner fa-spin" style="font-size:18px"></i>');
            $("#completeOrder").prop("disabled", true);

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('mobile.sale')}}',
                data: form_data,
                success: function (msg) {
                    cart = [];
                    $("#order_note").val("");

                    $("#completeOrder").html('Siparişleri Onayla');
                    $("#completeOrder").prop("disabled", false);



                    swal({
                        title: 'Siparişiniz Alındı',
                        type: 'success',
                        text: ''
                    }).then(function () {



                        // if ( Number( localStorage.getItem( "total_amount" ) ) >= 500 ) {

                        // swal( "$500 of sales", "Empty the cash drawer", "error" );

                        // localStorage.setItem( "total_amount", 0 );

                        // }
                    })

                    show_cart();
                }
            });
        });

    </script>
@stop




@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7" style="padding-left: 0px;padding-right: 0px;padding-top: 0px">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">{{$result[0]->product_name}}</h4>
                            <div class="card-body " style="padding-left: 0px; padding-right: 5px">


                                <ul class="nav nav-pills nav-pills-warning " style="  display: inline-block;
    overflow: auto;
    overflow-y: hidden;

    max-width: 100%;
    margin: 0 0 1em;

    white-space: nowrap;" role="tablist">

                                    @foreach ($result->unique('category_id') as $item)
                                        <li class="nav-item" style=" display: inline-block;
    vertical-align: top;">
                                            <a @if ($loop->first) class="nav-link active"
                                               @else class="pn-ProductNav_Link nav-link"
                                               @endif data-toggle="tab" href="#link{{$item->category_id}}"
                                               role="tablist">
                                                {{$item->category_name}}
                                            </a>
                                        </li>
                                        <span id="pnIndicator" class="pn-ProductNav_Indicator"></span>
                                    @endforeach

                                </ul>

                                <div class="tab-content tab-space">
                                    @php
                                        $cat=0;
                                    @endphp
                                    @foreach ($result as $item)
                                        @if($loop->first||$result[$loop->index-1]->category_id!=$item->category_id)
                                            <div @if ($loop->first) class="tab-pane active  " @else class="tab-pane"
                                                 @endif  id="link{{$item->category_id}}">
                                                <div class="container"
                                                     style="padding-right: 0px; padding-left: 5px;">
                                                    <div class="row text-center text-lg-left">
                                                        @endif
                                                        <div class="col-lg-3 col-md-4 col-6"
                                                             style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px">

                                                            <a href="#" data-toggle="modal"
                                                               data-target="#modal{{$item->item_id}}"
                                                               class="d-block mb-4 h-100">
                                                                {{--                                                                <div style="--}}
                                                                {{--                                                            top: 60%;--}}
                                                                {{--                                                            width:150px;--}}
                                                                {{--                                                            height:25px;--}}
                                                                {{--                                                            /* margin-top: -25px; */--}}
                                                                {{--                                                            color:white;--}}
                                                                {{--                                                            position: absolute;--}}
                                                                {{--                                                            background: rgba(1,1,1,0.5);--}}
                                                                {{--                                                            display:block;--}}
                                                                {{--                                                            margin-left: 5px;--}}
                                                                {{--                                                            "> Deneme</div>--}}
                                                                <img class="img-fluid img-thumbnail"
                                                                     src="{{json_decode($item->item_photos)[0]}}"
                                                                     alt=""
                                                                >
                                                            </a>
                                                        </div>

                                                        @if($loop->last|| $result[$loop->index+1]->category_id!=$item->category_id)
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $cat=  $item->category_id
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-7" style="padding-left: 0px;padding-right: 0px;padding-top: 0px">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">shopping_basket</i>
                            </div>
                            <h4 class="card-title">Sepetim</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <tbody id="Cart">
                                    <h3 class="CartStatus font-weight-bold text-center">Henüz sipariş eklemediniz </h3>
                                    </tbody>
                                </table>

                            </div>
                            <h4 class="TotalAmount font-weight-bold text-right text-bold">₺ 0 </h4>
                        </div>
                        <hr>

                        <div class="col-md-7">
                            <textarea id="order_note" rows="3" cols="3" class="form-control" placeholder="Sipariş Notu"
                                      style="margin: 0px 166.828px 0px 0px; height: 85px;"></textarea>
                        </div>


                        <button class="btn btn-success" id="completeOrder">
                      <span class="btn-label">
                        <i class="material-icons">check</i>
                      </span>
                            Siparişleri Onayla
                        </button>

                    </div>
                </div>
            </div>
        </div>

    @foreach ($result as $item)
        <!--Modal: Name-->
            <div class="modal fade" id="modal{{$item->item_id}}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">
                            <div class="card-body">

                                <h4 class="card-title" align="center">
                                    <a href="#pablo">{{$item->item_name}}</a>
                                </h4>
                                <div class="card-description">
                                    {{$item->item_description}}
                                </div>
                                <div class="card-actions text-center">
                                    <button class="AddToCart btn btn-link btn-twitter" id="{{$item->item_id}}"
                                            price="{{$item->item_price}}" item_name="{{$item->item_name}}">
                                        <i class="material-icons">add_shopping_cart</i> Sepete Ekle
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">

                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
            <!--Modal: Name-->
        @endforeach


    </div>
@endsection

