<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function getNotificationsProperty()
    {
        return Auth::check() ? Auth::user()->notifications()->latest()->take(10)->get() : collect([]);
    }

    public function markAsRead($id)
    {
        if (Auth::check()) {
            $notification = Auth::user()->notifications()->find($id);
            if ($notification) {
                $notification->markAsRead();
            }
        }
    }

    public function deleteNotification($id)
    {
        if (Auth::check()) {
            $notification = Auth::user()->notifications()->find($id);
            if ($notification) {
                $notification->delete();
            }
        }
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
