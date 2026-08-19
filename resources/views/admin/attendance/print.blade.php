<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 20px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body onload="window.print()">
    <h1>Attendance Report</h1>
    <div>{{ $dateFrom }} &mdash; {{ $dateTo }}</div>

    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Building</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ $attendance->location }}</td>
                    <td>{{ $attendance->check_in?->format('Y-m-d') }}</td>
                    <td>{{ $attendance->check_in?->format('h:i A') }}</td>
                    <td>{{ $attendance->check_out ? $attendance->check_out->format('h:i A') : 'En progreso' }}</td>
                    <td>{{ $attendance->check_out ? number_format($attendance->check_in->diffInMinutes($attendance->check_out) / 60, 2) : '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
