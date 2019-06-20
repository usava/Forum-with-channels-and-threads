@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} published a thread  <a href="{{ $activity->subject->path() }}"> "{{ $activity->subject->title }}"</a> thread
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent

