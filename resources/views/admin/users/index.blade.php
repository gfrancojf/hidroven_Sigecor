@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
 @livewire('admin.users-index')
@stop

@section('css')
    
@section('js')

@stop
