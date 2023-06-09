<x-app-layout :meta-title="$post->meta_title ?: $post->title" :meta-description="$post->meta_description ?: ''">
    <!-- Post Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            @if ($post->getThumbnail() !== null)
                <a href="#" class="hover:opacity-75 flex items-center justify-center">
                    <img style="max-height: 300px;" src="{{$post->getThumbnail()}}">
                </a>
            @endif

            <div class="bg-white flex flex-col justify-start p-6">
                @foreach ($post->categories as $category)
                    <a href="{{route('by-category', $category)}}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$category->title}}</a>
                @endforeach
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
                <p href="#" class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on {{$post->published_at}} <span>Views {{$views}}</span>
                </p>
                <livewire:upvote-downvote :post="$post" />
                <br>
                <div>
                    {!! $post->body !!}
                </div>
                <br>
            </div>
        </article>

        <div class="w-full flex pt-6">
            <div class="w-1/2">
                @if ($previousPost)
                    <a href="{{route('view', $previousPost)}}" class="block w-full bg-white shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                        <p class="pt-2">{{\Illuminate\Support\Str::words($previousPost->title, 5)}}</p>
                    </a>
                @endif
            </div>
            <div class="w-1/2">
                @if ($nextPost)
                    <a href="{{route('view', $nextPost)}}" class="block w-full bg-white shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                        <p class="pt-2">{{\Illuminate\Support\Str::words($nextPost->title, 5)}}</p>
                    </a>
                @endif
            </div>
        </div>

        <livewire:comments :post="$post" />

    </section>

      


</x-app-layout>