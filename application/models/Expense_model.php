<?php

class Expense_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Core_model','cm');
    }
    function getCategories(){
        $args['sTable'] = "category_master";       
        //$args['where'] = " id < 500";
        //$args['showQuery'] = true;
        $list = $this->cm->getTableList($args);
        return $list;
    }
      

}