<x-layout title="Vaccine Status">
  
  <h3 style="text-align:center;"> Vaccine Status </h3>

  <div>
    <h3>Candidate: {{ $registration->citizen->name }}</h3>
    <p>Date of Birth: {{ $registration->citizen->dob }}</p>
    <p>Vaccine Center: {{ $registration->center->name }}</p>
    @if ($registration->center->address)
        <p>Vaccine Center Address: {{ $registration->center->address }}</p>
    @endif
  </div>

  <table style="border: 1px solid black">

    <tr>
      <th>Dose Type</th> <th>Date Scheduled</th> <th>Date Taken</th> <th>Given By</th> <th>Vaccine Name</th>
    </tr>

    @foreach ($registration->doses as $dose)
    <tr>
      <td>{{$dose->dose_type}}</td> <td>{{$dose->scheduled_date}}</td> <td>{{$dose->taken_date}}</td> <td>{{ $dose->givenBy->name ?? "" }}</td> <td>{{$dose->vaccine->name}}</td>
    </tr>
    @endforeach

  </table>
  
</x-layout>
