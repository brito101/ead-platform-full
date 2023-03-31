<?php

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Str;

class AdminObserver
{
    public function creating(Admin $admin)
    {
        $admin->id = Str::uuid();
    }
}
