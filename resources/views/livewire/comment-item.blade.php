<div>
    <div class="flex mb-4 gap-3" >
        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <div>
                <a href="#" class="font-semibold text-indigo-600">{{$comment->user->name}}</a>
                - {{$comment->created_at->diffForHumans()}}
            </div>
            <div>
                {{$comment->comment}}
            </div>
            <div>
                <a href="" class="text-sm text-indigo-600">Reply</a> 
                @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                    | <a href="" class="text-sm text-blue-600">Edit</a> |
                    <a wire:click.prevent="deleteComment" href="" class="text-sm text-red-600">Delete</a>
                @endif
            </div>
        </div>
    </div>
</div>
