@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Plans</h2>
            </div>
            <div class="pull-right" style="margin-bottom: 15px !important;">
                @can('plan-create')
                    <a class="btn btn-success" href="{{ route('plans.create') }}"> Create New Plan</a>
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
                    <th>Extension</th>
                    <th>Status</th>
                    <th width="350px">Action</th>
                </tr>
                @foreach ($plans as $plan)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $plan->title }}</td>
                    <td>{{ $plan->extension }}</td>
                    <td>{{ $plan->status }}</td>
                    <td>
                        <form action="{{ route('plans.destroy',$plan->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ url('/commentSystem',$plan->id) }}">Comment</a>
                            <a class="btn btn-info" href="{{ route('plans.show',$plan->id) }}">Show</a>
                            @can('plan-edit')
                            <a class="btn btn-primary" href="{{ route('plans.edit',$plan->id) }}">Edit</a>
                            @endcan
                            @csrf
                            @method('DELETE')
                            @can('plan-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $plans->links() !!}
        </div>
    </div>
@endsection