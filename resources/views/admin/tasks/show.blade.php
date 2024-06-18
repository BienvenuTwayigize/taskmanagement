@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Task Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Show Task</li>
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
            <div class="card card-success">
                <div class="card-header">
                <h3 class="card-title">Task Details</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <p>{{ $task->title }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <p>{{ $task->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to">Assigned To:</label>
                                <p>{{ $task->assignedTo->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_by">Assigned By:</label>
                                <p>{{ $task->assignedBy->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="created_by">Created By:</label>
                                <p>{{ $task->createdBy->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_task">Parent Task:</label>
                                <p>{{ $task->parentTask ? $task->parentTask->title : 'None' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <p>{{ $task->start_date }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <p>{{ $task->end_date }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reminder_start_date">Reminder Start Date:</label>
                                <p>{{ $task->reminder_start_date }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reminder_end_date">Reminder End Date:</label>
                                <p>{{ $task->reminder_end_date }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                @php
                                    $statusClass = '';
                                    switch ($task->status) {
                                        case 'pending':
                                            $statusClass = 'secondary';
                                            break;
                                        case 'overdue':
                                            $statusClass = 'danger';
                                            break;
                                        case 'completed':
                                            $statusClass = 'success';
                                            break;
                                        case 'inprogress':
                                            $statusClass = 'primary'; // Adjust the class for 'inprogress' as needed
                                            break;
                                        default:
                                            $statusClass = 'secondary';
                                            break;
                                    }
                                @endphp
                                <span class="badge badge-{{ $statusClass }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priority">Priority:</label>
                                <span class="badge badge-{{ $task->priority == 'low' ? 'success' : ($task->priority == 'medium' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <p>{{ $task->category }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="progress">Progress:</label>
                                <div class="progress">
                                    <div class="progress-bar bg-info progress-bar-striped" role="progressbar"
                                         aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100"
                                         style="width: {{ $task->progress }}%">
                                        <span class="sr-only">{{ $task->progress }}% Complete</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span>{{ $task->progress }}% done</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attachments">Attachments:</label>
                                @if($task->attachments)
                                    <ul>
                                        @foreach(json_decode($task->attachments) as $attachment)
                                            <li><a href="{{ asset('storage/' . $attachment) }}" target="_blank">{{ $attachment }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No attachments</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comments">Comments:</label>
                                <p>{{ $task->comments }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_recurring">Is Recurring:</label>
                                <p>{{ $task->is_recurring ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recurrence_interval">Recurrence Interval:</label>
                                <p>{{ ucfirst($task->recurrence_interval) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        <!-- /.card -->

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