@extends('mobile.layout')


@section('title')
    Menü -
@stop


@section('header')




@stop

@section('js')

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
                                @php
                                    $category = array();
                                @endphp

                                <ul class="nav nav-pills nav-pills-warning" role="tablist">
                                    @foreach ($result->unique('category_id') as $item)
                                            <li class="nav-item">
                                                <a @if ($loop->first) class="nav-link active" @else class="nav-link"
                                                   @endif data-toggle="tab" href="#link{{$item->category_id}}"
                                                   role="tablist">
                                                    {{$item->category_name}}
                                                </a>
                                            </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content tab-space">
                                    @php
                                    $cat=0;
                                    @endphp
                                    @foreach ($result as $item)
                                                @if($cat!=$item->category_id)
                                            <div @if ($loop->first) class="tab-pane active  " @else class="tab-pane" @endif  id="link{{$item->category_id}}">
                                                    <div class="container"  style="padding-right: 0px; padding-left: 5px;">
                                                        <div class="row text-center text-lg-left">
                                                    @endif
                                                        <div class="col-lg-3 col-md-4 col-6" style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px">
                                                            <a href="#" class="d-block mb-4 h-100">
                                                                <img class="img-fluid img-thumbnail" src="{{json_decode($item->item_photos)[0]}}" alt=""   data-toggle="moda{{$item->category_id}}" data-target="#modal{{$item->category_id}}">
                                                            </a>
                                                        </div>
{{--                                                            @if($result[$loop->index+1]->category_id =!$item->category_id)--}}
                                                                @if($cat =!$item->category_id)
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
            </div>

        </div>
        <!--Modal: Name-->
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <!--Content-->
                <div class="modal-content">

                    <!--Body-->
                    <div class="modal-body mb-0 p-0">
                        <div class="card-body">

                            <h4 class="card-title" align="center">
                                <a href="#pablo">Cozy 5 Stars Apartment</a>
                            </h4>
                            <div class="card-description">
                                The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona.
                            </div>
                            <div class="card-actions text-center">
                                <button class="btn btn-link btn-twitter">
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

    </div>
@endsection

