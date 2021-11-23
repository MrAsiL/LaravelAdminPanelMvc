@extends('admin.tema')
@section('admintitle') Dizinli İşlemleri Dvtsec Admin Template @endsection
@section('css')
    <link href="{{asset('admin')}}/plugins/summernote/dist/summernote.css" rel="stylesheet">
@endsection
@section('body')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(session('basarili'))
                        <div class="alert alert-success">{{session('basarili')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$modullerBilgisi->baslik}}</h4>
                            <div class="basic-form">
                                <form action="{{route('duzenlepost',[$modullerBilgisi->seflink,$veriler->id])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control input-default" name="kategori">
                                            @if($kategoriBilgisi)
                                                @foreach($kategoriBilgisi as $kategori)
                                                    <option value="{{$kategori->id}}" >{{stripslashes($kategori->baslik)}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Başlık</label>
                                        <input type="text" class="form-control input-default" placeholder="Başlık" value="{{$veriler->baslik}}" name="baslik" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Açıklama</label>
                                        <textarea name="metin" class="summernote">{{$veriler->metin}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Resim</label>
                                        <input type="file" class="form-control input-default" placeholder="Resim seçiniz" name="resim" >
                                    </div>
                                    <div class="form-group">
                                        <label>Anahtar</label>
                                        <input type="text" class="form-control input-default" placeholder="Anahtar" name="anahtar" value="{{$veriler->anahtar}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control input-default" placeholder="Description" name="description" value="{{$veriler->description}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Sira No</label>
                                        <input type="number" class="form-control input-default" placeholder="Sira No " value="{{$veriler->sirano}}" name="sirano" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" name="gonder" value="KAYDET">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
@section('js')
    <!-- ChartistJS -->
    <script src="{{asset('admin')}}/plugins/summernote/dist/summernote.min.js"></script>
    <script src="{{asset('admin')}}/plugins/summernote/dist/summernote-init.js"></script>
@endsection
