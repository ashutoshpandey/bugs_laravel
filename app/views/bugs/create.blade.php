<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}
    {{HTML::style(asset("/public/css/bugs/create.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/jquery.validate.min.js"))}}
    {{HTML::script(asset("/public/js/common.js"))}}
    {{HTML::script(asset("/public/js/bugs/create.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">

        @include('includes.header')

        <form id="form-bug" method="post" action="{{$root}}/save-bug" target="ifr" name="ifr" enctype="multipart/form-data">

            <div class="header">
                <div>
                    <a href="{{$root}}/list-bugs/{{$projectId}}">View bugs</a> <br/>
                </div>

                <br/>
                <h1 class="form-header">Create bug</h1>
            </div>

            <div class="content">
                <div class="form-label">Title</div>
                <div class="form-row">
                    <input name="title" class="input" type="text"/>
                </div>

                <div class="form-label">Description</div>
                <div class="form-row">
                    <textarea name="description" class="input" rows="5"></textarea>
                </div>

                <div class="form-label">Bug Severity</div>
                <div class="form-row">
                    <select name="severity">
                        <option>Blocker</option>
                        <option>Critical</option>
                        <option>Major</option>
                        <option>Minor</option>
                        <option>Warning</option>
                    </select>
                </div>

                <?php if(isset($users) && count($users)>0){?>
                <div class="form-label">Assign to</div>
                <div class="form-row">
                    <select name="users[]" multiple="multiple" style="min-height: 50px; max-width: 300px">
                        <?php
                            foreach($users as $user){
                                echo "<option value='" . $user->id . "'>" . $user->name . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <?php } ?>

                <br/>

                <div class="form-row"><span class="add-file">Add attachment</span></div>

                <br/>

                <div class="form-row file-container"></div>
            </div>

            <div class="footerlogin">
                <input class="button" name="btn-create-bug" value="Create" type="submit"/>

                <div class="message" style="font-weight: bold; padding-top:16px;">&nbsp;</div>
            </div>

        </form>
        <iframe id="ifr" name="ifr" style="width:1px;height:1px;visibility: hidden"></iframe>

    </div>
</div>

@include('includes.footer')
</body>
</html>