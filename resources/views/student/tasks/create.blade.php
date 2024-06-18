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
            <form action="{{ route('tasks.store') }}" method="POST">
              @csrf
                  <div class="card-body">
                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" required>
                      </div>
          
                      <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" id="description" name="description" required></textarea>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label for="assigned_to">Assign to</label>
                              <select class="form-control select2bs4" id="assigned_to" name="assigned_to" required>
                                <option value="">Assign to Student</option>
                                  @foreach($users as $student)
                                      <option value="{{ $student->id }}">{{ $student->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label for="parent_task_id">Parent Task</label>
                              <select class="form-control select2bs4" id="parent_task_id" name="parent_task_id">
                                  <option value="">None</option>
                                  @foreach($tasks as $task)
                                      <option value="{{ $task->id }}">{{ $task->title }}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6">
              <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" id="start_date" name="start_date" required>
                      </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input type="date" class="form-control" id="end_date" name="end_date" required>
                      </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                          <label for="reminder_start_date">Reminder Start Date</label>
                          <input type="date" class="form-control" id="reminder_start_date" name="reminder_start_date">
                      </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                          <label for="reminder_end_date">Reminder End Date</label>
                          <input type="date" class="form-control" id="reminder_end_date" name="reminder_end_date">
                      </div>
                        </div>
                      </div>
                    
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form-control" id="status" name="status" required>
                                  <option value="pending">Pending</option>
                                  <option value="inprogress">In Progress</option>
                                  <option value="overdue">Overdue</option>
                                  <option value="completed">Completed</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                          <label for="priority">Priority</label>
                          <select class="form-control" id="priority" name="priority" required>
                              <option value="low">Low</option>
                              <option value="medium">Medium</option>
                              <option value="high">High</option>
                          </select>
                      </div>
                        </div>
                      </div>
                    
          
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                          <label for="category">Category</label>
                          <input type="text" class="form-control" id="category" name="category">
                      </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="progress">Progress</label>
                            <input placeholder="0 - 100" type="number" class="form-control" id="progress" name="progress" min="0" max="100">
                        </div>
                        </div>
                      </div>
          
                      
          
                      <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label for="attachments">Attachments</label>
                          <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                      </div>
                        </div>
                        <div class="col-sm-6">
                      <div class="form-group">
                          <label for="comments">Comments</label>
                          <textarea class="form-control" id="comments" name="comments"></textarea>
                      </div>
                        </div>
                      </div>
          
                      
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="is_recurring">Is Recurring</label>
                              <select class="form-control" id="is_recurring" name="is_recurring">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label for="recurrence_interval">Recurrence Interval</label>
                                <select class="form-control" id="recurrence_interval" name="recurrence_interval">
                                  <option value="daily">Daily</option>
                                  <option value="weekly">Weekly</option>
                                  <option value="monthly">Monthly</option>
                                </select>
                            </div>
                        </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      <button type="submit" class="btn btn-danger">Add Task</button>
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