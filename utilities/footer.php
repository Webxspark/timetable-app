</div>
<!-- /.content-wrapper -->


<footer>
    <div class="container pb-7">
        <div class="d-md-flex align-items-center justify-content-between">
            <p class="mb-2 mb-lg-0">© <?php echo date('Y') . ' ' . APP_TITLE ?>. All rights reserved.</p>
            <nav class="nav social social-muted mb-0 text-md-end">
                <a href="https://twitter.com/AlanChris06" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-twitter"></i></a>
                <a href="https://soulof8d.webxspark.com/profile/facebook" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-facebook-f"></i></a>
                <a href="https://soulof8d.webxspark.com/profile/instagram" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-instagram"></i></a>
                <a href="https://soulof8d.webxspark.com/profile/youtube" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-youtube"></i></a>
            </nav>
            <!-- /.social -->
        </div>
    </div>
    <!-- /.container -->
</footer>


<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/theme.js"></script>
<script src="https://cdn.webxspark.com/plugins/js/query.min.js"></script>
<script src="./assets/js/wxp.js"></script>
<script src="./assets/js/script.js"></script>
<?php if (isset($_REQUEST['auth'])) : ?>
    <script src="./assets/js/login.js"></script>
<?php endif; ?>
<?php if (isset($INIT_SCRIPTS)) {
    if ($INIT_SCRIPTS === "new-tt") {
echo '<script src="./assets/js/new-data.js"></script>';
} elseif($INIT_SCRIPTS === 'edit-tt'){
echo '<script src="./assets/js/new-data.js"></script>';
echo '<script src="./assets/js/edit-data.js"></script>';
} elseif($INIT_SCRIPTS === "admin"){
echo '<script src="./assets/js/admin.js"></script>';
} elseif($INIT_SCRIPTS === "viewer"){
echo '<script src="./assets/js/viewer.js"></script>';
    }
} ?>
</body>

</html>