@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
                            </span>

                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan
                        </div>

                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads._reply')
                @endforeach

                <p>{{ $replies->links() }}</p>

                @if(auth()->check())
                    <div class="row justify-content-left" style="margin-top: 30px;">
                        <div class="col-md-8">
                            <form method="post" action="{{ $thread->path() }}/replies">
                                @csrf
                                <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="30" rows="5"
                                      placeholder="Have something to say?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Post</button>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-center">
                        Please <a href="{{ route('login') }}">sign in </a>to participate in this discussion
                    </p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by <a
                                href="#">{{ $thread->creator->name }}</a>
                            and currently
                            has {{ $thread->replies_count }} {{ str_plural('commment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
