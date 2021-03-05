<?php

# display html prior to any processing
$str = <<<'EOD'

<style>
.alert{
    background-color:lightblue;
    position:fixed;
    top:40%;
    height:10%;
    width:100%;
}
</style>
<div class = 'alert'>Please wait...</div>
EOD;

echo $str;
flush();


# handle GET or POST parameters
if (isset($_GET['gene'])) {
    echo '<h2>' , $_GET['gene'] , '</h2>';
} else if (!empty($_POST)) {
    echo 'POST with following values:</br>';
    print_r($_POST);
} else {
    # run rmarkdown and generate html file
    exec('/usr/bin/Rscript -e "library(rmarkdown);rmarkdown::render(\"Rmd/MyTest.Rmd\")" >outputFile.Rout 2>&1');
    readfile('Rmd/MyTest.html');
}

# hide initial html
$str = <<<'EOD'
<style>
    .alert{
        display:none;
    }
</style>
EOD;

echo $str;

?>

