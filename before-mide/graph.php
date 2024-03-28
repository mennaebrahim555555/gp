<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    
</html>
<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
<?php
session_start();
$_SESSION['email']="a";
$x=$_SESSION['email'];
 $conn = mysqli_connect("localhost", "root", "", "testt");

 $query=$conn->query("SELECT 
MONTHNAME(created) as monthname,
SUM(amount) as amount
From graph
WHERE  email = '$x'
GROUP BY created
");

foreach($query as $data){
    $month[] = $data['monthname'];
    $amount[]=$data['amount'];
    
    }
    
    ?>
<script>
  
const labels = <?php echo json_encode($month) ?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: <?php echo json_encode($amount) ?>,
    fill: false,
    borderColor: 'rgb(75, 192, 192)',

   tension: 0.1
  }]
};
const config = {
  type: 'line',
  data: data,
};

  // === include 'setup' then 'config' above ===

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
 
</script>
</body>
