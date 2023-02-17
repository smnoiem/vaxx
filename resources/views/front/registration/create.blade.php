
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
    <input type="text" name="nid"> <br>
    <span style="color: red">
    @error('nid')
      {{$message}}
    @enderror</span>
    <br>

    <span>Birthdate:</span>
    <input type="date" name="dob" id=""> <br>
    <span style="color: red">
      @error('dob')
          {{$message}}
      @enderror
    </span>
    <br>

    <span>Phone Number:</span>
    <input type="text" name="phone"> <br>
    <span style="color: red">
      @error('phone')
          {{$message}}
      @enderror
    </span><br> <!-- Verify using OTP -->

    <span>Select Center:</span>
    <select name="center" id="" name="center">
      <option value="dhaka">Dhaka</option>
      <option value="gopalganj">Gopalganj</option>
      <option value="khulna">Khulna</option>
    </select> <br>
    <span style="color: red">
      @error('center')
          {{$message}}
      @enderror
    </span><br>
    <!-- No need to have a CRUD for centers, seed the pre-defined center names -->

    <input type="submit" value="Submit">
    
  </form>

</x-layout>
