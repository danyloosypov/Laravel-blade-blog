<x-app-layout meta-title='Crazy Blog - About Us'>

    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            @if ($widget->image !== null)
                <a href="#" class="hover:opacity-75 flex items-center justify-center">
                    <img style="max-height: 300px;" src="/storage/{{$widget->image}}">
                </a>
            @endif

            <div class="bg-white flex flex-col justify-start p-6">
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">
                    <h1>{{$widget->title}}</h1>
                </a>
                
                <div>
                    {!! $widget->content !!}
                </div>
            </div>
        </article>


    </section>
</x-app-layout>