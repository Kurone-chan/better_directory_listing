<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Downloads // Kurone's Website</title>

    <!-- Bootstrap -->
    <link href="//bootswatch.com/paper/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <?php
      function human_filesize($bytes, $decimals = 2) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
      }
    ?>

    <div class="jumbotron">
      <div class="container">
        <h2><span class="fa fa-location-arrow"></span> <?php echo $_SERVER['REQUEST_URI']; ?></h2>
      </div>
    </div>

    <div class="container-fluid" style="margin-top:60px;">
      <div class="row-fluid">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="panel-title"></div>
            </div>
            <!-- <div class="panel-body"> -->
              <table class="table table-condensed table-hover">
                <?php

                  $dir = "./";
                  $files = scandir($dir);

                  if(count($files) == 0)
                  {
                    echo '<tr><td><i>Nothing to see here! Click <a href="..">here</a> to go back.</i></td></tr>';
                  }else
                  {
                    foreach($files as $file)
                    {
                      if($file != ".")
                      {
                        if($file == ".." && $_SERVER['REQUEST_URI'] != "/")
                        {
                          echo '<tr><td><a href="..">Go Up</a></td></tr>';
                        }elseif($file != ".." && $file != "index.php" && is_dir($file))
                        {
                          echo '<tr><td><a href="//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/' . $file . '">' . $file . '/</a> <span class="text-muted pull-right">Folder</span></td></tr>';
                        }elseif($file != ".." && $file != "index.php" && !is_dir($file))
                        {
                          echo '<tr><td><a href="//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/' . $file . '">' . $file . '</a> <span class="text-muted pull-right">Size: ' . human_filesize(filesize($file)) . '</span></td></tr>';
                        }
                      }
                    }
                  }

                ?>
              </table>
            <!-- </div> -->
          </div>

        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </body>
</html>
