<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Loại bệnh (<?php echo date('d/m/Y',strtotime($start)); ?> to <?php echo date('d/m/Y',strtotime($finish)); ?>)
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <canvas id="bar-chart-loaibenh" style="height: 300px;"></canvas>
    </div>
</div>