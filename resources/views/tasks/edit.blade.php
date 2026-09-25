<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - Social Feed</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <header class="topbar">
            <div class="brand">Social Feed</div>
            <a class="brand-pill" href="{{ route('tasks.index') }}">Back to tasks</a>
        </header>

        <section class="compose-card">
            <div class="eyebrow">Task details</div>
            <h2>Edit task</h2>

            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="grid">
                    <div>
                        <label for="task_name">Task name</label>
                        <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" required>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label for="due_date">Due date</label>
                        <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date) }}">
                    </div>
                </div>

                <div class="field-block">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="field-block">
                    <button type="submit" class="primary-btn">Save changes</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>