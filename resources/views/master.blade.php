<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>score</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
		<link href="css/app.css" rel="stylesheet" />
		@routes
	</head>
	<body>
		<script>window.isUserAuthenticated = {{ json_encode($isUserAuthenticated) }};</script>

		<div id="app">
		  <score-app></score-app>
		</div>
		
		<script src="js/app.js"></script>
	</body>
</html>
