@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>

                    <div class="panel-body">
                        <form method="post" action="{{url('threads')}}">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="channel_id" class="form-group">Choose a Channel</label>
                                <select name="channel_id" required id="channel_id" class="form-control">
                                    <option value="">Choose One...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}"
                                                @if($channel->id == old('channel_id')) selected @endif>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="title" class="form-group">Title</label>
                                <input required name="title" id="title" class="form-control" value="{{old('title')}}">
                            </div>


                            <div class="form-group">
                                <label class="form-group">Body</label>
                                <textarea name="body" rows="8" class="form-control" required>{{old('body')}}</textarea>
                            </div>

                            <button class="btn btn-primary">Publish</button>

                            @if(count($errors))
                                @foreach($errors->all() as $error)
                                    <ul class="alert alert-danger">
                                        <li> {{$error}}</li>
                                    </ul>
                                @endforeach
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
