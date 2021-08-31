@extends('dashboard.base.app')

@section('content')
<h1 class="mt-4">All Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Post</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Posts
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Header</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        {{$post->number}}
                    </td>
                    <td>
                        <img src="{{asset($post->header)}}" alt="header" width="150">
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        {{$post->tag->name}}
                    </td>
                    <td>
                        actions
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
