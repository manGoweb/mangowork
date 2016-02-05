<?php
setlocale(LC_ALL,"cs_CZ.UTF8");

// Config
$config['assetsPath'] = 'assets';
$db['server'] = "localhost";
$db['user'] = "mangowork";
$db['pass'] = "enfjue75r4bnd";

if (file_exists('config.local.php')) {
	include 'config.local.php';
}

// DB
$mysqli = new mysqli($db['server'], $db['user'], $db['pass'], "mangowork");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_POST['projekt']) && $_POST['projekt']){
	$query = "INSERT INTO calendar (data) VALUES ('".$_POST['projekt']."')";
	$mysqli->query($query);

	header("Location: /");
}

$sql = "SELECT `date`, data FROM `calendar` ORDER BY `date` DESC";
$result = $mysqli->query($sql);


function cesky_den($den) {
    static $nazvy = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
    return $nazvy[$den];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>manGoWork | work tracker bitch!</title>
    <meta name="description" content="work tracker bitch!">
    <meta name="author" content="David Drdek &lt;hexcross@gmail.com&gt; ">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="<?php echo $config['assetsPath'];?>/styles/screen.css">
    <link href="https://fonts.googleapis.com/css?family=Satisfy|Titillium+Web:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?php echo $config['assetsPath'];?>/images/favicon.png?icon=drdek2016" type="image/png" sizes="16x16">
    <link rel="shortcut icon" href="<?php echo $config['assetsPath'];?>/images/favicon32.png?icon=drdek2016" type="image/png" sizes="32x32">
  </head>
  <body>
    <div class="kontejner">
      <h1>manGoWork</h1>
      <table class="tabulka">
        <tr>
          <td colspan="2" class="formular">
            <form action="" method="POST">
              <input type="text" placeholder="Tak co jsi celej den dělal?" class="policko" name="projekt" required>
              <button class="buttonek">↵</button>
            </form>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="mesic">Únor</td>
        </tr>
        <?php
        while($row = $result->fetch_assoc()):
        	$date = date("d.", strtotime($row['date']));
        ?>
        <tr>
          <td class="den"><span><?php echo $date; echo cesky_den(date("w", strtotime($row['date'])));?></span>
          </td>
          <td class="data"><?php echo $row['data'];?></td>
        </tr>
        <?php
        endwhile;
        ?>
      </table>
    </div>
    <?php
    if (file_exists('.mango-snippet.html')) {
    	include '.mango-snippet.html';
  	}
    ?>
  </body>
</html>
