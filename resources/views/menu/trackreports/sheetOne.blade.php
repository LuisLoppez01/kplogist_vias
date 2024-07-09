<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Patio</th>
        <th>Tipo</th>
        <th>Tramo de vía</th>
        <th>Via/Herraje</th>
        <th>Condición</th>
        <th>Fecha de inspección</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
        <tr>
            <td>{{$report->id}}</td>
            <td>{{$report->user->name}}</td>
            <td>{{$report->yard ? $report->yard->name : 'No tiene' }}</td>
            <td>{{$report->track !== null ? 'Via' : 'Herraje/Cambio' }}</td>
            <td>{{$report->tracksection ? $report->tracksection->name : 'No tiene' }}</td>
            <td>{{$report->railroadswitch !== null ? $report->railroadswitch->name : $report->track->name}}</td>
            <td>{{$report->condition === 0 ? 'OK' : 'BO' }}</td>
            <td>{{$report->date}}</td>
        </tr>
    @endforeach
    </tbody>
</table>



