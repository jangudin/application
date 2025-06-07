<ul class="nav nav-tabs">
<li <?=($this->router->fetch_method()=='list_daftar' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/list_daftar'); ?>" >List Proposal(Konfirm Berkas)</a></li>
<!--<li <?=($this->router->fetch_method()=='list_daftar_pembayaran' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/list_daftar_pembayaran'); ?>" >List Proposal(Konfirm Pembayaran)</a></li>-->
<li <?=($this->router->fetch_method()=='list_kaji_kelompok' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/list_kaji_kelompok'); ?>" >List Kaji Kelompok</a></li>
<li <?=($this->router->fetch_method()=='list_kaji_pleno' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/list_kaji_pleno'); ?>" >List Kaji Pleno</a></li>
<li <?=($this->router->fetch_method()=='list_ethical_clearance' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/list_ethical_clearance'); ?>" >List Ethical Clearance</a></li>
<li <?=($this->router->fetch_method()=='monitoring_proposal' ? 'class="active"' : '')?>><a href="<?php echo base_url('daftar/monitoring_proposal'); ?>" >Monitoring Proposal</a></li>
</ul>