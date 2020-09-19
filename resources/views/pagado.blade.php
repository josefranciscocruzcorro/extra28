@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{$msg}}
                    <hr>
                    Para coordinar la entrega nuestro equipo se pondra en contacto contigo pronto a travez de tu email.
                    Recuerda revisarlo.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
