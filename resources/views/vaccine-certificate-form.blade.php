<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vaccine Certificate</title>
</head>
<body>

  <h3 style="text-align: center">Vaccine Certificate Form</h3>

  <form action="/vaccine-certificate" method="post">
    @csrf
    <span>NID:</span> <!-- validate the NID from a verification API -->
    <input type="text" name="nid"> <br><br>

    <span>Birthdate:</span>
    <input type="date" name="dob" id=""> <br><br>

    <span>Phone Number:</span>
    <input type="text" name="phone"> <br><br> <!-- Verify using OTP -->

    <input type="submit" value="Submit">
    
  </form>
  
</body>
</html>