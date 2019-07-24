            <?php
            // print_r($menu);
            if ($user['status'] == 1) $url = 'admin';
            else $url = 'user';
            ?>
            </div>
            <div class="container-fluid">
                <div class="text-center mt-5">
                    <div class="error mx-auto" data-text="404">
                        <p class="m-0">404</p>
                    </div>
                    <p class="text-dark mb-5 lead">Page Not Found</p>
                    <a href="<?= base_url("$url/dashboar") ?>">← Back to Dashboard</a>
                </div>
            </div>