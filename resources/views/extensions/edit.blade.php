@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Extension</h2>
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
    <form action="{{ route('extensions.update',$extension->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $extension->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Marketplace Link:</strong>
                    <input type="text" name="marketplaceLink" value="{{ $extension->marketplaceLink }}" class="form-control" placeholder="Marketplace Link">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Drive Link:</strong>
                    <input type="text" name="driveLink" value="{{ $extension->driveLink }}" class="form-control" placeholder="Drive Link">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Github Link:</strong>
                    <input type="text" name="githubLink" value="{{ $extension->githubLink }}" class="form-control" placeholder="Github Link">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="statusId" id="status" class="form-control" >
                        <option></option>
                        @foreach($statuses as $status)
                            @if($status->id == $extension->statusId)
                                <option value="{{$status->id}}" selected>{{$status->title}}</option>
                            @else
                                <option value="{{$status->id}}">{{$status->title}}</option>
                            @endif
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