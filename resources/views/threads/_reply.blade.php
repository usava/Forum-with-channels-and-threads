<div class="card">
    <div class="card-header">
        <div class="level d-flex align-items-center">
            <h5 class="flex-grow-1">
                <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
                said {{ $reply->created_at->diffForHumans() }}
            </h5>

            <div>

                <form action="/replies/{{ $reply->id }}/favorites" method="post">
                    @csrf
                    <button class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : ''}}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
