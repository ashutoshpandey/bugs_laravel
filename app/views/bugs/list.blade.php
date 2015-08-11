<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/jquery.dataTables.css"))}}
    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}
    {{HTML::style(asset("/public/css/bugs/list.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/jquery.dataTables.min.js"))}}
    {{HTML::script(asset("/public/js/common.js"))}}
    {{HTML::script(asset("/public/js/bugs/list.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">

        @include('includes.header')

        <div class="header">
            <div>
                <a href="{{$root}}/create-bug">Create bug</a>
            </div>
            <br/>
            <h1 class="form-header">Listing bugs</h1>

            <label><input type="radio" name="bug_type" value="active" checked="checked"/>Active </label> &nbsp;&nbsp;
            <label><input type="radio" name="bug_type" value="fixed"/>Fixed </label> &nbsp;&nbsp;
            <label><input type="radio" name="bug_type" value="unresolved"/>Unresolved </label>

            <br/><br/><br/>
        </div>

        <div id="table-data"></div>
    </div>

</div>

@include('includes.footer')
@include('includes.popup')

</body>
</html>