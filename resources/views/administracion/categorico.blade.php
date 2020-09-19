@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <v-alert type="success">
            {{session('msg')}}
        </v-alert>
    @endif

    <div class="row">

        <div class="col-12 my-1">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <strong>
                            Categorias
                        </strong>
                    </h5>

                    <form class="row" action="{{url('/categorias')}}" method="post">
                        @csrf

                        <div class="form-group col-12">
                            Nombre:
                            <input type="text" class="form-control" name="nombre" required>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Crear
                            </button>
                        </div>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Categoria
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $c)
                                    <tr>
                                        <td>
                                            {{$c->nombre}}
                                        </td>
                                        <td>
                                            <a href="{{url('/categorias').'/'.$c->id}}" class="btn btn-danger">
                                                <v-icon>
                                                    mdi-trash-can
                                                </v-icon>
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if (count($categorias) > 0)
            <div class="col-12 my-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <strong>
                                Subcategorias
                            </strong>
                        </h5>

                        <form class="row" action="{{url('/subcategorias')}}" method="post">
                            @csrf

                            <div class="form-group col-12 col-6">
                                Nombre:
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            
                            <div class="form-group col-12 col-6">
                                Categoria:
                                <select name="categoria" required class="form-control">
                                    @foreach ($categorias as $c)
                                        <option>
                                            {{$c->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    Crear
                                </button>
                            </div>
                        </form>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Categoria
                                        </th>
                                        <th>
                                            Subcategoria
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategorias as $s)
                                        <tr>
                                            <td>
                                                {{$s->categoria}}
                                            </td>
                                            <td>
                                                {{$s->nombre}}
                                            </td>
                                            <td>
                                                <a href="{{url('/subcategorias').'/'.$s->id}}" class="btn btn-danger">
                                                    <v-icon>
                                                        mdi-trash-can
                                                    </v-icon>
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection