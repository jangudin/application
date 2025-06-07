<ul class="nav nav-tabs">
<li <?=($this->router->fetch_method()=='list_peneliti_di_lahan' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_di_lahan'); ?>" >List Proposal Peneliti Yang Lolos Kepk</a></li>
<li <?=($this->router->fetch_method()=='list_peneliti_yang_praktek_lahan' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_yang_praktek_lahan'); ?>" >List Peneliti Yang Praktek</a></li>
<li <?=($this->router->fetch_method()=='list_peneliti_yang_selesai_lahan' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar_tahap2/list_peneliti_yang_selesai_lahan'); ?>" >List Peneliti Yang Sudah Selesai</a></li>
</ul>