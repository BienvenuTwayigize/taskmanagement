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
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                  </div>
      
                  <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="assigned_to">Assign to</label>
                              <select class="form-control select2bs4" id="assigned_to" name="assigned_to" required>
                                  <option value="">Assign to Student</option>
                                  @foreach($students as $student)
                                      <option value="{{ $student->id }}" {{ $task->assigned_to == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="parent_task_id">Parent Task</label>
                              <select class="form-control select2bs4" id="parent_task_id" name="parent_task_id">
                                  <option value="">None</option>
                                  @foreach($tasks as $parentTask)
                                      <option value="{{ $parentTask->id }}" {{ $task->parent_task_id == $parentTask->id ? 'selected' : '' }}>{{ $parentTask->title }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="start_date">Start Date</label>
                              <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}" required>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="end_date">End Date</label>
                              <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $task->end_date }}" required>
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="reminder_start_date">Reminder Start Date</label>
                              <input type="date" class="form-control" id="reminder_start_date" name="reminder_start_date" value="{{ $task->reminder_start_date }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="reminder_end_date">Reminder End Date</label>
                              <input type="date" class="form-control" id="reminder_end_date" name="reminder_end_date" value="{{ $task->reminder_end_date }}">
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form-control" id="status" name="status" required>
                                  <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                  <option value="inprogress" {{ $task->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                                  <option value="overdue" {{ $task->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                  <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="priority">Priority</label>
                              <select class="form-control" id="priority" name="priority" required>
                                  <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                  <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                  <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                              </select>
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="category">Category</label>
                              <input type="text" class="form-control" id="category" name="category" value="{{ $task->category }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="progress">Progress</label>
                              <input placeholder="0 - 100" type="number" class="form-control" id="progress" name="progress" value="{{ $task->progress }}" min="0" max="100">
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="attachments">Attachments</label>
                              <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                              @if($task->attachments)
                                  <div class="mt-2">
                                      <strong>Current Attachments:</strong>
                                      <ul>
                                          @foreach(json_decode($task->attachments) as $attachment)
                                              <li>{{ $attachment }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="comments">Comments</label>
                              <textarea class="form-control" id="comments" name="comments">{{ $task->comments }}</textarea>
                          </div>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="is_recurring">Is Recurring</label>
                              <select class="form-control" id="is_recurring" name="is_recurring">
                                  <option value="0" {{ $task->is_recurring == 0 ? 'selected' : '' }}>No</option>
                                  <option value="1" {{ $task->is_recurring == 1 ? 'selected' : '' }}>Yes</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="recurrence_interval">Recurrence Interval</label>
                              <select class="form-control" id="recurrence_interval" name="recurrence_interval">
                                  <option value="daily" {{ $task->recurrence_interval == 'daily' ? 'selected' : '' }}>Daily</option>
                                  <option value="weekly" {{ $task->recurrence_interval == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                  <option value="monthly" {{ $task->recurrence_interval == 'monthly' ? 'selected' : '' }}>Monthly</option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Update Task</button>
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