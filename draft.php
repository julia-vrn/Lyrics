<?php 

session_start();

$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");

//$result = $mysqli->query("SELECT * FROM lyrics") or die(mysqli_error($mysqli));


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Marck+Script" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>

<div class="container">
  <!--main image section!-->
  <div class="row main-image">
    <div class="main__quote pr-5">
      <div class="main__quote--left">... Мне есть что спеть, представ перед всевышним, <br>
Мне есть чем оправдаться перед ним...</div>
      <div class="main__quote--right">Владимир Высоцкий</div>

    </div>
  </div>


  <div class="row glossary">
    <div class="col-lg-8 col-md glossary-list">
        <a href="?c=1">А</a>
        <a href="?c=2">Б</a>
        <a href="?c=3">В</a>
        <a href="?c=4">Г</a>
        <a href="?c=5">Д</a>
        <a href="?c=6">Ж</a>
        <a href="?c=7">З</a>
     
        <a href="?c=8">И</a>
        <a href="?c=9">К</a>
        <a href="?c=10">Л</a>
        <a href="?c=11">М</a>
        <a href="?c=12">Н</a>
        <a href="?c=13">О</a>
        <a href="?c=14">П</a>
      
        <a href="?c=15">Р</a>
        <a href="?c=16">С</a>
        <a href="?c=17">Т</a>
        <a href="?c=18">У</a>
        <a href="?c=19">Ф</a>
        <a href="?c=20">Х</a>
        <a href="?c=21">Ц</a>
     
        <a href="?c=22">Ч</a>
        <a href="?c=15">Ш</a>
        <a href="?c=16">Щ</a>
        <a href="?c=17">Э</a>
        <a href="?c=18">Ю</a>
        <a href="?c=19">Я</a>
      </div>     
      
      
  <div class="col-lg-4 col-md d-flex justify-content-center search">
    <form method="GET" action="draft.php" class="align-self-center">
<input type="text" name="search" placeholder="Введите слово"/>
<input type="submit" value="Искать">
 </form>
    </div>
    </div>

   

    <?php 
   function sortLetter($letter){
    $mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
    mysqli_query($mysqli,"SET NAMES UTF8");
    $result =  $mysqli->query("SELECT keyphrase,  comment, song, quote FROM lyrics WHERE category LIKE '$letter'") or die(mysqli_error($mysqli));
    echo "<div class='row'><div class='col-lg-12 d-flex justify-content-center'><span class='letter'>".$letter."</span></div></div>";
    while($row = $result->fetch_assoc()){
      
      echo "<div class='row result '>";
      echo "<div class='col-lg-12 '>";
      echo "<div class='wrapper d-flex keyphrase mt-3 mb-2 justify-content-center'>".$row['keyphrase']."</div>";
      echo "</div>";
      echo  "<div class='col-lg-12'>";
      echo "<div class='wrapper d-flex mb-4 justify-content-center'>".$row['comment']."</div>"; 
      echo "</div>";
      echo "<div class='col-lg-12'>";
      echo "<div class='wrapper d-flex mb-2 pr-3 justify-content-end'>".$row['song']."</div>";
      echo "</div>";
      echo  "<div class='col-lg-12'>";
      echo "<div class='wrapper quote pr-3 d-flex justify-content-end'>".$row['quote']."</div>";
      echo "</div>";
      echo "</div>";
      echo '<br>';
    }
  }
  $glossary = array("1"=>"А", "2"=>"Б", "3"=>"В", "4"=>"Г", "5"=>"Д",
                    "6"=>"Е", "7"=>"Ж", "8"=>"З", "9"=>"И", "10"=>"К",
                    "11"=>"Л", "12"=>"М", "13"=>"Н", "14"=>"О", "15"=>"П",
                    "16"=>"Р", "17"=>"С", "18"=>"Т", "19"=>"У", "20"=>"Ф",
                    "21"=>"Ч", "22"=>"Ц", "23"=>"Ч", "24"=>"Ш", "25"=>"Щ",
                    "26"=>"Э", "27"=>"Ю", "28"=>"Я"
                    );

   if(!empty($_GET["c"])){
     $link = ($_GET["c"]);
     foreach($glossary as $key=>$value){
       if($key==$link){
        echo "<div class='row '><div class='col-lg-12 pt-3 home'><span><a href='draft.php'>На главную</a></span></div></div>";
        echo "<div class='row line-break'></div>";
        sortLetter($value); 
       
       }
     }
 }
  ?>

<?php 
 if(!empty($_GET['search']))
 { 
  echo "<div class='row '><div class='col-lg-12 pt-3 home'><span><a href='draft.php'>На главную</a></span></div></div>";
  echo "<div class='row line-break'></div>";
 $key=$_GET["search"];  //key=pattern to be searched
 
 
 $result = mysqli_query($mysqli,"select * from lyrics where keyphrase like '%$key%'"); 
 
 while($row=mysqli_fetch_assoc($result))
 {
 
    echo "<div class='row result '>";
    echo "<div class='col-lg-12 '>";
    echo "<div class='wrapper d-flex keyphrase mt-3 mb-2 justify-content-center'>".$row['keyphrase']."</div>";
    echo "</div>";
    echo  "<div class='col-lg-12'>";
    echo "<div class='wrapper d-flex mb-4 justify-content-center'>".$row['comment']."</div>"; 
    echo "</div>";
    echo "<div class='col-lg-12'>";
    echo "<div class='wrapper d-flex mb-2 pr-3 justify-content-end'>".$row['song']."</div>";
    echo "</div>";
    echo  "<div class='col-lg-12'>";
    echo "<div class='wrapper quote pr-3 d-flex justify-content-end'>".$row['quote']."</div>";
    echo "</div>";
    echo "</div>";
    echo '<br>';
 } 
 } 
 ?>
    </div>
  
    

  </div>
</div>

   
   

 
<!--<table>
<thead>
          <tr>
            <th>Category</th>
            <th>Comment</th>
            <th>Quote</th>
          </tr>
        </thead>
       /* <?php
         while($row = $result->fetch_assoc()): ?>
         <tr>
           <td><?php echo $row['category'];?></td>
           <td><?php echo $row['comment'];?></td>
           <td><?php echo $row['quote'];?></td>
        </tr>
        <?php endwhile; ?>
      
</table>-->


  <script type='text/javascript'src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>  
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>