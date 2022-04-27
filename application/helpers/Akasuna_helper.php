<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('kode_petugas')) {
        redirect('auth');
    } else {
        $kode_petugas = $ci->session->userdata('kode_petugas');

        //query buat ngecek kode_petugas
        $userAccess = $ci->db->get_where('user', [
            'kode_petugas' => $kode_petugas
        ]);

        //kalo query diatas hasilnya 0 atau belom login, tendang ke halaman blocked
        if ($userAccess->num_rows() < 1) {
            redirect('auth');
        }
    }
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE)
    {
        dump($var, $label, $echo);
        exit;
    }
}

if (!function_exists('loadPage')) {
    function loadPage($view, $vars = array())
    {
        $data['view'] = $view;
        $data['data'] = $vars;
        $CI = &get_instance();
        return $CI->load->view('layouts/layout', $data);
    }
}
