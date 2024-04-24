<div class="form-group">
    {!! Form::label('name', $user->company->name) !!}

    @error('name')
    <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <strong>Patios:</strong>
    @error('yards')
    <small class="text-danger">
        <strong>{{$message}}</strong>
    </small>
    @enderror
    <div class="container">
        <div class="row">
            @foreach($yards as $yard)
                <div class="col-md-4">
                    <label>
                        {!! Form::checkbox('yard_id[]', $yard->id, $useryard->contains($yard), ['class'=>'mr-1']) !!}
                        <span>{{$yard->name}}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
