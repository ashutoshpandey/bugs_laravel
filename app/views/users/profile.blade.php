<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/jquery.validate.min.js"))}}
    {{HTML::script(asset("/public/js/common.js"))}}
    {{HTML::script(asset("/public/js/users/profile.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">

        @include('includes.header')

        <form id="form-user-profile" class="admin-section-form frm" onsubmit="return false">

            <div class="header">
                <div>
                    <a href="{{$root}}/list-users">User list</a> <br/>
                </div>

                <br/>
                <h1 class="form-header">Update your profile</h1>
                <br/>
            </div>

            <div class="content">

                <div class="form-row">
                    <input id="email" name="email" class="input" placeholder="Email" type="text" value="{{$user->email}}"/>
                </div>

                <div class="form-row">
                    <input id="name" name="name" class="input" placeholder="Name" type="text" value="{{$user->name}}"/>
                </div>

                <div class="form-row">
                    <input id="password" name="password" class="input" placeholder="Password" type="password" value="{{$user->password}}"/>
                </div>

                <div class="form-row">
                    <input id="confirm_password" name="confirm_password" class="input" placeholder="Confirm password" type="password" value="{{$user->password}}"/>
                </div>
            </div>

            <div class="footerlogin">
                <input class="button" name="btn-update-profile" value="Update" type="submit"/>

                <div class="message" style="font-weight: bold; padding-top:16px;">&nbsp;</div>
            </div>

        </form>

    </div>
</div>

@include('includes.footer')
</body>
</html>