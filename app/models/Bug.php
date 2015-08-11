<?php

class Bug extends Eloquent {

    protected $table = 'bugs';

    protected $hidden = array();

    public function bugFiles(){
        return $this->hasMany('BugFile');
    }

    public function user(){
        return $this->belongsTo('User', 'created_by');
    }

    public function project(){
        return $this->belongsTo('Project', 'project_id');
    }
}
