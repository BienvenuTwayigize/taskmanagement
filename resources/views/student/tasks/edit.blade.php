@extends('layouts.student')

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
            <li class="breadcrumb-item"><a href="{{ url('student') }}">Home</a></li>
            <li class="breadcrumb-item active">Edit Task</li>
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
              <h3 class="card-title">Edit Task</h3>
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
            <form action="{{ route('student.tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="inprogress" {{ $task->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                        <option value="overdue" {{ $task->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="progress">Progress</label>
                    <input type="number" name="progress" id="progress" class="form-control" value="{{ $task->progress }}" min="0" max="100">
                </div>
        
                <button type="submit" class="btn btn-primary">Update Task</button>
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