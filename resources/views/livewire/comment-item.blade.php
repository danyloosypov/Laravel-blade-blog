<div>
    <div class="flex justify-between mb-4 gap-3" >
        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="flex-1">
            <div>
                <a href="#" class="font-semibold text-indigo-600">{{$comment->user->name}}</a>
                - {{$comment->created_at->diffForHumans()}}
            </div>
            @if ($editing)
                <livewire:comment-create :comment-model="$comment" />
            @else
                <div>
                    {{$comment->comment}}
                </div>
            @endif
            
            <div>
                <a wire:click.prevent="startReply" href="#" class="text-sm text-indigo-600">Reply</a> 
                @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                    | <a wire:click.prevent="startCommentEdit" href="" class="text-sm text-blue-600">Edit</a> |
                    <a wire:click.prevent="deleteComment" href="" class="text-sm text-red-600">Delete</a>
                @endif
            </div>
            @if ($replying)
                <livewire:comment-create :post="$comment->post" :parent-comment="$comment" />
            @endif

            @if ($comment->comments->count())
                <br>
                @foreach ($comment->comments as $childComment)
                    <livewire:comment-item :comment="$childComment" wire:key="comment-{{$childComment->id}}" />
                    <br>
                @endforeach
            @endif
            
        </div>
    </div>
</div>
