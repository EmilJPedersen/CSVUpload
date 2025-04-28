<!DOCTYPE html>
<html>
<head>
    <title>CSV PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid black; padding: 5px; }
    </style>
</head>
<body>
    <h2>CSV Table</h2>
    <table>
        @foreach($data as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
