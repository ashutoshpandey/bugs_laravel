<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/jquery.dataTables.css"))}}
    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}
    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/bugs/detail.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/jquery.dataTables.min.js"))}}
    {{HTML::script(asset("/public/js/common.js"))}}
    {{HTML::script(asset("/public/js/bugs/detail.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">

        @include('includes.header')

        <div class="header">
            <div class="form-row">
                <a href="{{$root}}/list-bugs/{{$project->id}}">Back</a>
                <br/>
            </div>
            <br/>

            <div class="form-row">
                Project: <b>{{$project->name}}</b><br/>
            </div>

            <div class="form-row">
                Posted by : <span style="color:#478bff; font-weight: 700">{{$bug->user->name}}</span> on <b>( {{date('d-M-Y h:i A', strtotime($bug->created_at))}} )</b>
            </div>
            <div class="form-row">
                Level : <span class="{{strtolower($bug->severity)}}">{{$bug->severity}}</span>
            </div>
            <br/>
            <div class="form-row">
                <strong>{{$bug->title}}</strong>
            </div>
            <br/>
            <div class="form-row">
                {{$bug->description}}
            </div>
            <br/>
            <?php
                if(isset($bugFiles) && count($bugFiles)>0){

                    $image_types= array('jpeg','jpg','gif','png', 'pdf', 'doc', 'docx');

                    foreach($bugFiles as $bugFile){

                        $extension = pathinfo($bugFile->file_name, PATHINFO_EXTENSION);

                        echo "<div class='form-row'>";

                        if(in_array($extension, $image_types))
                            echo "<a href='$root/public/uploads/$bugFile->saved_file_name' target='_blank'><img class='bug-image' src='$root/public/uploads/$bugFile->saved_file_name'/></a>";
                        else
                            echo "<a href='$root/download-bug/$bug->id'>$bugFile->file_name</a>";

                        echo "</div>";
                    }
                }
            ?>

            <br/>
            <div class="form-row">
                <form action="{{$root}}/save-bug-comment" id="form-comment" method="post" target="ifr" enctype="multipart/form-data" onsubmit="return checkComment()">
                    <textarea name="comment" rows="5" cols="40" placeholder="Add your comment"></textarea>

                    <br/><br/>

                    <div class="form-row"><span class="add-file">Add attachment</span></div>

                    <br/>

                    <div class="form-row file-container"></div>
                    <br/>

                    <input type="submit" name="btn-add-comment" value="Add comment"/>
                </form>
                <iframe id="ifr" name="ifr" style="width:1px;height:1px;visibility: hidden"></iframe>
            </div>

            <div class="form-row bug-comments"></div>

        </div>

        <div id="bug-comments"></div>
    </div>

</div>

@include('includes.footer')

</body>
</html>