<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Expense_model','em');
        $this->load->model('Core_model','cm');
    }
	public function index()
	{	

		//$this->load->view('expense_list');
        redirect(base_url().'Expense/expense_list');
	}
    function expense_list()
	{
        $months = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        $years = array('2017','2018','2019','2020','2021','2022','2023');
        $categories = $this->em->getCategories();
        $data['months'] = $months;
        $data['years'] = $years;
        $data['categories'] = $categories;
        //var_dump($categories);die;
		$this->load->view('expense_list',$data);
	}
    public function getExpenseListAjax(){	
        //echo "welcome ";die;
        //$state = $_POST['columns'][2]['search']['value'];
        $cost = $_POST['columns'][1]['search']['value'];
        $month = $_POST['columns'][2]['search']['value'];
        $expense_name = $_POST['columns'][0]['search']['value'];
        $category = $_POST['columns'][3]['search']['value'];
        $mode = $_POST['columns'][4]['search']['value'];
        $remark = $_POST['columns'][6]['search']['value'];
        //echo "city = ".$city."    state -".$state;die;
        //print_r($_POST);die;
        $total_all_rows = $this->cm->getRowCount('expense_details');
        $columns = array(
            0 => 'id',
            1 => 'expense_name',
            2 => 'cost',
            3 => 'expense_month',
            4 => 'expense_year',
            5 => 'category',
            6 => 'payment_mode',
            7 => 'expense_date',
            //3 => 'to_date'            
        );
       

        if(!empty(($_POST['search']['value'])))
        {    
            if(!empty($_POST['search']['value'])){
            $where = " ";
            $search_value = $_POST['search']['value'];
            $where .= "  expense_name like '%".$search_value."%'";
            $where .= " OR category like '%".$search_value."%'";        
            $where .= " OR expense_month like '%".$search_value."%'"; 
            $where .= " OR expense_year like '%".$search_value."%'";
            $where .= " OR payment_mode like '%".$search_value."%'";
            $args['where'] = $where;
        	}
        }
        elseif(isset($month) || isset($cost) || isset($expense_name) || isset($category) || isset($mode) || isset($remark)){
            $where = " 1=1  ";
            if(!empty($month)){

                if(strlen($month) == 4 && is_numeric($month))
                {
                    $where .= " AND expense_year  = '".$month."'";
                }
                if(strlen($month) == 8 && strpos($month, '-'))
                {
                    $month = explode("-",$month);
                    $where .= " AND expense_month  = '".$month[0]."'";
                    $where .= " AND expense_year  = '".$month[1]."'";
                }

            }
            if(!empty($cost)){
                $where .= " AND cost  = '".$cost."'";                
            }
            if(!empty($expense_name)){
                $where .= " AND expense_name = '".$expense_name."'";                
            }
            if(!empty($category)){
                $where .= " AND category like '%".$category."%'";                
            }
            if(!empty($mode)){
                $where .= " AND payment_mode like '%".$mode."%'";                
            }
            if(!empty($remark)){
                $where .= " AND remark like '%".$remark."%'";                
            }
            $args['where'] = $where;
        }
       
        if(isset($_POST['order']))
        {
            $column_name = $_POST['order'][0]['column'];
            $order = $_POST['order'][0]['dir'];            
            $args['sorting'] = " ".$columns[$column_name]." ".$order." ";
        }
        else
        {           
            $args['sorting'] = "id desc";
        }

        if($_POST['length'] != -1)
        {
            $start = $_POST['start'];
            $length = $_POST['length'];
            $args['limit'] = $length;
            $args['offset'] = $start;
        }

        $args['sTable'] = "expense_details";       
        //$args['where'] = " id < 500";
        //$args['showQuery'] = true;
        $list = $this->cm->getTableList($args);
            
        $count_rows = count($list);
        $data = array();
        foreach($list as $row)
        {
            $sub_array = array();
            //$sub_array[] = $row->id;          
            $sub_array[] = $row->expense_name;
            $sub_array[] = $row->cost;
            $sub_array[] = $row->expense_month."-".$row->expense_year;
            $sub_array[] = $row->category;
            $sub_array[] = $row->payment_mode;
            $sub_array[] = $row->expense_date;
            //$sub_array[] = $row->remark;
            $sub_array[] = "<button class='btn btn-success btn-sm edit_expense'  data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='".$row->id."'>Edit</button> |
             <button class='btn btn-danger btn-sm delete_expense'  data-id='".$row->id."'>Delete</button>";
            /*$sub_array[] = date('d-M-Y',strtotime($row->from_date));
            $sub_array[] = date('d-M-Y',strtotime($row->to_date)); */       
            $data[] = $sub_array;
        }

        $output = array(
            'draw'=> intval($_POST['draw']),
            'recordsTotal' =>$count_rows ,
            'recordsFiltered'=>   $total_all_rows,
            'data'=>$data,
        );
        echo  json_encode($output);		
	}
    public function saveExpenseData(){
        $data = array();
        //print_r($_POST['exp_name']);
        $id = $_POST['exp_id'];
        $data['expense_name'] = $_POST['exp_name'];
        $data['cost'] = $_POST['exp_cost'];
        $data['category'] = $_POST['exp_category'];
        $data['expense_month'] = $_POST['exp_month'];
        $data['expense_year'] = $_POST['exp_year'];
        $data['payment_mode'] = $_POST['payment_mode'];
        $data['remark'] = $_POST['exp_remark'];
        $data['expense_date'] = !empty($_POST['exp_date']) ? date('Y-m-d',strtotime($_POST['exp_date'])) : '0000-00-00' ;
        
        //print_r($data);


        $args['table'] = "expense_details";
        $args['tableData'] = $data;
        //$args['showQuery'] = true;
        if(empty($id)){
            $args['mode'] = "Add";
        }
        else{
            $args['mode'] = "Edit";
            $args['where'] = " id=".$id;
        }

        if($this->cm->data_change($args)){
            echo "True";
        }
        else{
            echo "Error While Saving Record";
        }  

    }
    function getExpenseData(){
        $id = $_POST['id'];
        $args['sTable'] = "expense_details";       
        $args['where'] = " id = ".$id;
        $args['countOrResult'] = "row"; 
        //$args['showQuery'] = true;
        $data = $this->cm->getTableList($args);
        //print_r($data);
        echo json_encode($data);
    }
    public function deleteExpense(){
        $data = array();
        $id = $_POST['id'];
        $data['id'] = $id;
        $args['table'] = "expense_details";
        $args['tableData'] = $data;
        //$args['showQuery'] = true;       
        $args['mode'] = "Del";
        $args['where'] = " id=".$id;
        if($this->cm->data_change($args)){
            echo "Record Deleted";
        }
        else{
            echo "Error While Deleting Record";
        }  

    }
    
}
