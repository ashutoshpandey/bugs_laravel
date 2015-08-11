<?php

class BugUser extends Eloquent {

    protected $table = 'bug_users';

    protected $hidden = array();

    public function bug(){
        return $this->belongsTo('Bug', 'bug_id');
    }

    public function user(){
        return $this->belongsTo('User', 'user_id');
    }
}
