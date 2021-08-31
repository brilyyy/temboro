@extends('base.app')

@section('app')

<!-- Posts Section -->
<section class="w-full md:w-2/3 flex flex-col items-center px-3">

    @forelse ($posts as $post)
    <article class="flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75">
            <img src="{{$post->header}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            <a href="{{route('posts.by.tag', $post->tag->slug)}}"
                class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->tag->name}}</a>
            <a href="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}"
                class="text-3xl font-bold hover:text-gray-700 pb-2">{{$post->title}}</a>
            <a href="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}" class="pb-6">{!!
                \Illuminate\Support\Str::limit($post->desc, 250, '...') !!}
            </a>
            <hr>
            <a href="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}"
                class="uppercase text-gray-800 hover:text-black mt-6">Continue Reading <i
                    class="fas fa-arrow-right"></i></a>
        </div>
    </article>
    @empty
    <div class="min-h-screen">
        <div class="flex flex-col shadow my-4 p-20">
            <h1>Belum ada postingan.</h1>
        </div>
    </div>
    @endforelse


    @if (!$posts->isEmpty())
    <!-- Pagination -->
    <div class="flex items-center py-8">
        {!! $posts->links() !!}
    </div>

    @endif
</section>




@endsection
