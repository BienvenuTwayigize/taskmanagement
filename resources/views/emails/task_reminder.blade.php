<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Task Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f1f1f1;
            color: #333333;
            padding: 10px 20px;
            text-align: center;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .task-details {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            padding: 10px;
            margin-top: 10px;
        }
        .task-details p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Task Reminder</h1>
        </div>
        <div class="content">
            <p>Hello, {{ $task->assignedTo->name }}</p>
            <p>This is a reminder for your task titled "<strong>{{ $task->title }}</strong>".</p>

            <div class="task-details">
                <h3>Task Details:</h3>
                <p><strong>Description:</strong> {{ $task->description }}</p>
                <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
                <p><strong>Due Date:</strong> {{ $task->end_date }}</p>
            </div>

            @if($finalReminder)
                <p style="color: red;"><strong>This is the last reminder.</strong></p>
            @endif

            <p>Please make sure to complete it on time.</p>

            <p>Thank you.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Task Management App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
