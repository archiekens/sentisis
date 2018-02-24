<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Comment Rating Percentages"
            },
            subtitles: [{
                text: "Out of <?php echo $comment_count;?> comments on <?php echo date('F j, Y'); ?>"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }],
            theme: 'light2'
        });
        chart.render();
    }
</script>