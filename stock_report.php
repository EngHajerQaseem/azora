<?php
include("includes/template/header.php");
include("connect.php");
?>




<div class="white-color">
    
    <h5 class="center-text">Stock Value (Pepsi)</h5>
    
    <canvas id="myChart" width="400" height="400" ></canvas>
    
</div>


<script>
    var ctx = document.getElementById('myChart');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
            datasets: [
                {
                    label: 'Points',
                    backgroundColor: ['#f1c40f', '#e67e22', '#16a085', '#2980b9'],
                    data: [10, 20, 55, 30, 10]
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<?php
include("includes/template/footer.php");
?>