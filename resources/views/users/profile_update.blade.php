@extends('layouts.master')

@section('content')

    <h1>User Profile</h1>
    <hr/>
    <div class="row">
        <style>
            .txt-center {
                text-align: center;
            }
            .hide {
                display: none;
            }
            .clear {
                float: none;
                clear: both;
            }
            .rating {
                unicode-bidi: bidi-override;
                direction: rtl;
                text-align: center;
                position: relative;
            }
            .rating > label {
                float: right;
                display: inline;
                padding: 0;
                margin: 0;
                position: relative;
                width: 1.1em;
                cursor: pointer;
                color: #000;
                font-size: 3em;
            }
            .rating > label:hover,
            .rating > label:hover ~ label,
            .rating > input.radio-btn:checked ~ label {
                color: transparent;
            }
            .rating > label:hover:before,
            .rating > label:hover ~ label:before,
            .rating > input.radio-btn:checked ~ label:before,
            .rating > input.radio-btn:checked ~ label:before {
                content: "\2605";
                position: absolute;
                left: 0;
                color: #FFD700;
            }
        </style>

        <div class="col-md-4 order-md-2 mb-4">
            <div class="form-group" id="rating-ability-wrapper">
                @if (\Auth::check() && $rank['ranked_id'] !== Auth::getUser()['id'] && Auth::getUser()['id'] !== $user['id'] )
                <form action="{{ route('rank', $user['id']) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user['id']}}">
                    <div class="txt-center">
                            <div class="rating">
                                <input id="star5" name="amount" type="radio" value="5" class="radio-btn hide" />
                                <label for="star5" >☆</label>
                                <input id="star4" name="amount" type="radio" value="4" class="radio-btn hide" />
                                <label for="star4" >☆</label>
                                <input id="star3" name="amount" type="radio" value="3" class="radio-btn hide" />
                                <label for="star3" >☆</label>
                                <input id="star2" name="amount" type="radio" value="2" class="radio-btn hide" />
                                <label for="star2" >☆</label>
                                <input id="star1" name="amount" type="radio" value="1" class="radio-btn hide" />
                                <label for="star1" >☆</label>
                                <div class="clear"></div>
                            </div>
                        {!!Form::submit('Vote', ['class' => 'btn btn-primary  col-md-5']) !!}
                    </div>
                </form>
                @else 
                <h2 class="bold rating-header" style="">
                    <span class="selected-rating">Rating:</span><small> {{$ratingAmount}}</small>
                </h2>
                @endif
            </div>
        </div>

        @if(md5($user->id) === md5(Auth::id()))
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">User form</h4>

            {!! Form::model($user, ['method' => 'put', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}
            @include('users._form_user')
            @include('users._form')
            {!! Form::hidden('id', null,['class' => 'form-control']) !!}
            <!-- submit button -->

            <hr class="mb-4">
            {!!Form::submit('Update', ['class' => 'btn btn-primary  col-md-5']) !!}
            <a href="{{ url('/') }}" class="btn btn-secondary  col-md-5">Cancel</a>
            {!! Form::close() !!}

        </div>
        @endif
    </div>



    <hr/>
    <h2>Comments</h2>
    <hr/>
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        @foreach ($comments as $comment)
            <div class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_165bdd4564f%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_165bdd4564f%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">{{ '@'.$comment['user']['name'] }}</strong>
                {{ $comment['comment'] }}
            </p>
        </div>
        @endforeach      
    </div>
     <div class="form-group">
        {!! Form::model($user, ['method' => 'post', 'route' => ['comments.add'], 'class' => 'form-horizontal', 'role' => 'form']) !!}
         {{ csrf_field() }}
        <label for="comment">Comment:</label>
        <input type="hidden" name="user_id" value="{{$user['id']}}">
        <textarea class="form-control" rows="5" name="comment" id="comment" style="margin-bottom:20px"></textarea>
        {!!Form::submit('Send', ['class' => 'btn btn-success  col-md-5']) !!}
        {!! Form::close() !!}
    </div>
@endsection