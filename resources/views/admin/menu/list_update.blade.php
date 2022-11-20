@extends('admin.main')

@section('content')
    <div class="card-body">
        <h1>{{ $pageName }}</h1>
        <form method="post" action="/admin/menu/update/{{ $menu->id }}">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <input type="hidden" name="id" value="{{ $menu->id }}">
            <p>
                <label for="name">Name</label><br>
                <input type="text" name="name" value="{{ $menu->name }}">
            </p>

            <p>
                <label for="parent_id">Parent_id</label><br>
                <input type="text" name="parent_id" value="{{ $menu->parent_id }}">
            </p>

            <p>
                <label for="description">Description</label><br>
                <textarea cols="50" rows="5" name="description">{{ $menu->description }}</textarea>
            </p>

            <p>
                <label for="content">Content</label><br>
                <textarea cols="50" rows="5" name="content">{{ $menu->content }}</textarea>
            </p>

            <p>
                <label for="active">Active</label><br>
                <input type="text" name="active" value="{{ $menu->active }}">
            </p>

            <p>
                <button type="submit">Submit</button>
            </p>
        </form>
    </div>
@endsection