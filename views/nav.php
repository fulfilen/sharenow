

<nav class="navbar navbar-expand-lg navbar-light navbar-bg-light">
    <a class="navbar-brand" href="<?= ROOT_URI; ?>"><img src="" width="30" height="30" alt="">
        <span class="d-none d-md-inline-block"><?= APP_TITLE; ?></span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            
        </ul>
        <ul class="navbar-nav ml-auto">         
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URI; ?>/latest"> Latest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URI; ?>/popular"> Polular</a>
            </li>
            <?php if (userIsLoggedIn()): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT_URI; ?>/logout"> Logout</a>
            </li>
            <button class="btn btn-primary" data-toggle="modal" data-target="#fileUploadModal"> Upload File</button>
            <?php  endif; ?> 
        </ul>
    </div>
</nav>