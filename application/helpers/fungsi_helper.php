<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session) {
        redirect('dashboard');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('auth/login');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('user');
    }
}

// function add_admin()
// {
//     $ci = &get_instance();
//     $ci->load->library('fungsi');
//     if ($ci->fungsi->user_login()->level != 1) {
//         redirect('user');
//     }
// }

function generateCodebarang($id)
{
    $ci = &get_instance();
    $ci->load->model(['category_m']);
    $query = $ci->category_m->get($id);
    return $query->row();
}
