@extends('admin.layouts.body', ['title' => 'Admin Dashboard'])
@section('content')

    <h3 style="text-align:center">Vaxx Admin Dashboard</h3>
    <hr>
    <div style="padding:6%;font-size:1.5rem;">
        <a href="{{ route('admin.centers.index') }}">Centers</a> <br>
        {{-- <a href="{{ route('admin.vaccine') }}">Update Vaccine Availability</a> <br> --}}
        <a href="{{ route('admin.users.index') }}">Add Admin/Operators</a> <br>
        {{-- <a href="/vaccine-certificate">Assign Operators to Centers</a> <br> --}}
    </div>

@endsection