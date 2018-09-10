@extends('layouts.master')

@section('content')
    @if(Auth::check())
        <a href="{{ url('/board/create') }}" class="btn btn-primary">Post Ad</a>
    @endif
    <hr/>
    @include('partials.flash_notification')

    @if(count($adsList))

        <div class="row mb-2">
            @foreach($adsList as $ad)
                <div class="col-md-6">

                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary"><a href="{{ route('user.edit', $ad->users['id']) }}">{{$ad->users['name']}}</a></strong>
                            <h3 class="mb-0">
                                <a class="text-dark" href="#">{{ $ad->title }}</a>
                            </h3>
                            <div class="mb-1 text-muted">{{$ad->created_at->diffForHumans()}}</div>
                            <p class="card-text mb-auto">{{ str_limit($ad->body, $limit = 80, $end = '...') }}</p>
                            <a href="#">Continue reading</a>
                        <!--
                        @if(Auth::check())
                            {!! Form::open(['route' => ['board.update', $ad->id],  'method' => 'put']) !!}
                            @if($ad->bookmark)
                                {!! Form::submit('- bookmark', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                            @else
                                {!! Form::submit('+ bookmark', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                            @endif
                            {!! Form::close() !!}
                            @if($ad->user_id === Auth::id())
                                {!! Form::open(['route' => ['board.destroy', $ad->id],  'method' => 'delete']) !!}
                                {!! Form::hidden('id', $ad->id) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-outline-secondary']) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
                                -->

                        </div>
                        @if ($ad->image['name'])
                        <img class="card-img-right flex-auto d-none d-lg-block"  style="width: 200px; height: 250px; object-fit: cover;"
                             src="/uploads/{{ $ad->image['name'] }}">
                        @else
                            <img class="card-img-right flex-auto d-none d-lg-block  object-fit_cover"  src="/no.png">
                        @endif
                    </div>
                </div>

            @endforeach

        </div>

        <div>
            {!! $adsList->render() !!}
        </div>
    @else
        <div class="text-center">
            <h3>No ads available yet</h3>
            @if(Auth::check())
                <p><a href="{{ url('/board/create') }}">Create new ad</a></p>
            @endif
        </div>
    @endif
@endsection


