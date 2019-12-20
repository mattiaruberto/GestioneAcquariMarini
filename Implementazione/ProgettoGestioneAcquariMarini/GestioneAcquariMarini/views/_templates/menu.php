<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Gestione Acquari Marini</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>Menu/home">Riassuntiva</a></li>
                <li><a href="<?php echo URL; ?>Menu/tankManagement">Gestione vasche</a></li>
                <?php if($_SESSION["type"] == "Admin") { echo "<li><a href=".URL."Menu/userManagement>Gestione utenti</a></li>"; } ?>
                <li><a href="<?php echo URL; ?>Menu/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>