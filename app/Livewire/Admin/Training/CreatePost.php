<?php

namespace App\Livewire\Admin\Training;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreatePost extends Component
{
    #[Validate('required')]     //Se aggrego validacion
    public $title = '';

    #[Validate('required')]     //Se aggrego validacion
    public $content = '';


    public function save()
    {
        $this->validate();      //Se aggrego validacion

        Post::create(
            $this->only(['title', 'content'])
        );

        // session()->flash('status', 'Post successfully updated.');

        // return $this->redirect('/posts');

        $this->reset(['title', 'content']);

    }


    public function render()
    {
        return view('livewire.admin.training.create-post');
    }
}
