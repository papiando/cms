<?php if(http_response_code() == 200) http_response_code(500); ?><!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/vendor/cubo-cms/asset/stylesheet/template.css" />
	<link rel="icon" type="image/png" href="/vendor/cubo-cms/asset/image/cubo-b192.png" />
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/solid.js" integrity="sha384-6FXzJ8R8IC4v/SKPI8oOcRrUkJU8uvFK6YJ4eDY11bJQz4lRw5/wGthflEOX8hjL" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/fontawesome.js" integrity="sha384-xl26xwG2NVtJDw2/96Lmg09++ZjrXPc89j0j7JHjLOdSwHDHPHiucUjfllW0Ywrq" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title itemprop="name headline">Error</title>
	<base itemprop="url" href="<?php echo sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']); ?>" />
	<meta charset="utf-8" />
	<meta name="application_name" content="Cubo CMS" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<meta name="creator" itemprop="creator" itemscope itemtype="https://schema.org/Organization" content="Papiando Riba Internet" />
	<meta name="generator" content="Cubo CMS by Papiando" />
	<meta name="robots" content="noindex,nofollow" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
</head>
<body class="has-fixed-nav">
	<nav id="navigation" class="fixed-top bg-primary">
		<div class="navbar navbar-expand-md navbar-dark bg-primary justify-content-between container" role="menu">
			<a class="navbar-brand m-auto m-md-0" href="/"><img class="brand-logo" src="/vendor/cubo-cms/asset/image/cubo-w192.png" /><span class="brand-name"><strong>Cubo</strong> <em>CMS</em></span></a>
		</div>
	</nav>
	<main id="main">
		<div class="container">
			<section id="main-content" role="main">
				<article itemProp="hasPart" itemScope itemType="https://schema.org/Article"><h1>Error</h1><h4 class="text-danger"><?php echo $Error->message ?? "Unknown error"; ?></h4><div itemProp="articleBody"><p><?php echo $Error->description ?? "Sorry for the inconvenience. Please be patient while this is resolved."; ?></p></div></article>
			</section>
		</div>
	</main>
	<footer id="footer" class="fixed-bottom bg-primary">
		<div class="navbar navbar-expand-md navbar-dark bg-primary justify-content-between container" role="info">
			<span class="navbar-nav navbar-text m-auto text-center">&copy; <?php echo date("Y"); ?><a class="nav-link d-inline" href="https://cubo-cms.com/"><strong>Cubo</strong> <em>CMS</em></a></span>
		</div>
	</footer>
</body>
</html>