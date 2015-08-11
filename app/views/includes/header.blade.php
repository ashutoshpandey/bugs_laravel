{{HTML::image(asset("public/images/logo.png"))}}

<h1>Bug Tracking System</h1>

Welcome : {{$name}} <br/><br/><br/>

<!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
<ul id="mainNav">
    <li><a href="{{$root}}/user-section">DASHBOARD</a></li>
    <li><a href="{{$root}}/list-projects">PROJECTS</a></li>
    <?php if($userType=="Administrator"){ ?>
        <li><a href="{{$root}}/list-users">USERS</a></li>
    <?php } ?>
    <li><a href="{{$root}}/profile">PROFILE</a></li>
    <li class="logout"><a href="{{$root}}/logout">LOGOUT</a></li>
</ul>