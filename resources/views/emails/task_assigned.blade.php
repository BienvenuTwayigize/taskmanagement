<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Task Assigned</title>
</head>
<body>
    <h1>New Task Assigned</h1>

    <p>Hello, {{ $student->name }}</p>

    <p>You have been assigned a new task.</p>

    <h3>Task Details:</h3>
    <ul>
        <li><strong>Title:</strong> {{ $task->title }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
        <li><strong>Priority:</strong> {{ ucfirst($task->priority) }}</li>
        <li><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->end_date)->format('Y-m-d') }}</li>
    </ul>

    <p>Please log in to your account to view more details.</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>
