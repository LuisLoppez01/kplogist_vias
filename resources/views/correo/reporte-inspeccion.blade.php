<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Reporte de inspecciones</title>

    </head>
    <body>
        <table style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 14px;">
            <tr>
                <td colspan="2" style="text-align: right;  padding: 10px;">
                    <strong>Supervisor:</strong> {{$inspections[0]->user->name}}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;  padding: 10px;">
                    <strong>Fecha:</strong> {{$today}}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;  padding: 10px;">
                    <strong>Empresa:</strong> {{$inspections[0]->yard->company->name}}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px;">
                    <h1>Reporte de inspecciones</h1>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">ID Inspección</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Tipo de inspección</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Patio</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Vía \ Herraje</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Tramo</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Condición</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inspections as $inspection)
                                <tr>
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">{{$inspection->id}}</td>
                                    @if ($inspection->type_inspection==0)
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">Inspeccion de Vía</td>
                                    @else
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">Inspeccion de Herraje</td>
                                    @endif
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">{{$inspection->yard->name}}</td>
                                    @if ($inspection->track_id)
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">{{$inspection->track->name}}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">{{$inspection->tracksection->name}}</td>
                                    @else
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">{{$inspection->railroadswitch->name}}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 10px;"></td>
                                    @endif
                                    @if ($inspection->condition==0)
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">OK</td>
                                    @else
                                    <td style="border: 1px solid #dee2e6; padding: 10px;">BO</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px;">
                    <h1>Defectos</h1>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">ID Inspección</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Componente</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Prioridad</th>
                                <th style="border: 1px solid #dee2e6; padding: 10px;">Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inspections as $inspection)
                                @if ($inspection->condition==1)
                                    @foreach ($inspection->defect_track as $defect_track)
                                    <tr>
                                        <td style="border: 1px solid #dee2e6; padding: 10px;">{{$defect_track->inspection_id}}</td>
                                        <td style="border: 1px solid #dee2e6; padding: 10px;">{{$defect_track->component_catalog->name}}</td>
                                        <td style="border: 1px solid #dee2e6; padding: 10px;">@switch($defect_track->priority)
                                            @case(1)
                                                Baja
                                                @break
                                            @case(2)
                                                Media
                                                @break
                                            @default
                                                Alta
                                            @endswitch
                                        </td>
                                        <td style="border: 1px solid #dee2e6; padding: 10px;">{{$defect_track->comment}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>




    </body>
</html>

@php

@endphp


