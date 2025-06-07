<?php
class Model_auditmedis extends CI_Model {

   function data_stroke($koders){
        $query= $this->cov->query("select * from db_auditmedis.kategori_strokeikemik ks WHERE koders='$koders'
        and id_stroke=(SELECT max(id_stroke) from db_auditmediskategori_strokeikemik WHERE koders kemarin semua yg dahulu db_auditmedis.ks.koders)");
        //echo $this->cov->last_query();
        return $query;
    }

}
?>
