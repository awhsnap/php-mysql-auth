<!-- navbar.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Your Exchange Name</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Another link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">One more link</a>
            </li>
            <li class="nav-item">
                <span class="navbar-text">
                    <?php if (isset($liquidityPoolValue)) : ?>
                        Liquidity Pool Value: <?php echo $liquidityPoolValue; ?>
                    <?php endif; ?>
                </span>
            </li>
        </ul>
    </div>
</nav>
