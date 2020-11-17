<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;
    public $name;
    public $description;
    public $post_id;
    public $isOpen = 0;


    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.posts');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
   
        Post::updateOrCreate(['id' => $this->post_id], [
            'name' => $this->name,
            'description' => $this->description
        ]);
  
        session()->flash(
            'message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->name = $post->name;
        $this->description = $post->description;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->post_id = '';
    }
}
