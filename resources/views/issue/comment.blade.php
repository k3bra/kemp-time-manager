<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <h5 class="flex">
                <a href="/profiles/{{$comment->owner->name}}" class="flex"> {{$comment->owner->name }} </a> said {{ $comment->created_at->diffForHumans() }}...
            </h5>
        </div>
    </div>
    <div class="panel-body">
        {{$comment->body }}
    </div>
</div>