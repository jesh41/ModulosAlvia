@extends('layouts.plantilla')
@section('contenido')



    <template v-if="menu==0">
        <formusuario-componente></formusuario-componente><!--  <formrol-componente></formrol-componente>-->
    </template>

    <template v-if="menu==1">
        <h1>DDelivery</h1>
    </template>

    <template v-if="menu==2">
        <formusuario-componente></formusuario-componente>
    </template>

    <template v-if="menu==3">
        <formrol-componente></formrol-componente>
    </template>

    <template v-if="menu==4">
        <h1>Reportes 4</h1>
    </template>

    <template v-if="menu==5">
        <h1>Ayuda 5</h1>
    </template>

    <template v-if="menu==6">
        <h1>Acerca de 6</h1>
    </template>



@endsection