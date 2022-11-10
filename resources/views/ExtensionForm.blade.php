<!DOCTYPE html>
<html lang="en">
  <head>
    @include('header')
  </head>
<body>
  <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <div class="card-body">
                  <a href="{{url('/')}}"><div class="badge badge-outline-primary float-end">Home</div></a>
                    <h3 class="card-title">Add Extension</h3><br>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <form action="addExtension" method="post" enctype="multipart/form-data" id="form-extension" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" placeholder="Entry Name" id="input-name" value="{{ old('name') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('name'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-demo-link">Demo Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="demo_link"  placeholder="Entry Demo Link" id="input-demo-link" value="{{ old('demo_link') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('demo_link'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-admin-username">Admin Username</label>
                        <div class="col-sm-10">
                          <input type="text" name="admin_username" placeholder="Entry Admin Username" id="input-admin-username" value="{{ old('admin_username') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('admin_username'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-admin-password">Admin Password</label>
                        <div class="col-sm-10">
                          <input type="text" name="admin_password" placeholder="Entry Admin Password" id="input-admin-password" value="{{ old('admin_password') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('admin_password'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-marketplace-link">Marketplace Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="marketplace_link"  placeholder="Entry Marketplace Link" id="input-marketplace-link" value="{{ old('marketplace_link') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('marketplace_link'){{ $message }}@enderror</span>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-demo">Demo Ready</label>
                        <div class="col-sm-10 radio">
                          <label class="radio-inline"><input type="radio" name="demo" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="demo" value="0" checked> No</label>
                        </div>
                      </div><br>
                      <button type="submit" form="form-extension" data-toggle="tooltip" title="Save" class="badge badge-outline-success">Save</button>
                      <a href="{{url('/')}}"><button type="button" data-toggle="tooltip" title="Cancel" class="badge badge-outline-warning">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iExtendLabs.com 2022</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @include('footer')
  </body>
</html>