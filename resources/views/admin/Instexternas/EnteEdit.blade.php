@extends('adminlte::page')

@section('title','inicio')
@section('content_header')
 
@stop
@section('content')
     @livewire('admin.ins-externas')
@stop
@section('css')
    <link rel="icon" href="{{asset("favicon_500x500.png")}}" type="image/png"/>
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
@stop
