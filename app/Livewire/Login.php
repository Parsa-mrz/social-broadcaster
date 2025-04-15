<?php

namespace App\Livewire;

use App\Helpers\SweetAlertHelper;
use App\Models\User;
use App\Services\AuthService;
use Livewire\Attributes\Title;
use Livewire\Component;
use function dd;
use function session;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    public function submit (AuthService $authService)
    {
        $result = $authService->authenticate($this->email, $this->password);

        if(!$result['status']) {
            SweetAlertHelper::error ($this,'Error',$result['message']);
            return;
        }

        $this->redirect ('dashboard');
    }
    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }
}
