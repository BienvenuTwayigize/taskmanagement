@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tasks</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/admin')}}">Home</a></li>
            <li class="breadcrumb-item active">Tasks</li>
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
                     <h3 class="card-title">All Tasks</h3>
                  </div>
                <div class="col-md-6">
                  <button type="button" style="" class="btn btn-danger"><a style="color:azure;" href="{{ route('tasks.create') }}">Add Task</a></button>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Task Title</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach($tasks as $task)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->assignedTo->name }}</td>
                    <td>{{ $task->createdBy->name }}</td>
                    <td>
                      @switch($task->status)
                          @case('pending')
                              <span class="badge badge-secondary">Pending</span>
                              @break
                          @case('inprogress')
                              <span class="badge badge-primary">In Progress</span>
                              @break
                          @case('overdue')
                              <span class="badge badge-danger">Overdue</span>
                              @break
                          @case('completed')
                              <span class="badge badge-success">Completed</span>
                              @break
                          @default
                              <span class="badge badge-secondary">{{ ucfirst($task->status) }}</span>
                      @endswitch
                    </td>
                    <td>
                      @switch($task->priority)
                        @case('low')
                            <span class="badge badge-success">Low</span>
                            @break
                        @case('medium')
                            <span class="badge badge-warning">Medium</span>
                            @break
                        @case('high')
                            <span class="badge badge-danger">High</span>
                            @break
                        @default
                            <span class="badge badge-secondary">{{ ucfirst($task->priority) }}</span>
                      @endswitch
                    </td>
                    <td>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-info">View</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to DELETE Task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                  <!--
                  <tr>
                    <td colspan="7"> No Vehicles Available</td>
                   </tr>
                  --->
                  </tbody>

                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Task Title</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection