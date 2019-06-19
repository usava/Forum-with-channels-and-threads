@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Forum Threads</h1>
                </div>
                @forelse ($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level d-flex align-items-center">
                                <h4 class="flex-grow-1">
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h4>

                                <a href="{{ $thread->path() }}"><strong>{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <article class="m-3 p-2">
                                <div class="body">{{ $thread->body }}</div>
                            </article>
                        </div>
                    </div>
                @empty
                    <p>There are no relevant results at this time.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
