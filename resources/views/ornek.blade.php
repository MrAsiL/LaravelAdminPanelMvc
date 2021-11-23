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
