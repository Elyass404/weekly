<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $annonce->titre }}</h1>
        <p class="mb-4"><strong>Description:</strong> {{ $annonce->description }}</p>
        <p class="mb-4"><strong>Prix:</strong> {{ $annonce->prix ? $annonce->prix . ' USD' : 'N/A' }}</p>
        <p class="mb-4"><strong>Image:</strong> {{ $annonce->image ? $annonce->image : 'N/A' }}</p>
        <p class="mb-4"><strong>Category:</strong> {{ $annonce->category ? $annonce->category->name : 'N/A' }}</p>
        <p class="mb-4"><strong>Status:</strong> {{ ucfirst($annonce->status) }}</p>

        <!-- Display Comments -->
<h2 class="text-xl font-bold mb-4">Comments</h2>
<ul>
    @foreach ($annonce->comments as $comment)
        <li class="mb-4 p-4 bg-white shadow rounded">
            <p class="mb-2"><strong>{{ $comment->user->name }}</strong></p>
            <p>{{ $comment->content }}</p>
            <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>

            <!-- Check if the authenticated user is the owner of the comment -->
            @if (Auth::id() === $comment->user_id)
                <a href="{{ route('comments.edit', $comment->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </form>
            @endif
        </li>
    @endforeach
</ul>

        <!-- Add Comment Form -->
        <h2 class="text-xl font-bold mb-4 mt-8">Add a Comment</h2>
        <form action="{{ route('comments.store', $annonce->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Comment:</label>
                <textarea id="content" name="content" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Comment</button>
        </form>

        <a href="{{ route('annonces.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Back to Annonces</a>
    </div>
</body>
</html>
