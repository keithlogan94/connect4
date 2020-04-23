

<?php if (isset($_SESSION['user_id'])): ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/setup">Setup A Game</a></li>
        <li><a href="/membership">Membership</a></li>
        <li><a href="/how-to-play">How To Play</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav><!-- .nav-menu -->
<?php else: ?>
    <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li><a href="/setup">Connect4Friends</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/signup">Sign Up</a></li>
        </ul>
    </nav><!-- .nav-menu -->
<?php endif; ?>