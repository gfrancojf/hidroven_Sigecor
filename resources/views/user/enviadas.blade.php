@extends('adminlte::page')

@section('title','Correspondencia Enviada')
@section('content_header')

@stop
@section('content')
  <div class="modal" id="creacion" tabindex="-1" style="text-transform: uppercase;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <div class="mx-auto pl-5">
                <h5 class="modal-title ml-5 pl-3">Registro de Correspondencia Enviada</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('add_enviado') }}" name="enviado" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="card-body pt-0 pb-0">
                <div class="row">
                  {{-- Izquierda --}}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_doc">Fecha del Documento:</label>
                      <input type="date" name="fecha_doc" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="referencia">Referencia:</label>
                      <textarea name="referencia" class="form-control" cols="30" rows="5" maxlength="320" placeholder="DESCRIPCIÓN CORTA DEL DOCUMENTO" style="text-transform: uppercase; resize: none;" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="tipo">Tipo de Correspondencia:</label>
                      <select class="form-control" name="tipo" required style="width: 100%;" onchange="mEstados(this.value);" required>
                        <option value="0" selected disabled>SELECCIONE...
                        <option value="1">INTERNA</option>
                        <option value="2">EXTERNA</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="destinatario">Destinatario:</label>
                      <select class="form-control select2" name="destinatario" id="des" style="width: 100%; text-transform: uppercase;" required>
                        <option value="-">- 
                      </select>
                    </div>
                    <div class="form-group" id="estado" style="display: none;">
                      <label for="estado">Estado:</label>
                      <select class="form-control select2" name="estado" id="estados" style="width: 100%; text-transform: uppercase;">
                        <option value="-">- 
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="otro">Dato Adicional:</label>
                      <input type="text" name="otro" class="form-control" placeholder="DATO ADICIONAL..." style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group">
                      <label for="ccopia_a">Con Copia:</label>
                      <select class="form-control select2" name="ccopia_a" onchange="copia_a(this.value);" style="width: 100%;" required>
                        <option value="0" selected disabled>SELECCIONE...
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                    <div id="ccopy" style="display: none;">
                      <div class="form-group">
                        <label for="ccopia">Copia a:</label>
                        <select class="form-control select2" name="ccopia" id="cop" style="width: 100%;">
                          <option value="-">- 
                        </select>
                      </div>
                    </div>                 
                  </div>
                  {{-- Derecha --}}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecha_rec">Fecha de Recibido:</label>
                      <input type="date" name="fecha_rec" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="file">Documento:</label>
                      <input type="file" name="file" class="custom-file" id="archivo" required>
                    </div>
                    <div class="form-group">
                      <label for="tipo_doc">Tipo de Documento:</label>
                      <select class="form-control select2" name="tipo_doc" style="width: 100%;" onChange="tipoDoc(this.value);" required>
                        <option value="CIRCULAR">CIRCULAR</option>
                        <option value="INFORME">INFORME</option>
                        <option value="MEMORANDO">MEMORANDO</option>
                        <option value="OFICIO">OFICIO</option>
                        <option value="NOTA DE ENTREGA">NOTA DE ENTREGA</option>
                        <option value="NOTA DE SALIDA">NOTA DE SALIDA</option>
                        <option value="PUNTO DE CUENTA">PUNTO DE CUENTA</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <div id="nOficio">
                        <label for="nro">Nro. de Documento:</label>
                        <div class="row px-2" id="normal">
                          <input type="number" name="nro_c" class="form-control" placeholder="542" style="width: 100%;">
                        </div>
                      </div>
                      <div id="sOficio" style="display: none;">
                        <label for="nro_doc">Nro. de Documento:</label>
                        <div class="row px-2" id="oficio">
                          <select class="form-control select2" name="nro_doc" style="width: 25%;">
                            <option value="DM N" selected>DM N</option>
                          </select>
                          <input type="number" name="nro" class="form-control" placeholder="542" style="width: 65%;">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="recibido_por">Registrada por:</label>
                      <input type="text" name="recibido_por" class="form-control" value="{{Auth::user()->name}}" style="text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                      <label for="accion">Acción:</label>
                      <select class="form-control select2" name="accion" style="width: 100%;" onChange="mostrar(this.value);" required>
                        <option value="EVALUAR Y RECOMENDAR" selected>EVALUAR Y RECOMENDAR</option>
                        <option value="CIRCULAR">CIRCULAR</option>
                        <option value="REQUIERE RESPUESTA">REQUIERE RESPUESTA</option>
                        <option value="RESPUESTA A">RESPUESTA A</option>
                        <option value="ARCHIVAR">ARCHIVAR</option>
                      </select>
                    </div>
                    <div id="obsres" style="display: none;">
                      <div class="form-group">
                        <label for="ref_doc">REFERENCIA DE RESPUESTA:</label>
                        <input id="ref_doc" type="text" style="text-transform:uppercase;" class="form-control" name="ref_doc">
                      </div>
                    </div>
                    <div id="obsfec" style="display: none;">
                      <div class="form-group">
                        <label for="fecha_lim">FECHA LIMITE PARA RESPONDER:</label>
                        <input id="fecha_lim" type="date" class="form-control"  name="fecha_lim">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="bandeja_de">Bandeja de:</label>
                      <select class="form-control select2" name="bandeja_de" id="c_der" style="width: 100%; text-transform: uppercase;">
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="seguimiento">Seguimiento:</label>
                        <select class="form-control select2" name="seguimiento" style="width: 100%;" required>
                          <option value="REVISAR INFORMACION" selected>REVISAR INFORMACION</option>
                          <option value="DERIVAR">DERIVAR</option>
                          <option value="DERIVAR">ARCHIVAR</option>
                          <option value="REGISTRAR CORRESPONDENCIA">REGISTRAR CORRESPONDENCIA</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="estatus">Estatus:</label>
                      <select class="form-control select2" name="estatus" style="width: 100%;" required>
                        <option value="ABIERTO" selected>ABIERTO</option>
                        <option value="CERRADO">CERRADO</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="EXPIRADO">EXPIRADO</option>
                      </select>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Tablas - --}}
  <div class="container-fluid mt-4 mb-3">
    <div class="row" style="text-transform: uppercase;">
      {{-- Header --}}
      <div class="card-header col-12">
        <div class="float-left">
          <h4>CORRESPONDENCIA ENVIADA</h4>
        </div>
        <div class="float-right">
          <button type="button" class="btn btn-success" id="btn-creacion" data-toggle="modal" data-target="#creacion" name="button">NUEVO ENVIO</button>
        </div>
      </div>
      {{-- Fin del Header --}}
      {{-- Tablas --}}
      <div class="col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-corE-tab" data-toggle="pill" href="#custom-tabs-four-corE" role="tab" aria-controls="custom-tabs-four-corE" aria-selected="true">Correspondencia Enviada</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-cerrada-tab" data-toggle="pill" href="#custom-tabs-four-cerrada" role="tab" aria-controls="custom-tabs-four-cerrada" aria-selected="false">Correspondencia Cerrada</a>
              </li>
            </ul>
          </div>
        <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
          {{-- Tabla Correspondencia --}}
          <div class="tab-pane fade show active" id="custom-tabs-four-corE" role="tabpanel" aria-labelledby="custom-tabs-four-corE-tab">
            <div class="correspondencia_wrapper dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div  class="col-md-12">
                    <table class="correspondencia table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="enviadosA_info">
                      <thead>
                        <tr role="row" class="text-center">
                          <th>CODIGO</th>
                          <th>DOCUMENTO</th>
                          <th>TIPO</th>
                          <th>DESTINATARIO</th>
                          <th>DATO ADICIONAL</th>
                          <th>ESTADO</th>
                          <th>REFERENCIA</th>
                          <th>ESTATUS</th>
                          <th>OPCIONES</th>
                        </tr>
                      </thead>
                      <tbody style="text-transform: uppercase;">
                        @if ($enviados)
                          @foreach ($enviados as $enviado)
                            @if ($enviado->active == 1)
                            <tr>
                              <td>{{$enviado->codigo}}</td>
                              <td>{{$enviado->nro_doc}}</td>
                              <td>{{$enviado->tipo}}</td>
                              <td>{{$enviado->destinatario}}</td>
                              <td>{{$enviado->otro}}</td>
                              <td>{{$enviado->estado}}</td>
                              <td>{{$enviado->referencia}}</td>
                              <td>{{$enviado->estatus}}</td>
                              <td class="text-center">
                                <a href="{{ route('seguimiento_en', ['id'=>encrypt("$enviado->id")]) }}" class="btn btn-sm btn-primary fas fa-file-word"> <span style="font-family: 'Oswald', sans-serif !important;"></span></a>
                                @if (Auth::user()->ROLE == 'Root')
                                <a class="btn-sm btn-danger fas fa-trash-alt" id="eliminar"> ELIMINAR</a>
                                @endif
                              </td>
                            </tr>
                            @endif
                          @endforeach    
                        @endif
                      </tbody>
                    </table>
                  {{-- Fin Tabla Enviados --}}
                </div>
              </div>
            </div>
          </div>
          {{-- Fin Tabla Correspondencia --}}
          {{-- Tabla Correspondencia Cerrada --}}
          <div class="tab-pane fade" id="custom-tabs-four-cerrada" role="tabpanel" aria-labelledby="custom-tabs-four-cerrada-tab">
            <div class="correspondencia_wrapper dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div  class="col-md-12">
                  <table class="correspondencia table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="Cerrados_info">
                    <thead>
                      <tr role="row" class="text-center">
                        <th>CODIGO</th>
                        <th>DOCUMENTO</th>
                        <th>TIPO</th>
                        <th>DESTINATARIO</th>
                        <th>DATO ADICIONAL</th>
                        <th>ESTADO</th>
                        <th>REFERENCIA</th>
                        <th>ESTATUS</th>
                        <th>OPCIONES</th>
                      </tr>
                    </thead>
                    <tbody style="text-transform: uppercase;">
                      {{-- @if ($cerrados) --}}
                        @foreach ($cerrados as $cerrado)
                          @if ($cerrado->active == 1 && $cerrado->estatus == 'CERRADO')
                            <tr>
                              <td>{{$cerrado->codigo}}</td>
                              <td>{{$cerrado->nro_doc}}</td>
                              <td>{{$cerrado->tipo}}</td>
                              <td>{{$cerrado->destinatario}}</td>
                              <td>{{$cerrado->otro}}</td>
                              <td>{{$cerrado->estado}}</td>
                              <td>{{$cerrado->referencia}}</td>
                              <td>{{$cerrado->estatus}}</td>
                              <td class="text-center">
                                <a href="{{ route('seguimiento_en', ['id'=>encrypt("$cerrado->id")]) }}" class="btn btn-sm btn-primary fas fa-file-word">
                                  <span style="font-family: 'Oswald', sans-serif !important;"></span>
                                </a>

                                @can('user')
                                  <a class="btn-sm btn-danger fas fa-trash-alt" id="eliminar"> ELIMINAR</a>
                                @endcan
                                {{--  @if (Auth::user()->ROLE == 'Root')
                                    <a class="btn-sm btn-danger fas fa-trash-alt" id="eliminar"> ELIMINAR</
                                @endif  --}}
                              </td>
                            </tr>
                          @endif
                        @endforeach    
                      {{-- @endif --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- Fin Tabla Correspondencia Cerrada --}}
        </div>
      </div>
    </div>
  </div>                          
  {{-- Fin de tablas --}}
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
@section('js')
<script src="{{ asset("js/jquery/jquery.js") }}"></script>
  <script type="text/javascript">
    function mostrar(id){ 
      if (id == "EVALUAR Y RECOMENDAR"){
        $("#obsres").hide();
        $("#obsfec").hide();
      }
      if (id == "CIRCULAR"){
        $("#obsres").hide();
        $("#obsfec").hide();
      }
      if (id == "REQUIERE RESPUESTA") {
        $("#obsfec").show();
        $("#obsres").hide();
      }
      if (id == "RESPUESTA A"){ 
        $("#obsres").show();
        $("#obsfec").hide();
      }
      if (id == "ARCHIVAR"){
        $("#obsres").hide();
        $("#obsfec").hide();
      }
    }
    function mEstados(id){
      var urlEInternos = "{{ url('get/internos')}}";
      var urlEExternos = "{{ url('get/externos')}}";
      var $el = $("#des");
      if (id == 2){
        $("#estado").show();
        $(function () {
          $.get(urlEExternos, function(data, status)
          {
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value.name).text(value.name));
            });
             console.log(data);
          });
        });
      }else{
        $("#estado").hide();
        $(function () {
          $.get(urlEInternos, function(data, status)
          {
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value.name).text(value.name));
            });
             console.log(data);
          }).fail(function()
          {
             console.log("Error");
          });
        });
      }
    }
    function tipoDoc(id){ 
      if (id == "OFICIO"){
        $("#sOficio").show();
        $("#nOficio").hide();
      }else{
        $("#nOficio").show();
        $("#sOficio").hide();
      }
    }
    function copia_a(id){
      var urlEInternos = "{{ url('get/internos')}}";
      var $cp = $("#cop");
      if (id == "SI"){
        $("#ccopy").show();

        $(function () {
          $.get(urlEInternos, function(data, status)
          {
            $cp.empty(); // remove old options
            $.each(data, function(key,value) {
              $cp.append($("<option></option>")
                 .attr("value", value.name).text(value.name));
            });
             console.log(data);
          }).fail(function()
          {
             console.log("Error");
          });
        });
      }else{
        $("#ccopy").hide();
      }
    }
  </script>
  <script src="{{ asset('theme/lte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('theme/lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script>
    $(function () {
      $(function () {
        $(".correspondencia").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "searching": true,
            "ordering": true,
            "info": true,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).container().appendTo('.correspondencia_wrapper .col-md-6:eq(0)');
      });
      $('#btn-creacion').on('click', function () {
          event.preventDefault();
          var url =  "{{ url('get/users')}}";
          var urlEstados =  "{{ url('get/estados')}}";
          // console.log(url);
          $.get(url, function(data, status)
          {
            var $el = $("#c_der");
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value.id).text(value.name));
            });
             console.log(data);
          }).fail(function()
          {
             console.log("Error");
          });
          $.get(urlEstados, function(data, status)
          {
            var $el = $("#estados");
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
              $el.append($("<option></option>")
                 .attr("value", value.nombre).text(value.nombre));
            });
             console.log(data);
          }).fail(function()
          {
             console.log("Error");
          });
        });
      
    });
  </script>
@stop


