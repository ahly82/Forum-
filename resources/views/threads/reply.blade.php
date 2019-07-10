<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a class="flex" href="#">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
            </h5>
            <div>
                <form method="POST" action="{{url('replies/'.$reply->id.'/favourites')}}">
                    {{csrf_field()}}
                    <button {{$reply->isFavourited() ? 'disabled' : '' }} class="btn btn-default">{{$reply->favourites_count}} {{str_plural('Favourite',$reply->favourites_count)}}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{$reply->body}}
    </div>
</div>