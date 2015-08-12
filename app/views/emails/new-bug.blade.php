<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>New Bug Found</h2>

		<div>
			Hi {{$username}}, <br/><br/>
			There is a new bug posted on {{$portal}}
			<hr/>
				Project: {{$project}} <br/><br/>
				Title: {{$bugTitle}} <br/><br/>
				{{$description}}
			<hr/>
		</div>
	</body>
</html>
