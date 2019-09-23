@extends('mobile.layout')


@section('title')
    Kayıt
@stop


@section('header')
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>--}}
    {{--    <script src="{{asset('js/instascan.min.js')}}"></script>--}}


@stop

@section('js')
    <script>
        Swal.fire(
            {
                title: 'Oops..',
                html: 'Sistemi kullanmak için önce kayıt olun!',
                type: 'error',
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Anladım!',
            }
        )
    </script>

@stop


@section('content')
    <div class="content">
        <div class="col-md-6">
            <form id="RegisterValidation" action="{{route('session.save')}}" method="post">
                <div class="card ">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">mail_outline</i>
                        </div>
                        <h4 class="card-title">Kayıt Formu</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating"> Ad *</label>
                            <input class="form-control" id="name" name="name" required="true">
                        </div>
                        <div class="form-group">
                            <label for="surname" class="bmd-label-floating"> Soyad *</label>
                            <input class="form-control" id="surname" name="surname" required="true">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="bmd-label-floating"> Telefon Numarası *</label>
                            <input class="form-control" id="phone" name="phone" required="true">
                        </div>
                        <div class="category form-category">* Gerekli Alanlar</div>
                    </div>
                    <div class="card-footer text-right" style="display: block;">
                        <button class="btn btn-twitter">
                            <i class="material-icons">directions_run</i> Kaydol
                        </button>
                    </div>

                </div>
            </form>

        </div>
        <div class="col-md-6">
            <form id="login" action="{{route('session.login')}}" method="post">
                <div class="card ">

                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                        <h4 class="card-title">Zaten üye misin ?</h4>
                    </div>

                    <div class="card-body ">
                        <div class="form-group">
                            <label for="phone" class="bmd-label-floating"> Telefon Numarası *</label>
                            <input class="form-control" id="phone" name="phone" required="true">
                        </div>
                    </div>
                    <div class="card-footer text-right" style="display: block;">
                        <button class="btn btn-twitter">
                            <i class="material-icons">directions_walk</i> Giriş Yap
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

