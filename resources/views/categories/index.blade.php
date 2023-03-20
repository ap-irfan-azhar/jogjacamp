<!DOCTYPE html>
<html>
    <head>
        <title>Categories</title>
    </head>
    <body>
        <div>
          <h1>Categories</h1>
          <button style="margin-bottom: 10px">
            <a style="text-decoration: none" href="{{ route('categories.create') }}">Create</a>
          </button>
        </div>
        <table>
          <th>Name</th>
          <th>Is Published</th>
          <th>Created At</th>
          <th>Actions</th>
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>{{ $category->is_published ? "yes" : "no" }}</td>
              <td>{{ $category->created_at }}</td>
              <td>
                <a href="{{ route('categories.show', $category->id) }}">Show</a>
                <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </table>
        {{ $categories->links() }}

        <div style="text-align: center;">
            <a href="{{ route('categories.create') }}">Create</a>
        </div>
    </body>
</html>
