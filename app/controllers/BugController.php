<?php

class BugController extends BaseController {

    function __construct(){
        View::share('root', URL::to('/'));
        View::share('name', Session::get('name'));
        View::share('userType', Session::get('userType'));
    }

    function createBug(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        $projectId = Session::get('currentProject');

        $users = User::all();

        if(isset($projectId))
            return View::make('bugs.create')->with('projectId', $projectId)->with('users', $users);
        else
            return Redirect::to('/');
    }

    function saveBug(){

        $userId = Session::get('userId');
        if(!isset($userId)){
            return "not logged";
        }

        $bug = new Bug();

        $bug->title = Input::get('title');
        $bug->description = Input::get('description');
        $bug->severity = Input::get('severity');
        $bug->created_by = Session::get('userId');
        $bug->project_id = Session::get('currentProject');
        $bug->status = 'active';

        $bug->save();

        $files = Input::file('file');
        if(isset($files))
            $fileCount = count($files);
        else
            $fileCount = 0;

        $users = Input::get('users');

        if(isset($users))
            $userCount = count($users);
        else
            $userCount = 0;

        if($fileCount>0){
            foreach($files as $file) {
                $destinationPath = 'public/uploads';

                $savedFileName = date('Ymdhis');

                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $savedFileName);

                $bugFile = new BugFile();

                $bugFile->bug_id = $bug->id;
                $bugFile->file_name = $filename;
                $bugFile->saved_file_name = $savedFileName;
                $bugFile->status = 'active';

                $bugFile->save();
            }
        }

        if($userCount>0){

            foreach($users as $userId){
                $bugUser = new BugUser();

                $bugUser->bug_id = $bug->id;
                $bugUser->user_id = $userId;
                $bugUser->status = 'active';

                $bugUser->save();

                $user = User::find($userId);
                $project = Project::find($bug->project_id);

                if(isset($user))
                    $this->sendNewBugEmail($user->name, $user->email, $project->name, $bug->title, $bug->description, null);
            }
        }

        echo 'done';
    }

    function editBug($id){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        $bug = Bug::find($id);

        return View::make('bugs.edit')->with('bug', $bug);
    }

    function updateBug(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return "not logged";

        $id = Input::get('id');

        $bug = Bug::find($id);

        if($bug){

            $title = Input::get('title');
            $description = Input::get('description');
            $status = Input::get('status');

            if(isset($title))
                $bug->title = Input::get('title');

            if(isset($description))
                $bug->description = Input::get('description');

            if(isset($status))
                $bug->status = Input::get('status');

            $bug->save();

            echo 'done';
        }
        else
            echo 'invalid';
    }

    function changeBugStatus(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return "not logged";

        $id = Input::get('id');

        $bug = Bug::find($id);

        if($bug){

            $status = Input::get('status');

            if(isset($status)) {
                $bug->status = Input::get('status');
                $bug->save();

                BugUser::where('bug_id', '=', $bug->id) ->update(['status' => $bug->status]);

                echo 'done';
            }
            else
                echo 'invalid';
        }
        else
            echo 'invalid';
    }

    function listBugs($projectId){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        if(isset($projectId)){

            Session::put('currentProject', $projectId);

            return View::make('bugs.list');
        }
        else
            return Redirect::to('/');
    }

    function saveBugComment(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return "not logged";

        $bugComment = new BugComment();

        $bugComment->comment= Input::get('comment');
        $bugComment->created_by = Session::get('userId');
        $bugComment->bug_id = Session::get('currentBugId');
        $bugComment->status = 'active';

        $bugComment->save();

        $files = Input::file('file');
        $fileCount = count($files);

        if($fileCount>0){
            foreach($files as $file) {
                $destinationPath = 'public/uploads';

                $savedFileName = date('Ymdhis');

                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $savedFileName);

                $bugCommentFile = new BugCommentFile();

                $bugCommentFile->bug_comment_id = $bugComment->id;
                $bugCommentFile->file_name = $filename;
                $bugCommentFile->saved_file_name = $savedFileName;
                $bugCommentFile->status = 'active';

                $bugCommentFile->save();
            }
        }

        echo 'done';
    }

    function bugDetail($bugId){

        $userId = Session::get('userId');
        if(!isset($userId))
            return Redirect::to('/');

        if(isset($bugId)){

            $bug = Bug::find($bugId);
            $project = Project::find($bug->project_id);

            if(isset($bug) && isset($project)){
                Session::put('currentBugId', $bugId);

                $bugFiles = BugFile::where('bug_id', '=', $bugId)->get();

                return View::make('bugs.detail')
                    ->with('project', $project)
                    ->with('bug', $bug)
                    ->with('bugFiles', $bugFiles);
            }
            else
                return Redirect::to('/');
        }
        else
            return Redirect::to('/');
    }

    public function downloadBug($bugId){

        if(isset($bugId)){

            $bug = Bug::find($bugId);

            if(isset($bug)){

                $bugFiles = BugFile::where('bug_id', '=', $bugId)->get();

                if(isset($bugFiles)){

                    foreach($bugFiles as $bugFile){

                    }
                }
            }
        }
    }

    /****************** json methods ***********************/

    function dataListBugs(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return json_encode(array('message' => 'not logged'));

        $projectId = Session::get('currentProject');

        $bugType = Input::get('bug_type');

        if(isset($projectId)){
            $bugs = Bug::where('project_id', '=', $projectId)->where('status','=',$bugType)->get();

            if($bugs && count($bugs)>0)
                return json_encode(array('found' => true, 'bugs' => $bugs->toArray(), 'message' => 'logged'));
            else
                return json_encode(array('found' => false, 'message' => 'logged'));
        }
        else
            return json_encode(array('found' => false, 'message' => 'logged'));
    }

    function dataListBugComments(){

        $userId = Session::get('userId');
        if(!isset($userId))
            return json_encode(array('message' => 'not logged'));

        $bugId = Session::get('currentBugId');

        if(isset($bugId)){
            $comments = BugComment::with(array('User', 'BugCommentFiles'))->where('bug_id', '=', $bugId)->get();

            if($comments && count($comments)>0)
                return json_encode(array('found' => true, 'comments' => $comments->toArray(), 'message' => 'logged'));
            else
                return json_encode(array('found' => false, 'message' => 'logged'));
        }
        else
            return json_encode(array('found' => false, 'message' => 'logged'));
    }

    public function sendNewBugEmail($username, $email, $project, $bugTitle, $description, $attachments){
        $portal = "BUGS@YOGASMOGA";

        $data['project'] = $project;
        $data['description'] = $description;
        $data['username'] = $username;
        $data['portal'] = $portal;
        $data['bugTitle'] = $bugTitle;

        $result = Mail::send('emails.new-bug', $data, function($message) use ($email, $attachments) {
            $message->to($email);
            $message->subject('New bug added at yogasmoga');
            $message->from('info@yogasmoga.com');
        });

//            if(isset($attachments) && count($attachments)>0) {
//
//                foreach($attachments as $attachment) {
//
//                    $mime = 'application/pdf';
//                    $as = 'pdf-report.zip';
//
//                    $message->attach($attachment,
//                                    array(
//                                        'as' => $as,
//                                        'mime' => $mime
//                                    )
//                            );
//                }
//            }
//        });
//
    }
}