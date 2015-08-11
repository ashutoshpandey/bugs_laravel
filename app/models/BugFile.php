<?php

class BugFile extends Eloquent {

    protected $table = 'bug_files';

    protected $hidden = array();

    public function bug(){
        return $this->belongsTo('Bug', 'bug_id');
    }
}
