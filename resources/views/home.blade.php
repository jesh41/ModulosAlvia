@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="">
                            <div class="form-group">
                                <label for="thought">Ahora estoy pensando en:</label>
                                <input type="text" class="form-control" name="thought">

                            </div>
                            <button type="submit">
                                Enviar pensamiento
                            </button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
