<?php

class BugComment extends Eloquent {

	protected $table = 'bug_comments';

	protected $hidden = array();

    public function user(){
        return $this->belongsTo('User', 'created_by');
    }

    public function bugCommentFiles(){
        return $this->hasMany('BugCommentFile');
    }
}
