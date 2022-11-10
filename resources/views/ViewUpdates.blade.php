<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include('header')
  </head>
  <style>
    .updates {
      padding: 10px;
      border-left: 6px solid #ffffff;
      background-color: #000000;
      color: #ffffff;
    }
  </style>
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
                  <h3 class="card-title">Extension Updates</h3>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <div class="col-sm-6">
                      @if(isset($updates))
                        @foreach($updates as $update)
                        <textarea class="updates" rows="5" cols="60" disabled>{{ $update->description }}</textarea>
                        <span>@if($update->marketplace_update == 1) Marketplace Updated @else Marketplace Not Updated @endif</span>
                        <span class="float-end">{{ $update->created_at }}</span>
                        <div>
                            <a class="float-end" href="{{url('/deleteUpdates',$update->id)}}"><div class="badge badge-outline-warning"> Delete</div></a>
                        </div><br><br>
                        @endforeach
                      @endif
                    </div>
                </div>
                </div><br>
                <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Add Extension Update</h3><br>
                    <form action="extensionUpdate" method="post" enctype="multipart/form-data" id="form-extension-update" class="form-horizontal">
                      @csrf
                      <input type="hidden" name="extension_id" value="{{ $extension_id }}">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-description">Description</label>
                        <div class="col-sm-10">
                          <textarea name="description" placeholder="Entry Description" id="input-description" class="form-control"></textarea>
                          <span style="color: #f44336 !important;">@error('description'){{ $message }}@enderror</span>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-marketplace_update">Marketplace Update</label>
                        <div class="col-sm-10 radio">
                          <label class="radio-inline"><input type="radio" name="marketplace_update" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="marketplace_update" value="0" checked> No</label>
                        </div>
                      </div><br>
                      <button type="submit" form="form-extension-update" data-toggle="tooltip" title="Save" class="badge badge-outline-success">Save</button>
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