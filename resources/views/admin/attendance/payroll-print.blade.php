<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payroll Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 20px; }
        h1 { font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body onload="window.print()">
    <h1>Payroll Report</h1>
    <div>{{ $dateFrom }} &mdash; {{ $dateTo }}</div>

    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Period</th>
                <th>Hours</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row['employee']->name }}</td>
                    <td>{{ $row['employee']->salary_period ?? '—' }}</td>
                    <td>{{ $row['hours'] }}</td>
                    <td>${{ number_format($row['amount'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right">Total</td>
                <td>${{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
