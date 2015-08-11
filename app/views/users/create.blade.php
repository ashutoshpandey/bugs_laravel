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
    {{HTML::script(asset("/public/js/users/create.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">

        @include('includes.header')

        <form id="form-create-user" class="admin-section-form frm" onsubmit="return false">

            <div class="header">
                <div>
                    <a href="{{$root}}/list-users">View users</a> <br/>
                </div>

                <br/>
                <h1 class="form-header">Create a new user</h1>
                <br/>
            </div>

            <div class="content">

                <div class="form-row">
                    <input id="email" name="email" class="input" placeholder="Email" type="text"/>
                </div>

                <div class="form-row">
                    <input id="name" name="name" class="input" placeholder="Name" type="text"/>
                </div>

                <div class="form-row">
                    <input id="password" name="password" class="input" placeholder="Password" type="password"/>
                </div>

                <div class="form-row">
                    <input id="confirm_password" name="confirm_password" class="input" placeholder="Confirm password" type="password"/>
                </div>

                <div class="form-row">
                    <select name="user_type">
                        <option>Administrator</option>
                        <option>Guest</option>
                        <option>User</option>
                    </select>
                </div>
            </div>

            <div class="footerlogin">
                <input class="button" name="btn-create-user" value="Create" type="submit"/>

                <div class="message" style="font-weight: bold; padding-top:16px;">&nbsp;</div>
            </div>

        </form>

    </div>
</div>

@include('includes.footer')
</body>
</html>