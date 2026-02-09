<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Ensure you import your User model

class CustomProfileComponent extends Component
{
    public $name;
    public $email;
    public $avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'avatar' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount()
    {
        // Load the current user's data
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            session()->flash('error', 'User  not authenticated.');
            return;
        }

        // Ensure the user is an instance of the User model
        if (!($user instanceof User)) {
            session()->flash('error', 'User  is not an instance of User model.');
            return;
        }

        // Set the component properties with user data
        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatar = $user->avatar; // Assuming you have an avatar field
    }

    public function updateProfile()
    {
        // Validate the input data
        $this->validate();

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            session()->flash('error', 'User  not authenticated.');
            return;
        }

        // Update user properties
        $user->name = $this->name;
        $user->email = $this->email;

        // Handle avatar upload if provided
        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Save the user data
        $user->save();

        // Flash a success message
        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.custom-profile-component');
    }
}
