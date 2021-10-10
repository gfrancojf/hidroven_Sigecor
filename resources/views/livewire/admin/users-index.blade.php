<div class="content mt-3 mb-3" style="text-transform: uppercase;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-danger card-outline shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title"></h4>
                            <input wire:model="search" class="form-control mr-auto" style="text-transform: uppercase;"
                                placeholder="Escriba para Buscar">
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($users->count())


                            <table class="table table-striped">
                                <thead>
                                    <tr>                                   
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Cedula</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                          
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td></td>
                                            
                                            <td width="10px">
                                                <a class="btn  btn-primary fas fa-edit"
                                                    href="{{ route('users.edit', $user) }}"></a>
                                                </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                    </div>
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <h4>No se Encontro registros</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


 