<table>    <thead>    <tr>        <th>Id</th>        <th>Usuario</th>        <th>Patio</th>        <th>Vía</th>        <th>Tramo de vía</th>        <th>Fecha de inspección</th>    </tr>    </thead>    <tbody>    @foreach($reports as $report)        <tr>            <td>{{$report->id}}</td>            <td>{{$report->user->name}}</td>            <td>{{ $report->yard ? $report->yard->name : 'No tiene' }}</td>            <td>{{ $report->track ? $report->track->name : 'No tiene' }}</td>            <td>{{ $report->tracksection ? $report->tracksection->name : 'No tiene' }}</td>            <td>{{$report->date}}</td>        </tr>    @endforeach    </tbody></table>