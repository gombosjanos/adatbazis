<?php
$szoveg = "Belépés";
$link = "belepes.php";
if (!empty($_SESSION["id"])) {
    $szoveg = $_SESSION['nev'] . ": kilépés";
    $link = "index.php?logout=1";
}

$menupontok = array('index.php' => "Főoldal", 'ulesrend.php' => "Ülésrend", $link => $szoveg);



?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php
                foreach ($menupontok as $key => $value) {
                    $active=' ';
                    if($_SERVER['REQUEST_URI']== '/teszt/'.$key)$active=' active';
                
                ?>
                    <li class="nav-item<?php echo $active; ?>">
                        <a class="nav-link"  href="<?php echo $key; ?>"><?php echo $value; ?></a>
                    </li>
                <?php
                }
                ?>

                <!--<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ulesrend.php">Ülésrend</a>
        </li>-->


            </ul>
        </div>
    </div>
</nav>