<?php

class AuthenticationController extends BaseController {

    public function isValidUser(){
        $email = Input::get('email');
        $password = Input::get('password');

        $user = User::where('email', '=', $email)
            ->where('password','=',$password)->first();

        if(is_null($user))
            return "invalid";
        else{
            Session::put('userId', $user->id);
            Session::put('userType', $user->user_type);
            Session::put('name', $user->name);

            return "correct";
        }
    }

    public function logout(){

        Session::flush();

        Auth::logout();

        return Redirect::to('/');
    }
}