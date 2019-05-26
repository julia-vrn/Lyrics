<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit();
}
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
  <title>Управление словарем</title>

</head>
<body>

<?php 
$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");

  if(!empty($_REQUEST['keyph'])){
    $kask = $mysqli->prepare("INSERT INTO lyrics(category, keyphrase, comment, song, quote) VALUES (?, ?, ?, ?, ?)");
    echo $mysqli->error;
    $cat = strtoupper($_REQUEST["cat"]);
    $kask->bind_param("sssss", $cat, $_REQUEST["keyph"], $_REQUEST["comm"], $_REQUEST["sng"], $_REQUEST["lrcs"]);
    $kask->execute();

    header("Location: editbase.php?c=1");
    }

    
?>

<div class="container">
  <!--main image section!-->
  <div class="row main-image">
    <div class="main__quote pr-5">
      <div class="main__quote--left">... Мне есть что спеть, представ перед всевышним, <br>
Мне есть чем оправдаться перед ним...</div>
      <div class="main__quote--right">Владимир Высоцкий</div>
     

    </div>
  </div>


  <div class="row glossary pt-1">
    <div class="col-lg-8 col-md glossary-list">
        <a href="?c=1">А</a>
        <a href="?c=2">Б</a>
        <a href="?c=3">В</a>
        <a href="?c=4">Г</a>
        <a href="?c=5">Д</a>
        <a href="?c=6">Е</a>
        <a href="?c=7">Ж</a>
        <a href="?c=8">З</a>
     
        <a href="?c=9">И</a>
        <a href="?c=10">К</a>
        <a href="?c=11">Л</a>
        <a href="?c=12">М</a>
        <a href="?c=13">Н</a>
        <a href="?c=14">О</a>
        <a href="?c=15">П</a>
      
        <a href="?c=16">Р</a>
        <a href="?c=17">С</a>
        <a href="?c=18">Т</a>
        <a href="?c=19">У</a>
        <a href="?c=20">Ф</a>
        <a href="?c=21">Х</a>
        <a href="?c=22">Ц</a>
     
        <a href="?c=23">Ч</a>
        <a href="?c=24">Ш</a>
        <a href="?c=25">Щ</a>
        <a href="?c=26">Э</a>
        <a href="?c=27">Ю</a>
        <a href="?c=28">Я</a>
      </div>     
      
      
  <div class="col-lg-4 col-md d-flex justify-content-center search">
    <form method="GET" action="editbase.php?c=1" class="align-self-center">
<input type="text" name="search" placeholder="Введите слово"/>
<input type="submit" value="Искать">
 </form>
    </div>
    
    </div><div class="row logout">
      <div class="col-12 d-flex justify-content-end">
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Выход из системы</a>
      </div>
    </div>

    
    
    
    <?php 
   function sortLetter($letter){
    $mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
    mysqli_query($mysqli,"SET NAMES UTF8");
    $result =  $mysqli->query("SELECT id, category, keyphrase, comment, song, quote FROM lyrics WHERE category LIKE '$letter'") or die(mysqli_error($mysqli));
    echo "<div class='row'><div class='col-lg-12 d-flex justify-content-center'><span class='letter'>".$letter."</span></div></div>";
    echo "
    <table class='table'>
    <tr>
    <th class='id'>ID</th>
    <th>Категория</th>
    <th>Ключевая фраза</th>
    <th>Пояснение</th>
    <th>Название песни</th>
    <th>Слова песни</th>
    <th></th>
    <th></th></tr>";
    
    while($row = $result->fetch_assoc()){
      $id = $row['id'];
      echo "<tr class='table-row'>";
      echo "<td class='align-top'>".$row['id']."</td>";
      echo "<td class='align-top d-flex justify-content-center'>".$row['category']."</td>";
      echo "<td class='align-top pr-3'>".$row['keyphrase']."</td>";
      echo "<td class='align-top pr-3'>".$row['comment']."</td>"; 
      echo "<td class='align-top'>".$row['song']."</td>";
      echo "<td class='align-top' align='right'>".$row['quote']."</td>";
      
      echo "<td class='td-manage align-middle'><a href='#'></a>
      <a href='#'  data-toggle='modal' data-target='#exampleModal' class='editbtn'>
      <i class='fas fa-pen-nib' title='Редактировать запись'></i>
    </a>
    <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Редактирование записи</h5>
           
          </div>
          <div class='modal-body'>

          <form action='update.php' id='modal-details' method='POST'>
          <div class='form-group'>
          <input type='hidden' name='id' id='update_id class='form-control' value='$id'>
          </div>

        <div class='form-group'>
          <label>Категория (А-Я)</label>
            <input type='text' name='category' id='cat' class='form-control' value=''>
        </div>   

        <div class='form-group'>
          <label>Ключевая фраза</label>
            <input type='text' name='keyphrase' id='kp' class='form-control' value=''>
        </div>    

        <div class='form-group'>
            <label>Пояснение</label>
            <textarea name='comment' rows='4' id='cm' class='form-control' value=''></textarea>
        </div>  

       
        <div class='form-group'>
          <label>Название песни</label>
          <input type='text' name='song' id='sn' class='form-control' value=''>
       </div>  
      
       <div class='form-group'>
        <label>Текст песни</label>
        <textarea name='quote' rows='10' id='qt' class='form-control' value=''></textarea>
      </div>  
      <button type='submit' name='update' class='btn' form='modal-details'>Сохранить изменения</button>
          </div>
          </form>
        </div>
      </div>
    </div>      
      </td>";
      echo "<td class='td-manage align-middle'><a href='delete.php?delete={$row['id']};' class='align-middle' alt='удалить запись' onclick='return checkDelete()'><i class='far fa-trash-alt' title='Удалить запись'></i></a></td></tr>";
      
    }
    echo "</table>";
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

       echo "<div class='row'><div class='col-lg-12 pt-3'><span><a href='#'></a>
      <a href='#'  data-toggle='modal' data-target='#exampleModal1'>
      Добавить новую запись</i></span>
    </a>
    <div class='modal fade' id='exampleModal1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Добавить новую запись</h5>
          </div>
          <div class='modal-body'>

          <form action='editbase.php?c=1' method='POST'>

        <div class='form-group'>
          <label>Категория А-Я</label>
            <input type='text' name='cat' class='form-control' value=''>
        </div>   

        <div class='form-group'>
          <label>Ключевая фраза</label>
            <input type='text' name='keyph' class='form-control' value=''>
        </div>    

        <div class='form-group'>
            <label>Пояснение</label>
            <textarea name='comm' rows='4' class='form-control' value=''></textarea>
        </div>  

       
        <div class='form-group'>
          <label>Название песни</label>
          <input type='text' name='sng'  class='form-control' value=''>
       </div>  
      
       <div class='form-group'>
        <label>Текст песни</label>
        <textarea rows='10' name='lrcs' class='form-control' value=''></textarea>
      </div>  
      <button type='submit' name='save' class='btn'>Сохранить запись</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    </div>";
        echo "<div class='row line-break'></div>";
        
        sortLetter($value); 
       
       }
     }
 } else if(!isset($_GET['search'])) {
  echo "<div class='row line-break mt-4'></div>";

 
 }
  ?>
  

<?php 
 if(isset($_GET['search']))
 { 
  echo "<div class='row'><div class='col-lg-12 pt-3'><span><a href='#'></a>
      <a href='#'  data-toggle='modal' data-target='#exampleModal'>
      Добавить новую запись</i></span>
    </a>
    <div class='modal fade' id='exampleModal1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Добавить новую запись</h5>
          </div>
          <div class='modal-body'>

          <form action='editbase.php?c=1' method='POST'>

        <div class='form-group'>
          <label>Категория А-Я</label>
            <input type='text' name='cat' class='form-control' value=''>
        </div>   

        <div class='form-group'>
          <label>Ключевая фраза</label>
            <input type='text' name='keyph' class='form-control' value=''>
        </div>    

        <div class='form-group'>
            <label>Пояснение</label>
            <textarea name='comm' rows='4' class='form-control' value=''></textarea>
        </div>  

       
        <div class='form-group'>
          <label>Название песни</label>
          <input type='text' name='sng' class='form-control' value=''>
       </div>  
      
       <div class='form-group'>
        <label>Текст песни</label>
        <textarea rows='10' name='lrcs' class='form-control' value=''></textarea>
      </div>  
      <button type='submit' name='save' class='btn'>Сохранить запись</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    </div>";
  echo "<div class='row line-break'></div>";
 $key=$_GET["search"];  //key=pattern to be searched 
 if($key==""){
  echo "<div class='row result '><div class='col-lg-12 d-flex justify-content-center search-query'>Введите слово или фразу для поиска</div>";
 }else {
  $result = mysqli_query($mysqli,"select * from lyrics where keyphrase like '%$key%'"); 
  echo "<div class='row'><div class='col-lg-12 d-flex justify-content-center search-query'><span>Результаты поиска по вашему запросу: </span><span class='key'>".$key."</span></span></div></div>";
  echo "
  <table class='table'>
  <tr>
  <th class='id'>ID</th>
  <th>Категория</th>
  <th>Ключевая фраза</th>
  <th>Пояснение</th>
  <th>Название песни</th>
  <th>Слова песни</th>
  <th></th>
  <th></th></tr>";
  while($row=mysqli_fetch_assoc($result))
  {
   $id = $row['id'];
   echo "<tr class='table-row'>";
   echo "<td class='align-top'>".$row['id']."</td>";
   echo "<td class='align-top d-flex justify-content-center'>".$row['category']."</td>";
   echo "<td class='align-top pr-3'>".$row['keyphrase']."</td>";
   echo "<td class='align-top pr-3'>".$row['comment']."</td>"; 
   echo "<td class='align-top'>".$row['song']."</td>";
   echo "<td class='align-top' align='right'>".$row['quote']."</td>";
   
   echo "<td class='td-manage align-middle'><a href='#'></a>
   <a href='#'  data-toggle='modal' data-target='#exampleModal' class='editbtn'>
   <i class='fas fa-pen-nib' title='Редактировать запись'></i></a>
 <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
   <div class='modal-dialog' role='document'>
     <div class='modal-content'>
       <div class='modal-header'>
         <h5 class='modal-title' id='exampleModalLabel'>Редактирование записи</h5>
        
       </div>
       <div class='modal-body'>
 
       <form action='update.php' id='modal-details' method='POST'>
       <div class='form-group'>
       <input type='hidden' name='id' id='update_id class='form-control' value='$id'>
       </div>
 
     <div class='form-group'>
       <label>Категория А-Я</label>
         <input type='text' name='category' id='cat' class='form-control' value=''>
     </div>   
 
     <div class='form-group'>
       <label>Ключевая фраза</label>
         <input type='text' name='keyphrase' id='kp' class='form-control' value=''>
     </div>    
 
     <div class='form-group'>
         <label>Пояснение</label>
         <textarea name='comment' rows='4' id='cm' class='form-control' value=''></textarea>
     </div>  
 
    
     <div class='form-group'>
       <label>Название песни</label>
       <input type='text' name='song' id='sn' class='form-control' value=''>
    </div>  
   
    <div class='form-group'>
     <label>Текст песни</label>
     <textarea name='quote' rows='10' id='qt' class='form-control' value=''></textarea>
   </div>  
   <button type='submit' name='update' class='btn' form='modal-details'>Сохранить изменения</button>
       </div>
       </form>
     </div>
   </div>
 </div>      
   </td>";
   echo "<td class='td-manage align-middle'><a href='delete.php?delete={$row['id']};' class='align-middle' alt='удалить запись' onclick='return checkDelete()'><i class='far fa-trash-alt' title='Удалить запись'></i></a></td></tr>";
  } 
 
   echo "</table>";
 }
 
 
 } 
 
 ?>
 
 <div class="row footer">
<div class="col-lg-12 pt-2 foot"><span>&copy; Julia Vrn</span></div>
</div>

    </div>
  
    

  </div>
  

</div>





  <script type='text/javascript'src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>  
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


<script>
  $(document).ready(function(){
    $('.editbtn').on('click', function(){
      
      $tr = $(this).closest('tr');
      var $data = $tr.find("td").map(function() {
        return $(this).text();
      }).get();
      console.log($data);
      $('#cat').val($data[1]);
      $('#kp').val($data[2]);
      $('#cm').val($data[3]);
      $('#sn').val($data[4]);
      $('#qt').val($data[5]);
    });
  });

</script>

</body>
</html>