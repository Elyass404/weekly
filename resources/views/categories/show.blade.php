<!DOCTYPE html>
<html>
<head>
    <title>Category Details</title>
</head>
<body>
    <h1>{{ $category->name }}</h1>
    <a href="{{ route('categories.index') }}">Back to Categories</a>
</body>
</html>
