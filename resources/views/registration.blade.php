<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registration</title>
</head>
<body>
  <h3 style="text-align:center;"> Registration Form </h3>

  <form action="/registration" method="post">
    @csrf
    <span>NID:</span> <!-- validate the NID from a verification API -->
    <input type="text" name="nid"> <br><br>

    <span>Birthdate:</span>
    <input type="date" name="dob" id=""> <br><br>

    <span>Phone Number:</span>
    <input type="text" name="phone"> <br><br> <!-- Verify using OTP -->

    <span>Select Center:</span>
    <select name="center" id="" name="center">
      <option value="dhaka">Dhaka</option>
      <option value="gopalganj">Gopalganj</option>
      <option value="khulna">Khulna</option>
    </select> <br><br>
    <!-- No need to have a CRUD for centers, seed the pre-defined center names -->

    <input type="submit" value="Submit">
    
  </form>
  
</body>
</html>