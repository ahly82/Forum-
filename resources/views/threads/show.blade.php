@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 ">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <a href="#">{{$thread->creator->name}}</a>
                    posted :
                    {{$thread->title}}
                </div>

                <div class="panel-body">
                    {{$thread->body}}
                </div>
            </div>

            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach
            {{$replies->links()}}

            @if(auth()->check())
                <form method="POST" action="{{url($thread->path().'/replies')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <textarea name="body" class="form-control" rows="5" placeholder="have something to say ?">

                            </textarea>
                        <br>
                        <button class="btn btn-primary"> POST</button>
                    </div>
                </form>
            @else
                <p class="text-center"> please <a href="{{route('login')}}">Sign in </a> to participate in
                    discussion </p>
            @endif
        </div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>The Thread Was Published at {{$thread->created_at->diffForHumans()}}by
                        <a href="#"> {{$thread->creator->name}}</a> and currently
                        has {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count) }}
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection
