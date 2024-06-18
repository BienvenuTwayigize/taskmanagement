@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@if (session('message'))
<div class="fixed top-10 right-10 z-50">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('message') }}!</strong>
    </div>
</div>

<script>
    setTimeout(function(){
        document.querySelector('.fixed').classList.add('opacity-0', 'pointer-events-none');
        setTimeout(function(){
            document.querySelector('.fixed').remove();
        }, 500);
    }, 5000);
</script>
@endif

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                  <div class="row">
                      <div class="col-md-6">
                          <h3 class="card-title">All Users</h3>
                      </div>
                      <div class="col-md-2">
                          <button type="button" style="" class="btn btn-success">
                              <a style="color:azure;" href="{{ route('users.create') }}">Add User</a>
                          </button>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-primary">
                            <a style="color: azure;" href="{{ route('users.index', ['role' => 1]) }}">All Admins</a>
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-secondary">
                            <a style="color: azure;" href="{{ route('users.index', ['role' => 0]) }}">All Students</a>
                        </button>
                    </div>                    
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($users as $user)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->type == 1 ? 'Admin' : 'Student' }}</td>
                              <td>
                                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to DELETE this user?')">Delete</button>
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Actions</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection