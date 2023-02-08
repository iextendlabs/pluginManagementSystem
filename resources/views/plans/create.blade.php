@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Plan</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('plans.index') }}"> Back</a>
            </div>
        </div>
    </div><hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" placeholder="Description"cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Extension:</strong>
                    <select name="extensionId" id="extension" class="form-control" >
                        <option></option>
                        @foreach($extensions as $extension)
                        @if(old('extension') == $extension->id)
                            <option value="{{$extension->id}}" selected>{{$extension->title}}</option>
                        @else
                            <option value="{{$extension->id}}">{{$extension->title}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assigned:</strong>
                    <select name="assigneeId" id="assignee" class="form-control" >
                        <option></option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="statusId" id="status" class="form-control" >
                        <option></option>
                        @foreach($statuses as $status)
                        <option value="{{$status->id}}">{{$status->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Priority:</strong>
                    <select name="priorityId" id="priority" class="form-control" >
                        <option></option>
                        @foreach($priorities as $priority)
                        <option value="{{$priority->id}}">{{$priority->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Due Date:</strong>
                    <input type="date" name="dueDate" value="{{ old('dueDate') }}" class="form-control" placeholder="Due Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Spend Hours:</strong>
                    <input type="text" name="spendHours" value="{{ old('spendHours') }}" class="form-control" placeholder="Spend Hours">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 15px !important;">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection