<ul class="nav nav-tabs">
<li <?=($this->router->fetch_method()=='list_peneliti_diklat' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_diklat'); ?>" >List Peneliti Yang Sudah Ada Pembimbing</a></li>
<li <?=($this->router->fetch_method()=='list_peneliti_diklat_konfirm_bayar' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_diklat_konfirm_bayar'); ?>" >List Peneliti Yang Sudah Konfirm Bayar</a></li>
<li <?=($this->router->fetch_method()=='list_peneliti_yang_praktek' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_yang_praktek'); ?>" >List Peneliti Yang Praktek</a></li>
<li <?=($this->router->fetch_method()=='list_peneliti_yang_selesai' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_yang_selesai'); ?>" >List Peneliti Yang Sudah Selesai</a></li>
</ul>