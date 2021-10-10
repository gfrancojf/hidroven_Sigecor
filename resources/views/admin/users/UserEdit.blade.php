@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <span> {{ session('info') }}</span>
        </div>

    @endif

    <div class="content mt-3 mb-3" style="text-transform: uppercase;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <small>
                        <div class="card card-danger card-outline shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">
                                       Asignar  Permiso al Usuario  
                                    </h4>
                                <span>{{$user->name}}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                   {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
                                         @foreach ($roles as $role)
                                         <label>
                                   {!! Form::checkbox('roles[]', $role->id, null,['class' => 'mr-auto']) !!}
                                   {{ $role->name }}
                                        </label>

                                @endforeach

                                {!! Form::submit('Asignar', ['class' => 'btn btn-primary btn-sm mt-6']) !!}


                                {!! Form::close() !!}
                            </div>

                        </div>

                </div>
                </small>



            </div>
        </div>
    </div>

    </div>
    </div>





    < @stop @section('css') @section('js') @stop
