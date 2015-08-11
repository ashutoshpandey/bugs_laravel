<?php

class BugCommentFile extends Eloquent {

    protected $table = 'bug_comment_files';

    protected $hidden = array();

    public function bugComment(){
        return $this->belongsTo('BugComment', 'bug_comment_id');
    }
}
