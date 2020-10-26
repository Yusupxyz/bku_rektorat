<!-- Default box -->
<div class="row">

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Saldo</span>
              <span class="info-box-number">Rp <?= number_format($saldo->saldo_awal-$saldo->saldo_akhir)?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Pemasukan Bulan ini
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
     
