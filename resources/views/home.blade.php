@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('msg'))
        <v-alert type="success">
            {{session('msg')}}
        </v-alert>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mi perfil</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <tr>
                                <td>
                                    <strong>
                                        Nombre
                                    </strong>
                                </td>
                                <td>
                                    {{Auth::user()->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Apellido
                                    </strong>
                                </td>
                                <td>
                                    {{Auth::user()->lastname}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Email
                                    </strong>
                                </td>
                                <td>
                                    {{Auth::user()->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        Identificacion
                                    </strong>
                                </td>
                                <td>
                                    {{Auth::user()->documentType}}
                                    {{Auth::user()->identification}}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <hr>

                    <center>
                        <strong>
                            Cambiar contraseña
                        </strong>
                    </center>
                    <form action="{{url('/cambiar-clave')}}" method="post">
                        @csrf
                        <div class="form-group">
                            Nuevo pasword:
                            <input type="password" class="form-control" required name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Cambiar contraseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
