<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\UpvoteDownVote as ModelsUpvoteDownVote;
use Livewire\Component;

class UpvoteDownvote extends Component
{

    public Post $post;

    public function mount(Post $post) {
        $this->post = $post;
    }

    public function render()
    {

        $upvotes = \App\Models\UpvoteDownVote::where('post_id', '=', $this->post->id)->where('is_upvote', '=', true)->count();

        $downvotes = \App\Models\UpvoteDownVote::where('post_id', '=', $this->post->id)->where('is_upvote', '=', false)->count();

        $hasUpvote = null;

        $user = request()->user();

        if($user) {
            $model = ModelsUpvoteDownVote::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

            if($model) {
                $hasUpvote = !!$model->is_upvote;
            }
        }

        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes', 'hasUpvote'));
    }

    public function vote($upvote = true) {
        $user = request()->user();
        if(!$user) {
            return $this->redirect('login');
        }

        if(!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $upvoteDownvote = \App\Models\UpvoteDownVote::where('post_id', '=', $this->post->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if(!$upvoteDownvote) {
            \App\Models\UpvoteDownVote::create([
                'is_upvote' => $upvote,
                'post_id' => $this->post->id,
                'user_id' => $user->id
            ]);
            return;
        }

        if($upvote && $upvoteDownvote->is_upvote || !$upvote && !$upvoteDownvote->is_upvote) {
            $upvoteDownvote->delete();
        } else {
            $upvoteDownvote->is_upvote = $upvote;
            $upvoteDownvote->save();
        }
    }

}
