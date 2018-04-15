<?php echo $this->element('SUsidebar'); ?>
<div class="container-partial container-system-users">
    <?php if ($data['total_comments'] != 0) : ?>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <div class="chart-info">
        <div class="chart-info-count">
            <strong>Total Number of Positive Comments: </strong><span><?php echo $data['total_pos']; ?> comments</span>
        </div>
        <div class="chart-info-count">
            <strong>Total Number of Neutral Comments: </strong><span><?php echo $data['total_neu']; ?> comments</span>
        </div>
        <div class="chart-info-count">
            <strong>Total Number of Negative Comments: </strong><span><?php echo $data['total_neg']; ?> comments</span>
        </div>
    </div>
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
                text: "Out of <?php echo $data['total_comments'];?> comments on <?php echo date('F j, Y'); ?>"
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