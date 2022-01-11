<x-layout title="Vaccine Status">
  
  <h3 style="text-align: center">Vaccine Status Form</h3>

  <form action="/vaccine-status" method="post">
    @csrf
    <span>NID:</span> <!-- validate the NID from a verification API -->
    <input type="text" name="nid"> <br><br>

    <span>Birthdate:</span>
    <input type="date" name="dob" id=""> <br><br>

    <span>Phone Number:</span>
    <input type="text" name="phone"> <br><br> <!-- Verify using OTP -->

    <input type="submit" value="Submit">
    
  </form>
  
</x-layout>
