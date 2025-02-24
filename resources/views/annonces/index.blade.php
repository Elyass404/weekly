<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Annonces</h1>
        <a href="{{ route('annonces.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Annonce</a>
        <ul class="mt-4">
            @foreach ($annonces as $annonce)
                <li class="bg-white shadow-md rounded p-4 mb-4 flex justify-between items-center">
                    <span>{{ $annonce->titre }}</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('annonces.show', $annonce->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('annonces.edit', $annonce->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this annonce?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $annonces->links() }} <!-- Pagination links -->
        </div>
    </div>
</body>
</html>
