@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Extension</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                <a class="btn btn-primary" href="{{ route('extensions.index') }}"> Back</a>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $extension->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $status->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marketplace Link:</strong>
                <a href="{{ $extension->marketplaceLink }}" target="_blank">Click</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Drive Link:</strong>
                <a href="{{ $extension->driveLink }}" target="_blank">Click</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Github Link:</strong>
                <a href="{{ $extension->githubLink }}" target="_blank">Click</a>
            </div>
        </div>
    </div>
@endsection