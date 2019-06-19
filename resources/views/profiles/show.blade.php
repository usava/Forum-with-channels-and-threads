@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">

            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>
        <div class="row justify-content-left">
            <div class="col-md-8">
                @foreach($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">{{ $thread->title }} </span>
                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                @endforeach

            </div>

            <p>{{ $threads->links() }}</p>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
