<?php

namespace App\Livewire\Invitation;

use App\Models\Invitation;
use App\Models\Section;
use Livewire\Component;

class CustomerInvite extends Component
{
    public $invitation;
    public $section;
    public $section1, $section2, $section3, $section4;

    // public function mount(Section $section)
    // {
    //     $this->section = $section;
    // }

    public function mount(Invitation $invitation)
    {
        $this->section = $invitation->sections->first();

        //dd($this->section->parts);

        //$this->invitation = $invitation;
        $this->section1 = $invitation->sections[0];
        $this->section2 = $invitation->sections[1];
        $this->section3 = $invitation->sections[2];
        $this->section4 = $invitation->sections[3];
    }

    public function render()
    {
        return view('livewire.invitation.customer-invite');
    }
}
