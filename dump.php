<?php
public function simpanRMEUpdate()
{
    $this->load->library('form_validation');
    $this->load->helper('security');
    
    if ($this->session->userdata('logged') != TRUE) {
        $this->load->view('v_login');
    } else {
        $post = $this->input->post();

        $apiAuth = $this->Model_fasyankes->authSatuSehat();
        if ($apiAuth == "unauthorized"){
            $this->session->set_flashdata('kode_name', 'danger');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Terjadi Kesalahan Sistem Mohon untuk Menghubungi Admin');
        } else {
            $bearerToken = json_decode($apiAuth, true);
            if (isset($post['agree'])) {
                if ($post['agree'] == "on") {
                    $validasidata = 1;
                } else if ($post['agree'] == "1") {
                    $validasidata = 1;
                } else if ($post['agree'] == "0") {
                    $validasidata = 0;
                } else {
                    $validasidata = 0;
                }
            } else {
                $validasidata = 0;
            }

            if (isset($post['data_rme_id']) && $post['data_rme_id'] != NULL) {
                $whereRME = array('id_faskes' => intval($post['id_faskes2']));
                $whereRMEdetail = array('data_rme_id' => intval($post['data_rme_id']));

                if ($this->input->post('status_rme') == 1) {
                    $vendor_awal = $this->input->post('vendor_lama');
                    $vendor_ganti = $this->input->post('vendor');

                    if ($vendor_awal == $vendor_ganti) {

                        $data_rme = array(
                            'id_faskes' => $post['id_faskes2'],
                            'status' => $post['status_rme'],
                            'sim_pengembang_id' => $post['vendor'],
                            'jenis_vendor_id' => $post['jenis_vendor'],
                            'vendor' => $post['vendor_text'],
                            'persetujuan_ketentuan_satset_id' => $validasidata
                        );


                        if ($post['status_rme'] == 2 && $post['vendor'] == null) {
                            $this->session->set_flashdata('kode_name', 'warning');
                            $this->session->set_flashdata('icon_name', 'check');
                            $this->session->set_flashdata('message_name', 'Gagal Input Data RME, Field Nama Vendor Belum di Input');
                        } else {
                            $this->Model_fasyankes->delete_data('data_rme_detail', $whereRMEdetail);
                            $this->Model_fasyankes->delete_data('data_rme', $whereRME);
                            $lastId = $this->Model_fasyankes->input_data_rme('data_rme', $data_rme);

                            foreach ($post['set_rme'] as $ids) {

                                $datas_detail = array(
                                    'data_rme_id' => $lastId,
                                    'data_set_rme_id' => $ids,

                                );
                                $this->Model_fasyankes->input_data('data_rme_detail', $datas_detail);
                            }
                            $this->session->set_flashdata('kode_name', 'success');
                            $this->session->set_flashdata('icon_name', 'check');
                            $this->session->set_flashdata('message_name', 'Sukses Input Data RME! 2');
                        }
                    } else {
                        $vendor = $this->input->post('vendor');

                        $postData = json_encode(array(
                            "email" => $this->input->post('email_pj'),
                            "facilityCode" => $this->input->post('kode_faskes'),
                            "orgId" => $this->input->post('org_id'),
                            "vendorId" => (int)$vendor,
                        ));

                        $curl2 = curl_init();

                        curl_setopt_array($curl2, array(
                            CURLOPT_URL => 'https://developer-portal-api.kemkes.go.id/external/apps/revoke-credential',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $postData,
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: Bearer '. $bearerToken['accessToken'],
                                'Content-Type: application/json'
                            ),
                        ));                        

                        $response2 = curl_exec($curl2);
                        $status_code = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
                        curl_close($curl2);
                        
                        if ($status_code==200) {
                            $jsonDecodeResponse = json_decode($response2, true);

                            $clientKey =  isset($jsonDecodeResponse['clientKey']) ? $jsonDecodeResponse['clientKey'] : '';
                            $clientSecret =isset($jsonDecodeResponse['clientSecret']) ? $jsonDecodeResponse['clientSecret'] : '';

                            if (isset($post['data_rme_id']) && $post['data_rme_id'] != NULL) {
                                $whereRME = array(
                                    'id_faskes' => $post['id_faskes2']
                                );

                                $this->Model_fasyankes->delete_data('data_rme', $whereRME);
                            }

                            if ($this->input->post('vendor') == 1) {
                                $data = array(
                                    'id_faskes' => $this->input->post('id_faskes2'),
                                    'status' => $this->input->post('status_rme'),
                                    'jenis_vendor_id' => $this->input->post('jenis_vendor'),
                                    'sim_pengembang_id' => $this->input->post('vendor'),
                                    'vendor' => $post['vendor_text'],
                                    'persetujuan_ketentuan_satset_id' => 0
                                );
                            } else {
                                $data = array(
                                    'id_faskes' => $this->input->post('id_faskes2'),
                                    'status' => $this->input->post('status_rme'),
                                    'jenis_vendor_id' => $this->input->post('jenis_vendor'),
                                    'sim_pengembang_id' => $this->input->post('vendor'),
                                    'vendor' => $post['vendor_text'],
                                    'persetujuan_ketentuan_satset_id' => $validasidata
                                );
                            }

                            $this->Model_fasyankes->delete_data('data_rme_detail', $whereRMEdetail);
                            $this->Model_fasyankes->delete_data('data_rme', $whereRME);

                            $lastId = $this->Model_fasyankes->input_data_rme('data_rme', $data);

                            $datasatusehat = array(
                                'secret_key' => $clientSecret,
                                'client_id' => $clientKey,
                                'organization_id' => $this->input->post('org_id'),
                                'sim_pengembang_id' => $this->input->post('vendor')
                            );

                            $where = array('kode_baru_faskes' => $post['kode_faskes']);
    
                            $this->Model_fasyankes->edit_data('satu_sehat_id', $where, $datasatusehat);

                            $this->session->set_flashdata('kode_name', 'warning');
                            $this->session->set_flashdata('icon_name', 'check');
                            $this->session->set_flashdata('message_name', 'Sukses Edit Data dengan Vendor yang berbeda!');                        
                        } else {
                            $this->session->set_flashdata('kode_name', 'danger');
                            $this->session->set_flashdata('icon_name', 'check');
                            $this->session->set_flashdata('message_name', 'Error Update SatuSehat Key');
                        }
                    }
                } else {
                    $validasidata = 0;
                    $data_rme = array(
                        'id_faskes' => $post['id_faskes2'],
                        'status' => $post['status_rme'],
                        'sim_pengembang_id' => $post['vendor'],
                        'jenis_vendor_id' => $post['rencana_vendor'],
                        'vendor' => $post['vendor_text'],
                        'persetujuan_ketentuan_satset_id' => $validasidata,
                        'status_internet_id' => $this->input->post('status_internet_id'),
                        'status_sdm_it_id' => $this->input->post('status_sdm_it_id')
                    );

                    $this->Model_fasyankes->delete_data('data_rme_detail', $whereRMEdetail);
                    $this->Model_fasyankes->delete_data('data_rme', $whereRME);

                    $lastId = $this->Model_fasyankes->input_data('data_rme', $data_rme);

                    $this->session->set_flashdata('kode_name', 'success');
                    $this->session->set_flashdata('icon_name', 'check');
                    $this->session->set_flashdata('message_name', 'Sukses Input Data RME!');
                }
            } else {
                $this->session->set_flashdata('kode_name', 'warning');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Gagal Input Data RME');
            }
        }   
    }
}
?>