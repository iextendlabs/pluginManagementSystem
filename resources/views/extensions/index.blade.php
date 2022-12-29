@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Extensions</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                @can('extension-create')
                    <a class="btn btn-success" href="{{ route('extensions.create') }}"> Create New Extension</a>
                @endcan
            </div>
        </div>
    </div><hr>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('fail'))
        <div class="alert alert-danger">
            <span>{{ $message }}</span>
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Marketplace Link</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($extensions as $extension)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $extension->title }}</td>
                    <td><a href="{{ $extension->marketplaceLink }}" target="_blank">Click</a></td>
                    <td>{{ $extension->status }}</td>
                    <td>
                        <form action="{{ route('extensions.destroy',$extension->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('extensions.show',$extension->id) }}">Show</a>
                            @can('extension-edit')
                            <a class="btn btn-primary" href="{{ route('extensions.edit',$extension->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('extension-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $extensions->links() !!}
        </div>
    </div>
@endsection