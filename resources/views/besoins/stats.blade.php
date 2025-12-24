@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Statistiques des besoins</h1>
    <p>Total des besoins : <strong>{{ number_format($total,2) }} FCFA</strong></p>
    <p>Nombre de besoins : <strong>{{ $count }}</strong></p>
</div>
@endsection
