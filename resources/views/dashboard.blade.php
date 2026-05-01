<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Queue Monitor</title>
    <style>
        body {
            margin: 0;
            background: #f8fafc;
            color: #0f172a;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 24px;
        }

        table {
            width: 100%;
            overflow: hidden;
            border-collapse: collapse;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .exception {
            max-width: 620px;
            word-break: break-word;
        }

        .status {
            margin-bottom: 16px;
            padding: 12px 16px;
            background: #dcfce7;
            border: 1px solid #86efac;
            border-radius: 8px;
            color: #166534;
        }

        button {
            cursor: pointer;
            padding: 8px 12px;
            background: #0f172a;
            border: 0;
            border-radius: 6px;
            color: #ffffff;
            font-weight: 600;
        }

        .empty {
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <h1>Laravel Queue Monitor</h1>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Queue</th>
                    <th>Exception</th>
                    <th>Failed At</th>
                    <th>Retry</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td>{{ $job->queue ?: 'default' }}</td>
                        <td class="exception">{{ $job->exception }}</td>
                        <td>{{ $job->created_at?->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <form method="POST" action="{{ route('queue-monitor.retry', $job) }}">
                                @csrf
                                <button type="submit">Retry</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">No failed jobs have been recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
