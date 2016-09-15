<?php

namespace Matrix\Matrix\Login;

use App\Http\Controllers\Controller as AppController;
use Matrix\Matrix\Login\Models\User;
use Auth;

class Controller extends AppController
{
    public function index()
    {
        $action = app('request')->input('action', 'null');

        switch ($action) {
            case 'check':
                $field = app('request')->input('field');
                $value = app('request')->input('value');

                if (!in_array($field, ['email', 'name'])) return abort(404);

                $count = User::where($field, $value)->count();
                return ['exists' => $count > 0];
                break;

            default:
                return view('index');
                break;
        }

    }

    public function store()
    {
        $email = app('request')->input('email');
        $password = app('request')->input('password');
        $remember = app('request')->input('remember', true);

        $result = Auth::attempt(['email' => $email, 'password' => $password], $remember);
        return $result ? Auth::user() : abort(404);
    }
}