<?php if(http_response_code() == 200) http_response_code(500); ?><!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
	<title itemprop="name headline">Error</title>
	<base itemprop="url" href="<?php echo sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']); ?>" />
	<meta charset="utf-8" />
	<meta name="application_name" content="Cubo CMS" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<meta name="creator" itemprop="creator" itemscope itemtype="https://schema.org/Organization" content="Papiando Riba Internet" />
	<meta name="generator" content="Cubo CMS by Papiando" />
	<meta name="robots" content="noindex,nofollow" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/vendor/cubo-cms/asset/stylesheet/theme.css" rel="stylesheet" />
	<link href="/vendor/cubo-cms/asset/stylesheet/template.css" rel="stylesheet" />
	<link href="/vendor/cubo-cms/asset/image/cubo-b192.png" rel="icon" type="image/png" />
	<script defer src="/vendor/fortawesome/font-awesome/js/solid.js"></script>
	<script defer src="/vendor/fortawesome/font-awesome/js/fontawesome.min.js"></script>
	<script src="/vendor/components/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body class="has-fixed-nav">
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-dark bg-primary fixed-top">
		<div class="container d-flex flex-nowrap">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<a class="navbar-brand" href="/"><img class="brand-logo" src="/vendor/cubo-cms/cubo-w192.png" /><span class="brand-name"><strong>Cubo</strong> <em>CMS</em></span></a>
		</div>
	</nav>
	<header id="header"></header>
	<main id="main">
		<div class="container">
			<section id="main-content" role="main">
				<article itemProp="hasPart" itemScope itemType="https://schema.org/Article"><h1>Error</h1><h4 class="text-danger"><?php echo $_error->message ?? "Unknown error"; ?></h4><div itemProp="articleBody"><p><?php echo $_error->description ?? "Sorry for the inconvenience. Please be patient while this is resolved."; ?></p></div></article>
			</section>
		</div>
	</main>
	<section id="message"></section>
	<footer id="footer" class="bg-inverse fixed-bottom"></footer>
</body>
</html>