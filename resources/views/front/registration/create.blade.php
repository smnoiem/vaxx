
<x-layout title="New Registration">

    <h3 style="text-align:center;"> Registration Form </h3>

    {{-- {{$errors}}

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li> {{$error}} </li>
        @endforeach
    @endif --}}

    <form action="{{ route('front.registration.store') }}" method="post">
        @csrf
        <span>NID:</span> <!-- validate the NID from a verification API -->
        <input type="text" name="nid" value="{{old('nid')}}"> <br>
        <span style="color: red">
        @error('nid')
        {{$message}}
        @enderror</span>
        <br>

        <span>Birthdate:</span>
        <input type="date" name="dob" id="" value="{{old('dob')}}"> <br>
        <span style="color: red">
        @error('dob')
            {{$message}}
        @enderror
        </span>
        <br>

        <span>Phone Number:</span>
        <input type="text" name="phone" id="phone" value="{{old('phone')}}"> <br>
        <span style="color: red">
        @error('phone')
            {{$message}}
        @enderror
        </span><br> <!-- Verify using OTP -->

        <span>Select Center:</span>
        <select name="center_id" id="center_id" name="center_id">
        <option value="1">Dhaka</option>
        <option value="2" selected>Gopalganj</option>
        <option value="3">Khulna</option>
        </select> <br>
        <span style="color: red">
        @error('center_id')
            {{$message}}
        @enderror
        </span><br>
        <!-- No need to have a CRUD for centers, seed the pre-defined center names -->

        <input type="submit" value="Submit">
        
    </form>

</x-layout>
