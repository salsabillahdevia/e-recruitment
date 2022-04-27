<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page
{

    protected $CI;
    private $data = array();

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->setTitle();
    }


    /**
     * Fungsi ini untuk mengatur title pada halaman html
     * @param $title String
     */

    public function setTitle($title = 'default')
    {
        $this->data['title'] = $title;
    }


    /**
     * @return mixed
     */
    public function generateTitle()
    {
        return $this->data['title'];
    }

    /**
     * Mengatur data yang akan di parsing ke view
     * @param $index kunci data
     * @param $value isi data
     */
    public function setData($index, $value = null)
    {
        if (!isset($this->data['content'])) {
            $this->data['content'] = array();
            $this->insertData($index, $value);
        } else {
            $this->insertData($index, $value);
        }
    }

    private function insertData($data, $value)
    {
        if (is_array($data)) {
            foreach ($data as $item => $value) {
                $this->data['content'][$item] = $value;
            }
        } else {
            $this->data['content'][$data] = $value;
        }
    }


    /**
     * Mengambil data yang sudang di set/atur
     * @param $index String
     * @return data berdasarkan index
     */
    public function getData($index)
    {
        if (isset($this->data['content'][$index])) {
            return $this->data['content'][$index];
        }
    }
}
