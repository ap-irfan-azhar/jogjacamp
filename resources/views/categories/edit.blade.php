<!DOCTYPE html>
<html>
    <head>
        <title>Category</title>
    </head>
    <body>
      <h1>Edit Category</h1>
       <form action="{{ route('categories.update', $category->id) }}" method="PUT">
            @csrf
            @method('PUT')
            <input 
                type="text" 
                name="name"
                value="{{ old('name', $category->name) }}" 
                placeholder="Category Name"
            >
            {{-- show error if validation fail --}}
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input 
                type="checkbox" 
                name="is_published"
                value="true"
                {{ old('is_published', $category->is_published) ? 'checked' : '' }}
            >
            <label for="is_published">Is Published</label>
            @error('is_published')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <br> <br>

            <button type="submit">Update</button>
            
            <div style="text-align: center;">
                <a href="{{ route('categories.index') }}">Back</a>
            </div>
            
            <div style="text-align: center;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </form>
    </body>
</html>