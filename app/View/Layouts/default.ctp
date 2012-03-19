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
                <li><a href="<?php echo $this->webroot; ?>Players/Stats">Stats</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="outterWrapper">
    <div id="contentWrapper">
        <div id="sidebarWrapper">
            <div id="sidebarContent">
                <h3>Stats:</h3>
            </div>
        </div>
        <div id="contentInnerWrapper">
            <div id="content">
                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>
            </div>
        </div>
    </div>
</div>
<div id="footerWrapper">
    <div id="footerContent">
        <div id="credits">LazyFoot - 2012</div>
    </div>
</div>
</body>
</html>
