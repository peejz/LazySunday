<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo 'LazyFoot' ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('styles');

    echo $scripts_for_layout;
    ?>
</head>

<body>
<div id="header">
    <div id="headerMenu">
        <div id="topMenu">
            <div id="topMenuLogo">Lazyfoot</div>
        </div>
        <div id="bottomMenu">
            <ul id="menu">
                <li><a href="<?php echo $this->webroot; ?>Games">Jogos</a></li>
                <li><a href="<?php echo $this->webroot; ?>Players">Jogadores</a></li>
<!--                <li><a href="#">Stats</a></li>-->
            </ul>
        </div>
    </div>
</div>

<div id="outerWrapper">
    <div id="contentWrapper">
        <div id="noOverlapTop"></div>
        <div id="sidebarWrapper">
            <div id="sidebarContent">
                <h3><?php echo $this->element('sidebar');?></h3>
            </div>
        </div>
        <div id="contentInnerWrapper">
            <div id="content">
                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>
            </div>
        </div>
        <div id="noOverlap"></div>
    </div>
</div>
<div id="footerWrapper">
    <div id="footerContent">
        <div id="credits"><u>LazySunday</u> beta...<?php echo date('F'); ?> 2012</div>
    </div>
</div>
</body>
</html>
