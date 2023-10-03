@section('title','Password Change')
@extends('layout.backend.master')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Password Change Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            @if(Auth::guard('staff')->check())
              <form class="form-horizontal" action="{{route('admin.change.password')}}" method="post">
            @endif
              @csrf 
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="conPassword" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-warning float-right">Change Password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

