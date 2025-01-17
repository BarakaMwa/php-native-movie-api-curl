<?php
$page_category = "";
const KEY = "d0f5f2e135336200362af8a1a73acb17";
const HTTPS_API_THEMOVIEDB_ORG_3_TV = "https://api.themoviedb.org/3/tv/";
const HTTPS_API_THEMOVIEDB_ORG_3_SEARCH_TV = "https://api.themoviedb.org/3/search/tv";
$response = null;
$api_key = KEY;
$url = HTTPS_API_THEMOVIEDB_ORG_3_TV;
$page = "&page=1";
$category = "popular";
$language = "en-US";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $api_key = "api_key=" . $api_key;
    $category = $category . "?";
    $language = "&language=" . $language;

    if (isset($_GET["language"]) && !empty($_GET["language"])) {
        $language = $_GET["language"];
        $language = "&language=" . $language;
    }

    if (isset($_GET["category"]) && !empty($_GET["category"])) {
        $category = $_GET["category"];
        $category = $category . "?";
    }

    if ($_GET["api_key"] == KEY) {
        $api_key = "api_key=" . $api_key;
    }

    $url = $url . $category . $api_key . $language . $page;

    $response = file_get_contents($url);
}

$json = str_replace('},

]', "}

]", $response);
$data = json_decode($json, TRUE);
(int)$totalPages = $data["total_pages"];
(int)$totalResults = $data["total_results"];
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Site made with FilmPedia Website Builder v4.6.6, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="FilmPedia v4.6.6, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mbr-122x122.png" type="image/x-icon">
    <meta name="description" content="">
    <title>Movie List</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">

    <link rel="stylesheet" href="assets/theme/css/sidebar-style.css">
    <link rel="stylesheet" href="assets/uikit-2.27.5/css/uikit.min.css">
    <link rel="stylesheet" href="assets/sweetalert/css/sweetalert.css">
    <link rel="stylesheet" href="assets/theme/css/searchbar-style.css">

</head>
<body>
<section class="wrapper">
    <!-- Sidebar Holder -->
    <?php include("sidebar.php"); ?>

    <section class="content">
        <section class="menu cid-theWZsoV5t" once="menu" id="menu2-m">
            <?php include("navbar.php"); ?>
        </section>

        <section class="features8 cid-thf7YdOhH6 mbr-parallax-background" id="features8-r">
            <div class="mbr-overlay" style="opacity: 0.9; background-color: #0f7699;">
            </div>
            <section class="mbr-section content5 cid-thfgDN1QB1" id="content5-w">
                <div class="container-fluid">
                    <div class="row pl-5 pr-4">
                        <div class="title col-12 col-md-12 bottom-line">
                            <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-5">Movie List</h2>
                        </div>
                        <input type="search" class="form-control-sm mt-3" name="search"
                               oninput="searchQuery(this.value)" id="search"
                               placeholder="Search......">
                    </div>
                    <div class="row pl-5 pr-4 mt-4">
                        <div id="page-selection">Page
                            <span id="page-number-alert" class="badge badge-light">1</span>/
                            <span class="badge badge-light" id="total-pages-alert"><?php
                                if (isset($totalPages) && !empty($totalPages)) {
                                    echo $totalPages;
                                } else {
                                    echo 1;
                                }
                                ?></span>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container-fluid">
                <div class="row" id="response-content">
                    <?php

                    if ($category == "latest?") {
                        $value = $data;
                        ?>
                        <div class="card col-md-3 col-lg-2 col-xl-2  col-sm-4 col-xs-6 align-center">
                            <div class="card-img">
                                <img class="img-thumbnail rounded"
                                     src="https://image.tmdb.org/t/p/w500<?php echo $value["poster_path"]; ?>"
                                     alt="Poster">
                            </div>
                            <div class="card-box align-center">
                                <h4 class="card-title mbr-fonts-style display-7">
                                    <?php echo $value["original_name"] ?>
                                </h4>
                                <div class="mbr-section-btn align-center text-sm-center text-center btn-bottom">
                                    <a href="tv_show_view.php?tv_show_id=<?php echo $value["id"]; ?>" class="btn btn-secondary btn-xs display-4 text-sm-center">View</a>
                                </div>
                            </div>
                        </div>
                    <? } else {
                        $results = $data["results"];
                        foreach ($results as $value) {
                            ?>
                            <div class="card col-md-3 col-lg-2 col-xl-2  col-sm-4 col-xs-6 align-center">
                                <div class="card-img">
                                    <img class="img-thumbnail rounded"
                                         src="https://image.tmdb.org/t/p/w500<?php echo $value["poster_path"]; ?>"
                                         alt="Poster">
                                </div>
                                <div class="card-box align-center">
                                    <h4 class="card-title mbr-fonts-style display-7">
                                        <?php echo $value["original_name"] ?>
                                    </h4>
                                    <div class="mbr-section-btn align-center text-sm-center text-center btn-bottom">
                                        <a href="tv_show_view.php?tv_show_id=<?php echo $value["id"]; ?>" class="btn btn-secondary btn-xs display-4 text-sm-center">View</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>

                </div>
            </div>

        </section>

        <section once="" class="cid-thfg01DqU1" id="footer6-u">
            <div class="container">
                <div class="media-container-row align-center mbr-white">
                    <div class="col-12">
                        <p class="mbr-text mb-0 mbr-fonts-style display-7">
                            © Copyright 2022 FilmPedia - All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </section>


</section>


<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<script src="assets/theme/js/sidebar-script.js"></script>
<script src="assets/pagination/jquery.bootpag.min.js"></script>
<script src="assets/sweetalert/js/sweetalert.min.js"></script>

<script>

    function searchQuery(value) {
        let num = 1;
        let query = value;
        let urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_TV . $category . $api_key;?>&page=" + num;
        if (query.length > 4) {
            urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_SEARCH_TV . "?" . $api_key?>&page=" + num + "&query=" + query;
        }
        ajaxCallFunction(urlLink, num);
    }

    let paging = $('#page-selection').bootpag({
        total: <?php echo $totalPages; ?>,
        page: 1,
        maxVisible: 10,
    });

    function populateMovies(movies) {
        $("#response-content").html("");
        for (let x in movies) {
            let data = movies[x];
            $("#response-content").append(
                '<div class="card col-md-3 col-lg-2 col-xl-2  col-sm-4 col-xs-6 align-center">' +
                '<div class="card-img">' +
                '<img class="img-thumbnail rounded" src="https://image.tmdb.org/t/p/w500' + data.poster_path + '" alt="Poster">' +
                '</div>' +
                '<div class="card-box align-center">' +
                '<h4 class="card-title mbr-fonts-style display-7">' + data.original_title + '</h4>' +
                '<div class="mbr-section-btn align-center text-sm-center text-center btn-bottom">' +
                '<a href="movie_view.php?movie_id=' + data.id + '" class="btn btn-secondary btn-xs display-4 text-sm-center">View</a>' +
                '</div>' +
                '</div>' +
                '</div>'
            )
        }
        $(".card-box").hide()
        $(".card")
            .mouseenter(function () {
                $(this).find(".card-box").show();
            })
            .mouseleave(function () {
                $(this).find(".card-box").hide();
            });
    }

    function disPlaySwal(title, text, type) {
        swal({
            title: title,
            text: text,
            type: type,
            button: "OK",
        }, function () {

        })
    }

    function ajaxCallFunction(urlLink, num) {
        $.ajax({
            url: urlLink,
            type: "get",
            dataType: 'json', // added data type
            success: function (res) {
                console.log(res);
                let movies = res.results;
                if (res.total_pages > 0) {
                    $("#page-number-alert").text(num);
                    $("#total-pages-alert").text(res.total_pages);
                    populateMovies(movies)
                    rePaginate(num, res.total_pages);
                } else {
                    // sweet alert
                    disPlaySwal("No Movies Found", "Try a Different Search.", "warning");
                }
            },
            error: function () {
// sweet alert
                disPlaySwal("Yikes", "Something Went Wrong.", "error");
            }
        });
    }

    function rePaginate(num, total_pages) {
        paging.off("page");
        paging = $('#page-selection').bootpag({
            total: total_pages,
            page: num,
            maxVisible: 10,
        }).on("page", function (event, /* page number here */ num) {
            // $("#content").html("Insert content"); // some ajax content loading...
            let query = $("#search").val();
            let urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_TV . $category . $api_key;?>&page=" + num;
            if (query.length != 0) {
                urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_SEARCH_TV . "?" . $api_key?>&page=" + num + "&query=" + query;
            }
            ajaxCallFunction(urlLink, num);
        });

    }

    // init bootpag
    paging.on("page", function (event, /* page number here */ num) {
        // $("#content").html("Insert content"); // some ajax content loading...
        let query = $("#search").val();
        let urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_TV . $category . $api_key;?>&page=" + num;
        if (query.length != 0) {
            urlLink = "<?php echo HTTPS_API_THEMOVIEDB_ORG_3_SEARCH_TV . "?" . $api_key?>&page=" + num + "&query=" + query;
        }
        ajaxCallFunction(urlLink, num);
    });
</script>
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"></a></div>
<input name="animation" type="hidden">
</body>
</html>