<div class="profile-card-2" data-toggle="modal" data-target=".myModal-lg"><img src="{{ asset('img/Track.jpg') }}" width="300" class="img img-responsive">
    <div class="profile-id">
{{--        <input type="text" class="profile-id"  value="{{$trackId}}" placeholder="{{$trackId}}">--}}
{{--        {{Form::input('text','trackid',$trackId, ['class'=>"profile-id", 'wire:model'=>'selectedCard','placeholder'=>$trackId])}}--}}
            <span>{{$trackId}}</span>
    </div>
    <div class="profile-name"><span>{{ $title }}</span></div>
    <div class="profile-username"><span>{{ $description }}</span></div>
{{--    @dump($trackId)--}}

</div>

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
@endsection
