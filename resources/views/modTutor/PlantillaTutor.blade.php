@extends('adminlte::page')

@section('title', 'Tutores')

@section('content_header')
    <button class="btn btn-primary back-button" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i> Regresar al panel principal
    </button>
@stop

@section('content')
    
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .content-wrapper {
        transition: all 0.3s;
        }
        .back-button {
        background-color: #2c5e94;
        color: white;
        padding: 10px 20px;
        border: 0;
        border-radius: 5px;
        font-size: 18px;
        }

        .back-button i {
        margin-right: 10px;
        }
    </style>
    @yield('estilos')
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            document.querySelector('.main-sidebar').style.display = 'none';
            document.querySelector('.main-header').style.marginLeft = '0';
            document.querySelector('.content-wrapper').style.marginLeft = '0';
        });
    </script>
    @yield('jscript')
@endsection
