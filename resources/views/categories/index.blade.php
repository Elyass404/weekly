<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Categories</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Category</a>
        <ul class="mt-4">
            @foreach ($categories as $category)
                <li class="bg-white shadow-md rounded p-4 mb-4 flex justify-between items-center">
                    <span>{{ $category->name }}</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('categories.show', $category->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
