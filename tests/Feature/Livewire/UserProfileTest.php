<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(UserProfile::class)
            ->assertStatus(200);
    }
}
