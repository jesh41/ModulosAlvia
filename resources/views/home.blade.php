@extends('layouts.plantilla')
@section('contenido')
    @if(Auth::check())
        @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <formrol-componente></formrol-componente>
            </template>
            <template v-if="menu==1">
                <h1>Delivery</h1>
            </template>
            <template v-if="menu==2">
                <formusuario-componente></formusuario-componente>
            </template>
            <template v-if="menu==3">
                <cliente></cliente>
            </template>
            <template v-if="menu==4">
                <proveedor></proveedor>
            </template>
            <template v-if="menu==5">
                <rol></rol>
            </template>
            <template v-if="menu==6">
                <h1>Acerca de 6</h1>
            </template>
        @elseif (Auth::user()->idrol == 2)

        @elseif (Auth::user()->idrol == 3)

        @elseif (Auth::user()->idrol == 4)

        @else

        @endif

    @endif




@endsection