<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Annonce</h1>
        <form action="{{ route('annonces.update', $annonce->id) }}" method="POST" class="bg-white shadow-md rounded p-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="titre" class="block text-gray-700">Titre:</label>
                <input type="text" id="titre" name="titre" value="{{ $annonce->titre }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description:</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $annonce->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-gray-700">Prix:</label>
                <input type="number" step="0.01" id="prix" name="prix" value="{{ $annonce->prix }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image:</label>
                <input type="text" id="image" name="image" value="{{ $annonce->image }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="categorie_id" class="block text-gray-700">Catégorie:</label>
                <input type="number" id="categorie_id" name="categorie_id" value="{{ $annonce->categorie_id }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status:</label>
                <select id="status" name="status" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="actif" {{ $annonce->status == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="brouillon" {{ $annonce->status == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="archive" {{ $annonce->status == 'archive' ? 'selected' : '' }}>Archive</option>
                </select>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
