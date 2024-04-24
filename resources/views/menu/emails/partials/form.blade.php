
{{-- <div class="form-group">
    <strong>Patio</strong>
    @error('yards')
            <small class="text-danger">
                <strong>{{$message}}</strong>
            </small>
    @enderror
    {!! Form::select('yard_id', $yards,null  , ['class' => 'form-control']) !!}
</div> --}}
@livewire('form-email')
<div class="form-group">
    {!! Form::label('list', 'Nombre: ') !!}
    {!! Form::textarea('list', null, ['rows' => 5, 'class' => ' form-control'.($errors->has('list') ? ' is-invalid' : ''),'placeholder' => 'Escriba un nombre']) !!}
    @error('list')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>

