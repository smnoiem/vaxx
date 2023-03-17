<x-layout title="Welcome">

    <h3 style="text-align:center">Welcome to Vaxx</h3>
    <hr>
    <div style="padding:6%;font-size:1.5rem;">
        <a href="{{ route('front.registration.create') }}">Register</a> <br>
        <a href="{{ route('front.registration.status.index') }}">Vaccine Status</a> <br>
        <a href="/vaccine-card">Download Vaccine Card</a> <br>
        <a href="/vaccine-certificate">Download Certificate</a> <br>
    </div>
    
</x-layout>