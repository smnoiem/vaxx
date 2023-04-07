@extends('operator.layouts.body', ['title' => 'Operator Dashboard'])
@section('content')

    <h3 style="text-align:center">Vaxx Operator Dashboard</h3>
    <hr>
    <div style="padding:6%;font-size:1.5rem;">
        <a href="{{ route('operator.registrations.index') }}">Vaccine Registrations</a> <br>
    </div>

@endsection