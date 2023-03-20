<!DOCTYPE html>
<html>
    <head>
        <title>Category</title>
    </head>
    <body>
        <h1>{{ $category->name }}</h1>
        <p>Is Published: {{ $category->is_published ? "yes" : "no" }}</p>
        <p>Created At: {{ $category->created_at }}</p>
        <p>Updated At: {{ $category->updated_at }}</p>
        <div style="display: flex">
          <div style="text-align: center; margin: 10px">
              <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
          </div>
          <div style="text-align: center; margin: 10px">
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit">Delete</button>
            </form>
          </div>
          <div style="text-align: center; margin: 10px">
            <a href="{{ route('categories.index') }}">Back</a>
          </div>
        </div>
    </body>
</html>