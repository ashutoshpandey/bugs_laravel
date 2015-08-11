<?php

class UserController extends BaseController {

    function __construct(){
        View::share('root', URL::to('/'));
        View::share('name', Session::get('name'));
        View::share('userType', Session::get('userType'));
    }

    function userSection(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        $runningProjects = Project::where('status', '=', 'active')->count();
        $closedProjects = Project::where('status', '=', 'closed')->count();
        $currentBugs = Bug::where('status', '=', 'active')->count();
        $fixedBugs = Bug::where('status', '=', 'fixed')->count();
        $unresolvedBugs = Bug::where('status', '=', 'unresolved')->count();

        $userBugs = BugUser::where('user_id', '=', $userId)->where('status', '=', 'active')->with('bug')->with('bug.project')->get();

        return View::make('users.user-section')
                ->with('runningProjects', $runningProjects)
                ->with('closedProjects', $closedProjects)
                ->with('currentBugs', $currentBugs)
                ->with('fixedBugs', $fixedBugs)
                ->with('unresolvedBugs', $unresolvedBugs)
                ->with('userBugs', $userBugs);
    }

    function createUser(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        return View::make('users.create');
    }

    function saveUser(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return 'not logged';

        $email = Input::get('email');

        $user = User::where('email', '=', $email)->first();

        if(isset($user)){
            echo 'Duplicate email';
        }
        else{
            $user = new User();

            $user->email = $email;
            $user->name = Input::get('name');
            $user->password = Input::get('password');
            $user->user_type = Input::get('user_type');
            $user->status = 'active';

            $user->save();

            echo 'User created successfully';
        }
    }

    function profile(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        $userId = Session::get('userId');

        if(isset($userId)){
            $user = User::find($userId);

            if(isset($user)){

                return View::make('users.profile')->with('user', $user);
            }
            else
                return Redirect::to('/');
        }
        else
            return Redirect::to('/');
    }

    function updateProfile(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return 'not logged';

        $userId = Session::get('userId');

        $user = User::find($userId);

        if(isset($user)){

            $email = Input::get('email');

            $userByEmail = User::where('email', '=', $email)->first();

            if(isset($userByEmail) && $userByEmail->id != $user->id)
                echo 'Email already taken';
            else{
                $user->id = $userId;
                $user->email = $email;
                $user->name = Input::get('name');
                $user->password = Input::get('password');
                $user->user_type = Input::get('user_type');

                $user->save();

                echo 'Profile updated successfully';
            }
        }
        else
            echo 'Invalid user';
    }

    function editUser($userId){

        if(!isset($userId))
            return Redirect::to('/');

        if(isset($userId)){
            $user = User::find($userId);

            Session::put('current_edit_user', $userId);

            if(isset($user)){

                return View::make('users.edit')->with('user', $user);
            }
            else
                return Redirect::to('/');
        }
        else
            return Redirect::to('/');
    }

    function updateUser(){

        $userId = Session::get('current_edit_user');
        if(!isset($userId))
            return 'invalid';

        $user = User::find($userId);

        if(isset($user)){

            $user->name = Input::get('name');
            $user->password = Input::get('password');
            $user->user_type = Input::get('user_type');

            $user->save();

            echo 'Profile updated successfully';
        }
        else
            echo 'Invalid user';
    }

    function listUsers(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        return View::make('users.list');
    }

    function removeUser($userId){

        if(isset($userId)) {

            $user = User::find($userId);

            if(isset($user)){
                $user->status = 'removed';

                $user->save();

                echo 'done';
            }
            else
                echo 'invalid';
        }
        else
            echo 'invalid';
    }

    /************** json methods ***************/

    function dataListUsers(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return json_encode(array('message' => 'not logged'));

        $users = User::where('status', '=', 'active')->get();

        if(isset($users))
            return json_encode(array('found' => true, 'users' => $users->toArray(), 'message' => 'logged'));
        else
            return json_encode(array('found' => true, 'message' => 'logged'));
    }
}