<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends Base_model {

	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

    function updateMeta($connection, $pageTitle, $metaKey, $metaDesc)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

            $this->updateDB($connection,'setting', array('value'=>$pageTitle), array('name'=>'page_title'));
            $this->updateDB($connection,'setting', array('value'=>$metaKey), array('name'=>'meta_key'));
            $this->updateDB($connection,'setting', array('value'=>$metaDesc), array('name'=>'meta_description'));

        if ($this->connection->trans_status() === FALSE)
        {
            $this->connection->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->connection->trans_commit();
            return TRUE;
        }
    }


    function updateSeo($connection, $arrSeo, $page)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        $arrTemp = array('page-title-vn', 'page-title-en', 'meta-description-vn', 'meta-description-en', 'meta-key-vn', 'meta-key-en');
        foreach ($arrTemp as $item) {
            if ($this->getDB($connection, 'setting', array('id'), array('name'=>$item, 'type'=>$page))==FALSE) {
                $this->insertDB($connection, 'setting',array('name'=>$item, 'value'=>$arrSeo[$item], 'type'=>$page));
            }
            else {
                $this->updateDB($connection,'setting', array('value'=>$arrSeo[$item]), array('name'=>$item, 'type'=>$page));
            }
        }

        if ($this->connection->trans_status() === FALSE)
        {
            $this->connection->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->connection->trans_commit();
            return TRUE;
        }
    }

}
