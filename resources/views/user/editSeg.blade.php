@extends('adminlte::page')

@section('title','Seguimiento')
@section('content_header')

@stop
@section('content')

<div class="content mt-3 mb-3" style="text-transform: uppercase;">
    <div class="container-fluid">
        <div class="card w-50 mx-auto">
            <div class="">
                <div class="card card-warning card-outline shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title mx-auto">
                                Edición de Seguimiento
                            </h3>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{route('editSeg', $doc->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body ">
                            <div class="form-group row">
                                <label for="estatus" class="col-sm-4 text-right mt-1 mr-3 control-label">ESTATUS</label>
                                <select class="form-control col-sm-7" name="estatus"  required>
                                    <option disabled>SELECCIONE...</option>
                                    <option value="ABIERTO">ABIERTO</option>
                                    @if (Auth::user()->ROLE == 'Admin' || Auth::user()->ROLE == 'Root')
                                    <option value="CERRADO">CERRADO</option>
                                    @endif
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="EXPIRADO">EXPIRADO</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="accion" class="col-sm-4 text-right mt-1 mr-3 control-label">Acción</label>
                                <select class="form-control col-sm-7" name="accion"  required>
                                    <option disabled>SELECCIONE...</option>
                                    <option value="EVALUAR Y RECOMENDAR">EVALUAR Y RECOMENDAR</option>
                                    <option value="CIRCULAR">CIRCULAR</option>
                                    <option value="REQUIERE RESPUESTA">ELABORAR RESPUESTA</option>
                                    <option value="RESPUESTA A">EN ESPERA</option>
                                    <option value="ARCHIVAR">ARCHIVAR</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="instruccion" class="col-sm-4 text-right mt-1 mr-3 control-label">INSTRUCCIÓN</label>
                                <textarea name="instruccion" class="form-control col-sm-7" cols="10" rows="5" maxlength="320" placeholder="{{$doc->instruccion}}" placeholder="instruccion" style="text-transform: uppercase; resize: none;" required></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="bandeja_de" class="col-sm-4 text-right mt-1 mr-3 control-label">BANDEJA DE</label>
                                <select class="form-control col-sm-7" id="c_der" name="bandeja_de" style="text-transform: uppercase;" required>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="card-footer btn bg-gradient-warning btn-block text-bold text-white">
                            Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="icon" href="{{asset("favicon_500x500.png")}}" type="image/png"/>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('theme/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset("theme/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
@stop