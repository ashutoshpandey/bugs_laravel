<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>
        Administrator Section
    </title>

    {{HTML::style(asset("/public/css/common.css"))}}
    {{HTML::style(asset("/public/css/theme/transdmin.css"))}}
    {{HTML::style(asset("/public/css/users/user-section.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
    {{HTML::script(asset("/public/js/common.js"))}}
    {{HTML::script(asset("/public/js/users/user-section.js"))}}

</head>
<body>
<div>

    <div id="wrapper" class="main-container">
        @include('includes.header')

        <table>
            <tr>
                <td style="width: 150px; line-height: 30px;">Running projects</td>
                <td style="width:50px">:</td>
                <td>{{$runningProjects}}</td>
            </tr>
            <tr>
                <td style="width: 150px; line-height: 30px">Closed projects</td>
                <td style="width:50px">:</td>
                <td>{{$closedProjects}}</td>
            </tr>
            <tr>
                <td style="width: 150px; line-height: 30px" colspan="3"><hr/></td>
            </tr>
            <tr>
                <td style="width: 150px; line-height: 30px">Current bugs count</td>
                <td style="width:50px">:</td>
                <td>{{$currentBugs}}</td>
            </tr>
            <tr>
                <td style="width: 150px; line-height: 30px">Fixed bugs count</td>
                <td style="width:50px">:</td>
                <td>{{$fixedBugs}}</td>
            </tr>
            <tr>
                <td style="width: 150px; line-height: 30px">Unresolved bugs</td>
                <td style="width:50px">:</td>
                <td>{{$unresolvedBugs}}</td>
            </tr>
        </table>

        <?php
            if(isset($userBugs) && count($userBugs)>0){

                echo "<br/><br/><b>Bugs you are assigned on</b><br/><br/>";

                $i = 0;
                foreach($userBugs as $userBug){
                    ++$i;

                    $project = $userBug->bug->project;

                    echo "<b>$i.</b> <u>$project->name</u> : <a href='$root/bug-detail/$userBug->bug_id'>" . $userBug->bug->title . "</a><br/><br/>";
                }
            }
        ?>
    </div>
</div>

@include('includes.footer')
</body>
</html>