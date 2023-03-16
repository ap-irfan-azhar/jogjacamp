<!DOCTYPE html>
<html>
    <head>
        <title>Create Category</title>
    </head>
    <body>
        <h1>Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <input 
                type="text" 
                name="name"
                value="{{ old('name') }}" 
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
                {{ old('is_published') ? 'checked' : '' }}
            >
            <label for="is_published">Is Published</label>
            @error('is_published')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <br> <br>

            <button type="submit">Create</button>
            
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

{{-- add css for alert and alert-danger class --}}
<style>
    .alert {
        color: white;
        font-size: 12px
    }

    .alert-danger {
        color: red;
    }
</style>