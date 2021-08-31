@extends('dashboard.base.app')

@section('content')
<h1 class="mt-4">Create Post</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Post</li>
</ol>
<form action="{{route('create.post.service')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label fw-bold">Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="title" autocomplete="off">
    </div>
    <div class="mb-3">
        <label for="selectCat" class="form-label fw-bold">Category</label>
        <select id="selectCat" class="form-select mb-3" aria-label="Default select example" name="tag_id">
            <option selected>Category</option>
            @foreach ($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label fw-bold">Header</label>
        <input class="form-control" type="file" id="formFile" name="header">
    </div>
    <div class="mb-3">
        <label for="editor" class="form-label fw-bold">Content</label>
        <textarea class="form-control editor" name="desc"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>

@endsection

@section('ck-editor')
<script src="{{asset('assets/cke/ckeditor.js')}}"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '.editor' ), {
    toolbar: {
    items: [
    'heading',
    '|',
    'alignment',
    'bold',
    'italic',
    'link',
    'bulletedList',
    'numberedList',
    '|',
    'outdent',
    'indent',
    '|',
    'imageUpload',
    'blockQuote',
    'insertTable',
    'mediaEmbed',
    'undo',
    'redo'
    ]
    },
    language: 'en',
    image: {
    toolbar: [
    'imageTextAlternative',
    'imageStyle:inline',
    'imageStyle:block',
    'imageStyle:side'
    ]
    },
    table: {
    contentToolbar: [
    'tableColumn',
    'tableRow',
    'mergeTableCells'
    ]
    },
    licenseKey: '',



    } )
    .then( editor => {
    window.editor = editor;




    } )
    .catch( error => {
    console.error( 'Oops, something went wrong!' );
    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
    console.warn( 'Build id: tjg8bkmu0wpv-msj5c6xctevs' );
    console.error( error );
    } );
</script>
@endsection
