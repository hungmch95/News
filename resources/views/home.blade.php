@extends('layouts.app')

@section('content')
<?php
    $url = 'http://newsapi.org/v2/everything?q=the&pageSize=100&apiKey=6043e282ed294479b69c10e1ca6076ec';
    $response = file_get_contents($url);
    $newsData = json_decode($response, true);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = isset($_GET['per-page']) ? (int)$_GET['per-page'] : 12;
    $pages = ceil(sizeof($newsData["articles"]) / 12);
    $start = ($page > 1) ? ($page * 12) - 12 : 0;
    if($page === 9){
        $end = 99;
    }else{
        $end = $start + 11;
    }
?>
<link rel = "stylesheet" href="css/app.css">
<div class="container-fluid">
    <?php
        for($x = $start; $x <= $end; $x++){
    ?>
    <a href = "<?php echo $newsData["articles"][$x]["url"]   ?>">
        <div class = "row NewsGrid">
            <div class = "col-md-3">
                <img src="<?php echo $newsData["articles"][$x]["urlToImage"]?>" alt = "News Thumbnail" style="width: calc(100% - 2px); height: auto;";>
            </div>
            <div class = "col-md-9">
                <h2><?php echo $newsData["articles"][$x]["title"]   ?></h2>
                <h5><?php echo $newsData["articles"][$x]["description"] ?>  </h5>
                <p><?php echo $newsData["articles"][$x]["content"] ?>  </p>
                <h6>Author: <?php echo $newsData["articles"][$x]["author"] ?>   &emsp; Published: <?php echo $newsData["articles"][$x]["publishedAt"] ?> </h6>

            </div>
            <br>
        </div>
</a>
<?php } ?>
            <div class = "pagination" style = "font-size: 20px; justify-content: center">
        <?php for($x = 1; $x <= $pages; $x++): ?>
        <a href = "?page=<?php echo $x; ?>"<?php if($page === $x) {echo 'class="selected"';} ?> style = "font-size: 20px; padding-left: 10px"> <?php echo $x."  "; ?> </a>
        <?php endfor; ?>
            </div>
    </div>

@endsection
