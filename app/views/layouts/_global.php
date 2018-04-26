<?php
/**
 * @var $this FrontendController
 */
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=1140">
<link rel="shortcut icon" href="/dist/img/icons/favicon.ico">
<meta name="theme-color" content="#ffffff">
<base href="" />
<title><?= $this->title; ?></title>

<!-- Open Graph -->
<meta property="og:type" content="article">
<meta property="og:title" content="<?= htmlspecialchars($this->metaTitle) ?>"/>
<meta property="og:description" content="<?= htmlspecialchars($this->metaDescription) ?>"/>
<meta property="og:image" content="<?= $this->metaImage ?>"/>
<meta property="og:url" content="<?= $this->metaUrl ?>"/>

<meta name="title" content="<?= htmlspecialchars($this->metaTitle) ?>"/>
<meta name="description" content="<?= htmlspecialchars($this->metaDescription) ?>"/>
<meta name="keywords" content="<?= htmlspecialchars($this->metaKeywords) ?>"/>

<link rel="image_src" href="<?= $this->metaImage ?>"/> <!-- Для ВКонтакте-->
<link rel="stylesheet" href="/dist/css/style.css?index=<?= param('resetSuffix'); ?>">

