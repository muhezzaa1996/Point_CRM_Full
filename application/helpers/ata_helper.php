<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }
}

function is_admin()
{
    $ci = get_instance();
    $level = $ci->session->userdata('level');
    $Akses = $ci->uri->segment(1);
    $ci->db->get_where('mst_user', ['level' => $Akses])->row_array();
    if ($level !== 'Admin') {
        redirect('auth/blocked');
    }
}

function is_driver()
{
    $ci = get_instance();
    $level = $ci->session->userdata('level');
    $Akses = $ci->uri->segment(1);
    $ci->db->get_where('mst_user', ['level' => $Akses])->row_array();
    if ($level !== 'Driver') {
        redirect('auth/blocked');
    }
}

function is_spv()
{
    $ci = get_instance();
    $level = $ci->session->userdata('level');
    $Akses = $ci->uri->segment(1);
    $ci->db->get_where('mst_user', ['level' => $Akses])->row_array();
    if ($level !== 'Supervisor') {
        redirect('auth/blocked');
    }
}

function is_gerai()
{
    $ci = get_instance();
    $level = $ci->session->userdata('level');
    $Akses = $ci->uri->segment(1);
    $ci->db->get_where('mst_user', ['level' => $Akses])->row_array();
    if ($level !== 'Gerai') {
        redirect('auth/blocked');
    }
}
