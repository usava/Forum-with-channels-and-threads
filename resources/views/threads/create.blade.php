@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="channel_id">Choose a Channel</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Choose one...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                        @endforeach
                                </select>
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                                <label for="inputTitle">Title: </label>
                                <input type="text"
                                       class="form-control" name="title" id="inputTitle" aria-describedby="helpId"
                                       placeholder="Title" value="{{ old('title') }}" required>
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="taBody">Body: </label>
                                <textarea class="form-control" name="body" id="taBody"
                                          rows="8" required>{{ old('body') }}</textarea>
                            </div>

                            <button type="submit" name="publish" id="publish" class="btn btn-primary">Publish</button>
                        </form>

                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
