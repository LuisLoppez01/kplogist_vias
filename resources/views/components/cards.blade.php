
<div class="profile-card-2" wire:click="openModal({{$merge_track->id}})">
    <img src="{{ asset('img/Track.jpg') }}" width="300" class="img img-responsive">
    <div class="profile-id">
{{--        <input type="text" class="profile-id" disabled value="{{$trackId}}" placeholder="{{$trackId}}" wire:model="selectedCard">--}}
    <span>{{$trackId}}</span>
    </div>
    <div class="profile-name"><span>{{ $title }}</span></div>
    <div class="profile-username"><span>{{ $description }}</span></div>
</div>
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
@endsection




