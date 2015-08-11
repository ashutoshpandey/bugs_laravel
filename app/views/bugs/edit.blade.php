<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}
    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/projects/edit.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/jquery.validate.min.js"))}}
    {{HTML::script(asset("/public/js/projects/edit.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="ys-adminform">

        @include('includes.header')

        <form name="admin-section-form" class="admin-section-form frm">

            <div class="header">
                <div style="">
                    <img src="images/logo.png" style="" alt=""/>
                </div>
                <br/>
                <h1 class="form-header">Edit bug</h1>
            </div>

            <div class="content">
                <input name="username" class="input username" placeholder="Username" type="text"/>

                <div class="user-icon"></div>
                <input name="password" class="input password" placeholder="Password" type="password"/>

                <div class="pass-icon"></div>
            </div>

            <div class="footerlogin">
                <input class="button" name="btnlogin" value="Authenticate" type="button"/>

                <div class="msgtask" style="font-weight: bold; padding-top:16px;">&nbsp;</div>
            </div>

        </form>

    </div>
</div>

@include('includes.footer')
</body>
</html>