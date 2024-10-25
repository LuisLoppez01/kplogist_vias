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
                <th>{{is_null($defect->component_catalogs_id)?"No se agregó componente":$defect->component_catalog->name,}}</th>
                <th>
                    {{ is_null($defect->priority) || $defect->priority == 0? "No se agregó prioridad" : ($defect->priority == 3 ? 'Alto' : ($defect->priority == 2 ? 'Medio' : 'Bajo')) }}
                </th>
                <th>{{is_null($defect->comment)?"No se agregó comentario":$defect->comment}}</th>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
