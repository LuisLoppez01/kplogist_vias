<div>
    <div class="form-group">
        <strong>Empresa</strong>
        @error('companies')
                <small class="text-danger">
                    <strong>{{$message}}</strong>
                </small>
        @enderror
        {!! Form::select('company_id', $companies, (isset($email) ? $email->yard->id : '')  , ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <strong>Patio</strong>
        @error('yards')
                <small class="text-danger">
                    <strong>{{$message}}</strong>
                </small>
        @enderror

        {!! Form::select('yard_id', $yards, (isset($email) ? $email->yard->id : '')  , ['class' => 'form-control']) !!}
    </div>
<div>

