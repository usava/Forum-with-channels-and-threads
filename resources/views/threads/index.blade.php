@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Forum Threads</div>

                    <div class="card-body">
                        @foreach ($threads as $thread)
                            <article class="m-3 p-2">
                                <div class="level d-flex align-items-center">
                                    <h4 class="flex-grow-1">
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>

                                    <a href="{{ $thread->path() }}"><strong>{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong></a>
                                </div>

                                <div class="body">{{ $thread->body }}</div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
