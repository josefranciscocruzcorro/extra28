<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <v-app>     
            <v-system-bar app>
                <v-container fluid>
                    <v-row align="center" justify="space-between">
                        <v-col class="d-none d-sm-flex">
                            <cabecera base="{{url('/')}}"></cabecera>
                        </v-col>
                        <v-col align="end">
                            @guest
                                <v-btn link x-small href="{{ route('login') }}">
                                    Ingresar
                                </v-btn>
                                <v-btn link x-small href="{{ route('register') }}">
                                    Registrarse
                                </v-btn>                                
                            @else
                                <v-btn link x-small href="{{ route('home') }}">
                                    <v-icon>mdi-user</v-icon>
                                    Mi perfil
                                </v-btn>
                                <v-btn link x-small href="{{ route('carrito') }}">
                                    <v-icon>mdi-shopping</v-icon>
                                    Carrito
                                </v-btn>
                            @endguest
                        </v-col>
                    </v-row>
                </v-container>
            </v-system-bar>       

            <v-app-bar app>
                
                    <v-row align="center">
                        <v-col>
                            <a href="{{url('/')}}">
                                <img src="{{asset('images/logo.png')}}" height="40" alt="">
                            </a>
                        </v-col>
                        <v-col align="center">
                            <buscador base="{{url('/')}}" buscar="{{@$buscar}}"></buscador>
                        </v-col>
                        <v-col align="end">
                            <categorico base="{{url('/')}}"></categorico>
                        </v-col>
                    </v-row>
                    
            </v-app-bar>
            
            <!-- Sizes your content based upon application components -->
            <v-content>
                @yield('content')
            </v-content>
            
            <v-footer>
                <v-container fluid>
                    <pie base="{{url('/')}}"></pie>

                    <v-row align="center">
                        <v-col align="center">
                            &copy; 2020 <img src="{{asset('images/logo.png')}}" height="20" alt="">
                        </v-col>
                    </v-row>
                </v-container>
            </v-footer>
        </v-app>
    </div>
</body>
</html>