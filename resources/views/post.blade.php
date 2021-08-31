@extends('base.app')

@section('meta-fb')
@isset($post)
<meta property="og:url" content="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$post->title}}" />
<meta property="og:description" content="Website Desa Temboro, Wonogiri" />
<meta property="og:image" content="{{$post->header}}" />
@endisset
@endsection
@section('app')
<section class="w-full md:w-2/3 flex flex-col items-center px-3">
    @isset($post)
    <article class="flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75">
            <img src="{{$post->header}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            <a href="{{route('posts.by.tag', $post->tag->slug)}}"
                class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->tag->name}}</a>
            <a href="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}"
                class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
            {!! $post->desc !!}
        </div>
    </article>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your share button code -->
    <div class="fb-share-button"
        data-href="{{route('post.show', ['slug' => $post->tag->slug, 'postSlug' => $post->slug])}}"
        data-layout="button_count">
    </div>
    @endisset

    <div class="w-full flex pt-6">
        @if (!empty($prev))
        <a href="{{route('post.show', ['slug' => $prev->tag->slug, 'postSlug' => $prev->slug])}}"
            class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
            <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                Previous
            </p>
            <p class="pt-2">{{$prev->title}}</p>
        </a>
        @endif
        @if (!empty($next))
        <a href="{{route('post.show', ['slug' => $next->tag->slug, 'postSlug' => $next->slug])}}"
            class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
            <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                    class="fas fa-arrow-right pl-1"></i></p>
            <p class="pt-2">{{$next->title}}</p>
        </a>
        @endif
    </div>


</section>



@endsection
