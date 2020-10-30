<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo hc(Core::$META['title']); ?></title>
	<meta name="description" content="<?php echo hc(Core::$META['description']); ?>">
	<meta name="keywords" content="<?php echo hc(Core::$META['keywords']); ?>">
	<link href="/css/normalize.css" rel="stylesheet" type="text/css">
	<link href="/css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/js/test.js"></script>
	<?php if (count(Core::$CSS)) { echo implode("\n", Core::$CSS); }?>
	<?php if (count(Core::$JS)) { echo implode("\n", Core::$JS); }?>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/img/favicon.png" rel="shortcut icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php echo @$content; ?>

</body>
</html>