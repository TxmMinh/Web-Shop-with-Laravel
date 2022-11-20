@extends('admin.main')

@section('content')
    <div class="card-body" class="container mt-5">
        <br />
        <h3>{{ $title_form }}</h3>
        <br />

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Content</th>
                    <th scope="col" style="width: 100px">Active</th>
                    <th scope="col">Update</th>
                    <th scope="col" style="width: 100px">Tools</th>
                </tr>
            </thead>
            <tbody>
                {{-- Cách 1: Dùng Models --}}
                {{-- @foreach ($menus as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td><a href="/admin/menu/list/{{$row->id}}">{{$row->name}}</a></td>
                    <td>{{$row->description}}</td>
                    <td>{{$row->content}}</td>
                    <td>{{$row->active}}</td>
                    <td>{{$row->updated_at}}</td>
                    <td><a href="/admin/menu/list/edit/{{$row->id}}">Edit</a>
                        <form method="POST" action="/admin/menu/list/delete/{{$row->id}}" onsubmit="return ConfirmDelete( this )">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach --}}

                {{-- Cách 2: Dùng Helper --}}
                {!! \App\Helpers\Helper::menu($menus) !!} {{-- # !!Biên dịch html --}}

            </tbody>
        </table>
        {{-- Pagination --}}

        <div class="d-flex justify-content-center">
            {{-- {!! $menu->links() !!} --}}
            {!! $menus->appends(['sort' => 'department'])->links() !!}
        </div>
    </div>
@endsection
