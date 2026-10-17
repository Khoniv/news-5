<?php

namespace App\Livewire\Articels;

use Livewire\Component;
use App\Models\Article;
use App\Models\Comment as ModelsComment;
use Illuminate\Support\Facades\Auth;

class Comment extends Component
{
    public $body, $body2, $article;
    public $comment_id, $edit_comment_id;

    public function mount($id)
    {
        $this->article = Article::find($id);
    }
    public function render()
    {
        return view('livewire.articels.comment',[
            'comments' => ModelsComment::with('user', 'childrens')
                ->where('article_id', $this->article->id)
                ->whereNull('comment_id')->get(),
            'total_comments' => ModelsComment::where('article_id', $this->article->id)->count()
        ]);
    }
    public $name;

    public function store()
    {
        $this->validate(['body' => 'required']);
        $userId = Auth::check() ? Auth::id() : 1;
        $comment = ModelsComment::create([
            'user_id' => $userId,
            'article_id' => $this->article->id,
            'body' => $this->body
        ]);
        if ($comment) {
            session()->flash('success', 'Comment successfully posted!');
            return redirect(url('p/' . $this->article->slug));
        } else {
            session()->flash('danger', 'Failed to post comment.');
            return redirect(url('p/' . $this->article->slug));
        }
    }
    public function selectReply($id)
    {
        $this->comment_id = $id;
        $this->edit_comment_id = NULL;
        $this->body2 = NULL;
    }

    public function reply()
    {
        $this->validate(['body2' => 'required']);
        $comment = ModelsComment::find($this->comment_id);
        $comment = ModelsComment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $this->article->id,
            'body' => $this->body2,
            'comment_id' => $comment->comment_id ? $comment->comment_id : $comment->id
        ]);
        if ($comment) {
            $this->body2 = NULL;
            $this->comment_id = NULL;
        } else {
            session()->flash('danger', 'comment failed to create');
            return redirect(url('p/' . $this->article->slug));
        }
    }
    public function selectEdit($id)
    {
        $comment = ModelsComment::find($id);
        $this->edit_comment_id = $comment->id;
        $this->body2 = $comment->body;
        $this->comment_id = NULL;
    }

    public function change()
    {
        $this->validate(['body2' => 'required']);
        $comment = ModelsComment::where('id', $this->edit_comment_id)->update([
            'body' => $this->body2
        ]);
        if ($comment) {
            $this->body = NULL;
            $this->edit_comment_id = NULL;
        } else {
            session()->flash('danger', 'comment failed to update');
            return redirect(url('p/' . $this->article->slug));
        }
    }
    public function delete($id)
    {
        $comment = ModelsComment::where('id', $id)->delete();
        if ($comment) {
            return NULL;
        } else {
            session()->flash('danger', 'comment failed to delete');
            return redirect(url('p/' . $this->article->slug));
        }
    }
}
