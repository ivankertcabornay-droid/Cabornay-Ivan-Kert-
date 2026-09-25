<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Feed</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --bg-1: #fff8fb;
            --bg-2: #f1e9ff;
            --panel: rgba(255, 255, 255, 0.88);
            --panel-strong: #fffaf2;
            --ink: #20243a;
            --muted: #68708a;
            --primary: #526ee8;
            --secondary: #6f78a4;
            --accent: #ff6e9a;
            --success: #5b8f68;
            --warning: #ad791e;
            --danger: #df6479;
            --line: #e7dfe9;
            --shadow: rgba(65, 54, 87, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, "Segoe UI", sans-serif;
            background: linear-gradient(180deg, var(--bg-1) 0%, var(--bg-2) 100%);
            color: var(--ink);
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 22px 16px 42px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(10px);
            box-shadow: 0 12px 28px var(--shadow);
        }

        .brand {
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--secondary);
            font-size: 0.75rem;
        }

        .brand-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #687eea);
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.82rem;
            box-shadow: none;
        }

        .compose-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 18px 18px 16px;
            margin-bottom: 18px;
            box-shadow: 0 8px 18px var(--shadow);
        }

        .eyebrow {
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.68rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .compose-card h2 {
            margin: 0 0 16px;
            font-size: clamp(1.35rem, 2vw, 1.8rem);
            line-height: 1.2;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }

        .field-block {
            margin-top: 14px;
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--ink);
        }

        input, textarea, select, button {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #d6dde5;
            background: #fff;
            color: var(--ink);
            padding: 10px 12px;
            font-size: 0.96rem;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: rgba(63, 91, 125, 0.7);
            box-shadow: 0 0 0 3px rgba(63, 91, 125, 0.08);
        }

        textarea {
            min-height: 104px;
            resize: vertical;
        }

        button {
            border: none;
            cursor: pointer;
            font-weight: 800;
            transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s ease;
        }

        button:hover {
            transform: translateY(-1px);
            opacity: 0.98;
        }

        .primary-btn {
            background: var(--accent);
            color: white;
            padding: 11px 18px;
            width: auto;
            box-shadow: none;
        }

        .task-feed {
            display: grid;
            gap: 18px;
        }

        .task-card {
            background: var(--panel-strong);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.03);
        }

        .task-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
        }

        .task-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #9b65dc, #e45ca8);
            color: #fff;
            font-weight: 800;
            letter-spacing: 0.06em;
            box-shadow: none;
        }

        .task-copy {
            flex: 1;
        }

        .task-copy h3 {
            margin: 0 0 5px;
            font-size: 1.08rem;
            line-height: 1.3;
        }

        .task-meta {
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 0.72rem;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status.pending {
            background: rgba(154, 123, 66, 0.12);
            color: #7c622d;
        }

        .status.in_progress {
            background: rgba(108, 122, 137, 0.12);
            color: var(--secondary);
        }

        .status.completed {
            background: rgba(61, 124, 95, 0.12);
            color: var(--success);
        }

        .task-body {
            margin-top: 14px;
            color: #2d2a38;
            line-height: 1.6;
            font-size: 0.92rem;
        }

        .edit-form {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--line);
        }

        .edit-details {
            margin-top: 14px;
        }

        .edit-details summary {
            width: fit-content;
            color: var(--primary);
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 800;
            list-style: none;
        }

        .edit-details summary::-webkit-details-marker {
            display: none;
        }

        .edit-form .field-block {
            margin-top: 12px;
        }

        .edit-form .field-block:first-child {
            margin-top: 0;
        }

        .task-footer {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
        }

        .due-date {
            color: var(--muted);
            font-weight: 700;
        }

        .task-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .task-actions form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .status-select {
            width: auto;
            min-width: 146px;
            background: #fff;
        }

        .ghost-btn,
        .delete-btn {
            width: auto;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
        }

        .ghost-btn {
            background: rgba(108, 122, 137, 0.08);
            color: var(--secondary);
        }

        .delete-btn {
            background: rgba(168, 83, 95, 0.08);
            color: var(--danger);
        }

        .empty {
            background: rgba(255, 255, 255, 0.72);
            border: 1px dashed rgba(132, 117, 171, 0.35);
            border-radius: 18px;
            padding: 22px;
            text-align: center;
            font-size: 0.98rem;
            color: var(--muted);
            box-shadow: 0 10px 20px rgba(65, 54, 87, 0.04);
        }

        @media (max-width: 640px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .task-head,
            .task-footer,
            .task-actions form {
                flex-direction: column;
                align-items: flex-start;
            }

            .primary-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="topbar">
            <div class="brand">Social Feed</div>
            <a class="brand-pill" href="#composer">Add another task</a>
        </header>

        <section class="compose-card" id="composer">
            <div class="eyebrow">What's happening?</div>
            <h2>Drop a new task into the feed</h2>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="grid">
                    <div>
                        <label for="task_name">Task name</label>
                        <input id="task_name" name="task_name" type="text" required>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label for="due_date">Due date</label>
                        <input id="due_date" name="due_date" type="date">
                    </div>
                </div>

                <div class="field-block">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Add notes for this task..."></textarea>
                </div>

                <div class="field-block">
                    <button type="submit" class="primary-btn">Add another task</button>
                </div>
            </form>
        </section>

        @if ($tasks->isEmpty())
            <p class="empty">No tasks yet. Share the next move.</p>
        @else
            <div class="task-feed">
                @foreach ($tasks as $task)
                    <article class="task-card">
                        <div class="task-head">
                            <div class="task-profile">
                                <div class="avatar">{{ strtoupper(substr($task->task_name, 0, 1)) }}</div>
                                <div class="task-copy">
                                    <h3>{{ $task->task_name }}</h3>
                                    <div class="task-meta">{{ $task->created_at ? $task->created_at->format('M d, Y') : 'New' }}</div>
                                </div>
                            </div>
                            <span class="status {{ $task->status }}">{{ ucfirst($task->status) }}</span>
                        </div>

                        <div class="task-footer">
                            @if ($task->due_date)
                                <span class="due-date">Due: {{ $task->due_date }}</span>
                            @else
                                <span class="due-date">No due date</span>
                            @endif

                            <div class="task-actions">
                                <a class="ghost-btn" href="{{ route('tasks.edit', $task) }}">Edit</a>

                                <form method="POST" action="{{ route('tasks.update', $task) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="task_name" value="{{ $task->task_name }}">
                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                    <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                                    <select name="status" class="status-select" aria-label="Update status for {{ $task->task_name }}">
                                        <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <button type="submit" class="ghost-btn">Update</button>
                                </form>

                                <details class="edit-details">
                                    <summary>Edit task</summary>
                                    <form method="POST" action="{{ route('tasks.update', $task) }}" class="edit-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid">
                                            <div>
                                                <label for="task_name_{{ $task->id }}">Task name</label>
                                                <input id="task_name_{{ $task->id }}" name="task_name" type="text" value="{{ $task->task_name }}" required>
                                            </div>
                                            <div>
                                                <label for="status_{{ $task->id }}">Status</label>
                                                <select id="status_{{ $task->id }}" name="status" required>
                                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="due_date_{{ $task->id }}">Due date</label>
                                                <input id="due_date_{{ $task->id }}" name="due_date" type="date" value="{{ $task->due_date }}">
                                            </div>
                                        </div>
                                        <div class="field-block">
                                            <label for="description_{{ $task->id }}">Description</label>
                                            <textarea id="description_{{ $task->id }}" name="description">{{ $task->description }}</textarea>
                                        </div>
                                        <div class="field-block">
                                            <button type="submit" class="ghost-btn">Save changes</button>
                                        </div>
                                    </form>
                                </details>

                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
