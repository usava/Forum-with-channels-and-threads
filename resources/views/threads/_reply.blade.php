<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="level d-flex align-items-center">
                <h5 class="flex-grow-1">
                    <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
                    said {{ $reply->created_at->diffForHumans() }}
                </h5>

                @if(Auth::check())
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body">{{ $reply->body }}</div>
        </div>

        @can('update', $reply)
            <div class="card-footer level">
                <button class="btn btn-warning btn-sm mr-2" @click="editing =! editing">Edit</button>
                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>

            </div>
        @endcan
    </div>
</reply>
