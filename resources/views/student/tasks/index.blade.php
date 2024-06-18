@extends('layouts.student')

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

                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Task Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                    @foreach($tasks as $task)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('student.tasks.show', $task->id) }}">{{ $task->title }}</a></td>
                    <td>{{ $task->description }}</td>
                    <td>
                      @php
                      $statusBadgeClass = '';
                      switch($task->status) {
                          case 'pending':
                              $statusBadgeClass = 'badge-warning';
                              break;
                          case 'inprogress':
                              $statusBadgeClass = 'badge-primary';
                              break;
                          case 'overdue':
                              $statusBadgeClass = 'badge-danger';
                              break;
                          case 'completed':
                              $statusBadgeClass = 'badge-success';
                              break;
                      }
                      @endphp
                      <span class="badge {{ $statusBadgeClass }}">{{ ucfirst($task->status) }}</span>
                  </td>
                    <td> @php
                      $priorityBadgeClass = '';
                      switch($task->priority) {
                          case 'low':
                              $priorityBadgeClass = 'badge-success';
                              break;
                          case 'medium':
                              $priorityBadgeClass = 'badge-warning';
                              break;
                          case 'high':
                              $priorityBadgeClass = 'badge-danger';
                              break;
                      }
                      @endphp
                      <span class="badge {{ $priorityBadgeClass }}">{{ ucfirst($task->priority) }}</span>
                  </td>
                    <td>
                        <a href="{{ route('student.tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
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