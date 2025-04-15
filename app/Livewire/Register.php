<?php

namespace App\Livewire;

use App\Helpers\SweetAlertHelper;
use App\Services\AuthService;
use Livewire\Attributes\Title;
use Livewire\Component;
use function dd;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';

    public function submit (AuthService $authService){
       $result = $authService->register([
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name
        ]);

        if(!$result['status']) {
            SweetAlertHelper::error ($this,'Error',$result['message']);
            return;
        }
        SweetAlertHelper::success ($this,'Registered',$result['message'],route('login'));
    }
    #[Title('Register')]
    public function render()
    {
        return view('livewire.register');
    }
}
