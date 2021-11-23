@extends('admin.tema')
@section('admintitle') Dvtsec Admin Template @endsection
@section('css')
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
@endsection
@section('body')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">

            </div>
        </div>
        <!-- row -->
        <div class="col-lg-12">
            @if(session('basarili'))
                <div class="alert alert-success">{{session('basarili')}}</div>
                 @endif
            @if(session('hata'))
                <div class="alert alert-danger">{{session('hata')}}</div>
                @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modul Ekleme</h4>
                    <p class="text-muted">Web siteniz için otomatik tablo,model ve crud eklemenizi sağlar</p>
                    <div class="basic-form">
                        <form action="{{route('modul-ekle')}}" class="form-inline" method="post">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="sr-only">Modul İsmi</label>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label class="sr-only">Password</label>
                                <input type="text" class="form-control" placeholder="Modül İsmi" name="baslik">
                            </div>
                            <button type="submit" class="btn btn-dark mb-2">Modul oluştur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
@section('js')
    <!-- ChartistJS -->
    <script src="{{ asset('admin') }}/plugins/chartist/js/chartist.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <script src="{{ asset('admin') }}/js/dashboard/dashboard-1.js"></script>
@endsection
