<div>
    <livewire:comment-create :post="$post" />
    <br>
    <br>
    @foreach ($comments as $comment)
        <livewire:comment-item :comment="$comment" wire:key="comment-{{$comment->id}}-{{$comment->comments->count()}}" />
    @endforeach
</div>
