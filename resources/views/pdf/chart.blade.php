<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Study Chart</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Study Chart for {{ $username }}</h1>
    <p>Date Generated: {{ now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Time Spent</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->subject }}</td>
                    <td>{{ $session->duration }} mins</td>
                    <td>{{ $session->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
