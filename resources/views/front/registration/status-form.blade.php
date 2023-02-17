<x-layout title="Vaccine Status">
  
    <h3 style="text-align: center">Vaccine Status Form</h3>

    <form action="{{route('front.registration.status.index')}}" method="post">
        @csrf
        <span>NID:</span>
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
        </span><br> <!-- Verify using Mail? -->

        <input type="submit" value="Submit">
        
    </form>
  
</x-layout>
