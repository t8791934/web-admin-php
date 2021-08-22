<?php
    require 'includes/authorize.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="js/chart-area-demo.js" defer></script>
        <script src="js/chart-bar-demo.js" defer></script>
        <script src="js/datatables-demo.js" defer></script>
        <!-- head-start -->
        <style>
            .card {
                height: 250px;
                background-color: #eee;
                background-attachment: fixed;
                background-position: center;
            }
            .card-footer {
                background-color: white;
            }

            /* body {
                background-image:url("https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_960_720.jpg");
                background-repeat:no-repeat;
                background-size: cover;
                background-attachment: fixed;
                background-position: center;
            }
            .txt {
                background-image:url("https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_960_720.jpg");
                background-size: cover;
                opacity: 0.9 ;
            }
            .cook {
                background-image:url("https://cdn.pixabay.com/photo/2014/10/22/16/38/ingredients-498199_960_720.jpg");
                background-size: cover;
                opacity: 0.9;
            }
            .user {
                background-image:url("https://cdn.pixabay.com/photo/2017/04/01/21/06/portrait-2194457_960_720.jpg ");
                background-size: cover;
                background-position: center;
                opacity: 0.5;
            }
            .make {
                background-image:url("https://cdn.pixabay.com/photo/2016/06/03/13/57/digital-marketing-1433427_960_720.jpg");
                background-size: cover;
                opacity: 0.9;
            }
            .shop {
                background-image:url("https://cdn.pixabay.com/photo/2016/01/27/22/10/shopping-1165437_960_720.jpg");
                background-size: cover;
                background-position: center;
                opacity: 0.9;
            }
            .talk {
                background-image:url("https://cdn.pixabay.com/photo/2017/07/31/11/21/people-2557396_960_720.jpg");
                background-size: cover;
                background-position: center;
                opacity: 0.9;
            } */

            .card {
                transition: transform 200ms;
            }
            .card:hover {
                box-shadow: 0px 3px 15px;
                transform: scale(1.1);
            }
        </style>
        <title>首頁 - <?= $websiteTitle ?></title>
    </head>
    <body class="sb-nav-fixed">
        <?php require 'includes/topnav.php'; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php require 'includes/sidenav.php'; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <!-- content-start -->
                    <div class="container-fluid text-center">
                        <h1 class="pt-5 pb-4">後台管理系統</h1>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                            <?php
                                $panels = [
                                    [
                                        'title' => '會員管理',
                                        'icon' => 'fas fa-user-astronaut',
                                        'color' => 'info',
                                        'url' => 'member_list.php',
                                    ],
                                    [
                                        'title' => '商品管理',
                                        'icon' => 'fas fa-carrot',
                                        'color' => 'success',
                                        'url' => 'product_list.php',
                                    ],
                                    [
                                        'title' => '訂單管理',
                                        'icon' => 'fas fa-barcode',
                                        'color' => 'primary',
                                        'url' => 'order_list.php',
                                    ],
                                    [
                                        'title' => '折價券管理',
                                        'icon' => 'fas fa-sitemap',
                                        'color' => 'danger',
                                        'url' => 'coupon_list.php',
                                    ],
                                    [
                                        'title' => '食譜管理',
                                        'icon' => 'fas fa-book-reader',
                                        'color' => 'secondary',
                                        'url' => 'recipe_list.php',
                                    ],
                                    [
                                        'title' => '食譜評論管理',
                                        'icon' => 'fas fa-comment-medical',
                                        'color' => 'warning',
                                        'url' => 'recipe_review_list.php',
                                    ],
                                ];

                                foreach ($panels as $panel):
                            ?>
                                <div class="col p-4">
                                    <div class="card rounded-lg bg-white overflow-hidden border-secondary">
                                        <div class="card-body w-100 bg-<?= $panel['color'] ?> text-white">
                                            <h5 class="mb-4"><?= $panel['title'] ?></h5>
                                            <i class="<?= $panel['icon'] ?> display-1"></i>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a class="stretched-link text-dark text-decoration-none" href="<?= $panel['url'] ?>">
                                                <i class="fas fa-sign-in-alt"></i>
                                                前往
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
