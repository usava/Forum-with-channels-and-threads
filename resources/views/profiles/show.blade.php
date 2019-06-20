@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>
                <div class="row justify-content-left">
                    <div class="col-md-12">
                        @forelse($activities as $date => $records)
                            <h3 class="page-header">{{ $date }}</h3>

                            @foreach($records as $activity)
                                @if(view()->exists("profiles.activities.{$activity->type}"))
                                    @include("profiles.activities.{$activity->type}")
                                @endif
                            @endforeach
                        @empty
                          <p>There is no activity for this user.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
