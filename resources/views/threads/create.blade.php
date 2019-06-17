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
                                <label for="inputTitle">Title: </label>
                                <input type="text"
                                       class="form-control" name="title" id="inputTitle" aria-describedby="helpId"
                                       placeholder="Title">
                                <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="taBody">Body: </label>
                                <textarea class="form-control" name="body" id="taBody" rows="8"></textarea>
                            </div>

                            <button type="submit" name="publish" id="publish" class="btn btn-primary">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
