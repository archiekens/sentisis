<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <?php if ($comment_count != 0) : ?>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <?php else : ?>
    <h2>No reviews yet</h2>
    <span>Come back once there are reviews to view the chart.</span>
    <?php endif;?>
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