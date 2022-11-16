<!DOCTYPE html>
<html lang="en">
  <head>
    @include('header')
  </head>
  <style>
      td img{
        height: 82px !important;
        width: 82px !important;
      }
      .navbar img{
        height: 70px;
        width: 161px;
        padding-top: 12px;
      }
  </style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <a href="{{url('/')}}"><img src="assets/images/full-logo.png" alt="logo"  /></a>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form action="searchExtension" method="post" enctype="multipart/form-data" id="form-Extension" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  @csrf
                  <input type="text" class="form-control" placeholder="Search Extensions" @if(isset($search)) value="{{ $search}}" @endif name="search">
                  <button type="submit" form="form-Extension" data-toggle="tooltip" title="Search" class="btn btn-outline-secondary" style="border-color: #545b79 !important"><i class="mdi mdi-magnify"></i></button>
                </form>
              </li>
            </ul>
          </div>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-8 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <a href="{{url('/extensionForm')}}"><div class="badge badge-outline-primary float-end">Add</div></a>
                    <h4 class="card-title">Extensions</h4>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <div class="table-responsive">
                      <table class="table"  style="text-align: center;">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Demo Link </th>
                            <th> Admin Username </th>
                            <th> Admin Password</th>
                            <th> Marketplace Link </th>
                            <th> Demo </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($extensions) != 0)
                          @foreach($extensions as $extension)
                          <tr>
                            <td> {{ substr($extension->name,0,30)}}.... </td>
                            <td> @if($extension->demo_link != 'null') <a href="{{$extension->demo_link}}" target="_blank">Click</a>@else ---- @endif</td>
                            <td> {{$extension->admin_username}} </td>
                            <td> {{$extension->admin_password}} </td>
                            <td> @if($extension->marketplace_link != 'null') <a href="{{$extension->marketplace_link}}" target="_blank">Click</a>@else ---- @endif</td>
                            <td> @if($extension->demo == 1) Ready @else Not Ready @endif</td>
                            <td>
                              <a href="{{url('/deleteExtension',$extension->id)}}"><div class="badge badge-outline-warning"> Delete</div></a>
                              <a href="{{url('/editExtension',$extension->id)}}"><div class="badge badge-outline-success">Edit</div></a>
                              <a href="{{url('/viewUpdates',$extension->id)}}"><div class="badge badge-outline-primary">View Updates</div></a>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan="6">No results!</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Filter</h4>
                    <hr>
                    <form action="filterExtension" method="post" enctype="multipart/form-data" id="form-filter" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" placeholder="Entry Name" id="input-name" @if(isset($old_data)) value="{{ $old_data['name'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-demo-link">Demo Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="demo_link"  placeholder="Entry Demo Link" id="input-demo-link" @if(isset($old_data)) value="{{ $old_data['demo_link'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="input-marketplace-link">Marketplace Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="marketplace_link" placeholder="Entry Marketplace Link" id="input-marketplace-link" @if(isset($old_data)) value="{{ $old_data['marketplace_link'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-demo">Demo Ready</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['demo'] == 1)
                              <label class="radio-inline"><input type="radio" name="demo" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="demo" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="demo" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="demo" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="demo" value="1" checked> Yes</label>
                          <label class="radio-inline"><input type="radio" name="demo" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <button type="submit" form="form-filter" data-toggle="tooltip" title="Filter" class="badge badge-outline-success">Filter</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iExtendLabs.com 2021</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @include('footer')
    </body>
</html>