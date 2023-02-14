<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupProject;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Illuminate\Http\Request;

class ViewGroup extends Component
{
    public $group;
    public $userSearch;

    public function addUser() {
        if ($this->userSearch) {

            $user = User::where('email', $this->userSearch)->first();
            if($this->group->users->contains($user)) {
                session()->flash('user-add-error', 'Deze gebruiker is al toegevoegd aan de groep');
            } else {
                if ($user) {
                    $this->group->users()->attach($user);
                    $this->userSearch = '';
                    $this->group->users = $this->group->users()->get();
                    session()->flash('message', 'Gebruiker toegevoegd');
                } else {
                    session()->flash('user-add-error', 'Gebruiker niet gevonden');
                }
            }


        }

    }

    public function deleteUser($id) {
        $user = User::find($id);
        $this->group->users()->detach($user);
        $this->group->users = $this->group->users()->get();
        session()->flash('message', 'Gebruiker verwijderd');
    }

    public function deleteGroup($id, Request $request){


        $groupproject = GroupProject::where('group_id', $id);
        $groupproject->forcedelete();

        $groupuser = GroupUser::where('group_id', $id);
        $groupuser->delete();

        $group = Group::where('id', $id);
        $group->delete();

        $urlpart = $request->session()->get('urlpart');
        
        return redirect($urlpart);
    }

    public function render()
    {
        return view('livewire.groups.view-group');
    }

    
}
