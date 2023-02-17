<x-layout title="Vaccine Status">
  
  <h3 style="text-align:center;"> Vaccine Status </h3>

  <table style="border: 1px solid black">
    <tr>
      <th>Dose</th> <th>Date Scheduled</th> <th>Date Taken</th> <th>Given By</th> <th>Vaccine Name</th>
    </tr>
    <tr>
      <td>{{$registration->nid}}</td> <td>{{$registration->created_at}}</td> <td>{{$registration->updated_at}}</td> <td>{{$registration->phone}}</td> <td>{{$registration->dob}}</td>
    </tr>
  </table>
  
</x-layout>
