@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Extension</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('extensions.index') }}"> Back</a>
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
    <form action="{{ route('extensions.store') }}" method="POST">
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
                    <strong>Marketplace Link:</strong>
                    <input type="text" name="marketplaceLink" value="{{ old('marketplaceLink') }}" class="form-control" placeholder="Marketplace Link">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Drive Link:</strong>
                    <input type="text" name="driveLink" value="{{ old('driveLink') }}" class="form-control" placeholder="Drive Link">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Github Link:</strong>
                    <input type="text" name="githubLink" value="{{ old('githubLink') }}" class="form-control" placeholder="Github Link">
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
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 15px !important;">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection