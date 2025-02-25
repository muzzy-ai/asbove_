<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Upss </strong>Anda Tidak Memiliki Akses, silahkan login</div>');
            redirect("login");
        }
        $this->load->model('profile_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'HIMTI Official Merchandise',
            'page' => 'admin/profile',
            'profile' => $this->profile_model->getProfile('1')->row()
        );
        $this->load->view('admin/template/main', $data);
    }

    public function updateData()
    {
        $post = $this->input->post();

        if ($post) {
            $cek_id = $this->profile_model->getProfile($post['id'])->num_rows();

            if ($cek_id > 0) {
                $getProfile = $this->profile_model->getProfile($post['id'])->row();
                $filename = date('Ymd') . '_' . rand();

                $data = array(
                    'nama_website' => $post['nama_website'],
                    'email_website' => $post['email_website'],
                    'no_telp' => $post['no_telp'],
                    'alamat' => $post['alamat'],
                    'deskripsi_website' => $post['deskripsi_website'],
                    'maps' => $post['maps'],
                );

                if (!empty($_FILES['logo']['name'])) {
                    //delete file
                    if (file_exists('./assets/files/' . $getProfile->logo) && $getProfile->logo)
                        unlink('./assets/files/' . $getProfile->logo);

                    $upload = $this->_do_upload($filename);
                    $data['logo'] = $upload;
                }

                $update = $this->profile_model->update($post['id'], $data);

                if ($update) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success </strong>Data Berhasil Di Update!<i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>UPSS! </strong>Data Gagal Di Update! <i class="remove ti-close" data-dismiss="alert"></i></div>');
                    redirect('admin/Profile');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>UPSS! </strong>Maaf ID Tidak Ditemukan<i class="remove ti-close" data-dismiss="alert"></i></div>');
                redirect('admin/Profile');
            }
        } else {
            redirect('admin/Profile');
        }
    }

    private function _do_upload($filename)
    {
        $config['file_name']    = $filename;
        $config['upload_path']    = './assets/files';
        $config['allowed_types']    = 'gif|jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']    = 5000;
        $config['create_thumb']    = FALSE;
        $config['quality']    = '90%';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('logo')) {
            $data['inputerror'][] = 'logo';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_error('', '');
            $data['status'][] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
}
