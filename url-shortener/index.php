<?php
include "php/redirect.php";
$shortUrl = substr($_SERVER['REQUEST_URI'], 1);

if (checkShortUrl($shortUrl)) {
    redirectToOriginalUrl($shortUrl);
} elseif (!checkShortUrl($shortUrl) && $shortUrl != null) {
    http_response_code(400);
    echo "<h1 style='text-align: center; margin-top: 10%;'>Error: Entered shorten url doesn't exist.</h1>";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>URL Shortener</title>
    <!--  Logotype  -->
    <link rel="icon" href="resources/images/link.png"/>

    <!--  Bootstrap v5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <!--  CSS  -->
    <link rel="stylesheet" href="resources/style.css">

    <!--  Icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">

    <!--  JS  -->
    <script src="resources/jquery-3.6.3.min.js"></script>
    <script src="resources/script.js"></script>
</head>
<body>
<div class="container text-center">
    <h1>URL Shortener</h1>

    <div class="main p-5">
        <div class="form-container">
            <form id="create-short-url">
                <input type="text" id="original-url" name="original-url"
                       placeholder="Enter or paste URL" required>
                <i class="url-icon uil uil-link"></i>
                <button type="submit" id="create-short-url-btn">Submit</button>
            </form>
        </div>

        <?php
        $urls = json_decode(file_get_contents("data.json"), true);

        if (isset($urls)) {
            ?>
            <div class="mt-5 mb-3 position-relative">
                <h2 class="d-inline-block">URLs List</h2>
                <a href="php/delete.php?all=delete" id="delete-all-link">Clear all</a>
            </div>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>Short URL</th>
                    <th>Original URL</th>
                    <th>Clicks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="url-list-body">
                <?php
                $urls = array_reverse($urls);
                foreach ($urls as $shortUrl => $url) {
                    $originalUrl = $url["original_url"];
                    $clickCount = $url["click_count"];
                    echo "<tr>";
                    echo "<td><a href='/{$shortUrl}' target='_blank'>" . $_SERVER['HTTP_HOST'] . "/{$shortUrl}</a></td>";
                    echo "<td class='text-start table-text'>";
                    if (strlen($originalUrl) > 100) {
                        $string = substr($originalUrl, '0', '100');
                        echo "{$string}...";
                    } else {
                        echo $originalUrl;
                    }
                    echo "</td>";

                    echo "<td class='table-text'>{$clickCount}</td>";
                    echo "<td><a href='php/delete.php?key={$shortUrl}' id='delete-link'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
</body>
</html>