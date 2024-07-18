<table>
    <thead>
    <tr>
        <th>ID inspección</th>
        <th>Componente</th>
        <th>Prioridad</th>
        <th>Comentario</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
        @foreach($report->defect_track as $defect)
            <tr>
                <th>{{$defect->inspection_id}}</th>
                <th>{{$defect->component_catalog->name}}</th>
                <th>
                    {{ $defect->priority == 3 ? 'Alto' : ($defect->priority == 2 ? 'Medio' : 'Bajo') }}
                </th>
                <th>{{$defect->comment}}</th>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
