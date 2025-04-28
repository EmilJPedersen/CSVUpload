<!DOCTYPE html>
<html>
<head>
    <title>CSV Table Viewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Upload CSV</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" name="csv_file" class="block w-full border border-gray-300 rounded px-4 py-2" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Upload
            </button>
        </form>

        @if(count($data))
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">CSV Table</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-300 shadow-sm rounded">
                        @foreach($data as $row)
                            <tr class="even:bg-gray-50">
                                @foreach($row as $cell)
                                    <td class="border border-gray-300 px-4 py-2">{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('csv.download.pdf') }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Download as PDF
                    </a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
