@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Task Form</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Task</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
  <!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Add Task</h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-warning">
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>

            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('users.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Names</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="type">User Role</label>
                  <select class="form-control" id="type" name="type" required>
                      <option value="">Select User Role</option>
                      <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Student</option>
                      <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Admin</option>
                  </select>
              </div>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Create User</button>
              </div>
            </form>
            
          </div>
          <!-- /.card -->


        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
@endsection