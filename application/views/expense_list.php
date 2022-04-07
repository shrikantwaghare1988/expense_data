<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />   
    <style>
      .error{
        margin-top: 0.25rem;
        font-size: .855em;
        color: #dc3545;
        border-color: #dc3545;
      }  
      .exp_msg_success{
        border:1px solid red;
        border-radius: 5px;
        padding:5px;
        text-align:center;
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
      }
      .exp_msg_error{
        border:1px solid red;
        border-radius: 5px;
        padding:5px;
        text-align:center;
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
      }    
    </style>
    <title>Expense List</title>
  </head>
  <body>

    <div class="container-fluid p-5">
      <h2 class="text-center">Expense List</h2>      
      <div class="row my-2 float-right">
      <div class="col-md-3">
      <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
      New</button>
      </div>
      </div>
      <div class="row">
        <div class="container-fluid p-5 border bg-light">       
          <div class="row">            
            <div class="col-md-12">
              <table id="example" class="table">
                <thead>
                  <tr>  
                 
                  <th>Expense Name</th>
                  <th>Cost</th>
                  <th>Month-Year</th>
                  <th>Category</th>
                  <th>Payment Mode</th>
                  <th>Expense Date</th>
                  
                  <th>Action</th>
                  </tr>                                           
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>            
          </div>
        </div>
      </div>
    </div>


  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
              

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div  id="msg"></div>

      <form id="add_expense" method="post" action="">
      <div class="row">
        <div class="col-xs-6 form-group mb-2">
            <label>Expense Name</label>
            <input class="form-control required" type="text" name="exp_name" id="exp_name" autocomplete="off"/>
        </div>

        <div class="col-xs-6 mb-2">            
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                <label class="col-xs-12">Cost</label>
                    <input class="form-control" name="exp_cost" type="text" id="exp_cost" autocomplete="off"/>
                </div>
                <div class="col-xs-12 col-sm-6">
                <label class="col-xs-12">Category</label>
                <select  class="form-control" name="exp_category" aria-label="Default select example" id="exp_category">
                  <option selected value="">Select Category</option>
                  <?php
                  foreach($categories as $c){ ?>
                    <option value="<?php echo $c->category_nane; ?>"><?php echo $c->category_nane; ?></option>  
                  <?php }
                  ?>                 
                </select>
                </div>
            </div>
        </div>               


        <div class="col-xs-6 mb-2">            
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                <label class="col-xs-12">Month</label>
                <select class="form-select " name="exp_month" aria-label="Default select example" id="exp_month">
                  <option selected value="">Select Month</option>
                  <?php
                  foreach($months as $m){ ?>
                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>  
                  <?php }
                  ?>                 
                </select>
                </div>
                <div class="col-xs-12 col-sm-6">
                <label class="col-xs-12">Year</label>
                <select class="form-select" name="exp_year" aria-label="Default select example" id="exp_year">
                  <option selected value="">Select Year</option>
                  <?php
                  foreach($years as $y){ ?>
                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>  
                  <?php }
                  ?>                  
                </select>
                </div>
            </div>
        </div>

        <div class="col-xs-6 mb-2">            
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <label>Expense Date</label>
                  <input class="form-control" type="text" id="exp_date" name="exp_date" value="" autocomplete="off"/>
                </div>
                <div class="col-xs-12 col-sm-6">
                <label>Payment Mode</label>
                <select class="form-select" name="payment_mode" aria-label="Default select example" id="payment_mode">
                  <option selected value="">Select Payment Mode</option>
                  <option value="Cashe">Cashe</option>
                  <option value="GPay">GPay</option>
                  <option value="Credit Card">Credit Card</option>
                  <option value="Debit Card">Debit Card</option>                               
                </select>    
                </div>
            </div>
        </div>

        <div class="col-xs-6 form-group mb-2">
            <label>Remark</label>
            <textarea class="form-control" id="exp_remark" rows="3"></textarea>
        </div>       
        
    </div>  
</form>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="exp_id" id="exp_id" value="">
        <button type="button" class="btn btn-primary" id="save_expense">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
     
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


    <script type="text/javascript">
      $(document).ready( function () {        

      var validator =  $("#add_expense").validate({        
                rules: {
                          exp_name: {required: true,minlength: 3},
                          exp_cost: {required: true,number: true,min:5,max:100000}, 
                          exp_month: {required: true},
                          exp_year: {required: true},                                    
                       },
                messages : {
                            exp_name: {
                            required: "Enter Expense Name",  
                            minlength: "Name should be at least 3 characters"
                            },
                            exp_cost: {
                            required: "Enter Cost",
                            number: "Cost must be numerical value",
                            min: "Cost must be atlest 5 Rs.",
                            max: "Cost not Greter than 1 Lac"
                            },
                            exp_month: {
                            required: "Select Month"
                            },
                            exp_year: {
                            required: "Select Year"
                            }
                          }
            });       
            

        $( "#exp_date" ).daterangepicker({
          singleDatePicker: true,
          autoUpdateInput: true,
          showDropdowns: true,
          minYear: 2015,
          maxYear: parseInt(moment().format('YYYY'),10)
        });
        
        function resetForm(){
           $('#exp_name').val('');
           $('#exp_cost').val('');
           $('#exp_category').val('');
           $('#exp_remark').val('');
           $('#exp_date').val('');
           
        }
        $('#example thead th').each(function () {
            var title = $(this).text();
            $(this).html(title+' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
        });        

       var table = $('#example').DataTable({         
              
             dom: 'Blfrtip',
             buttons: [
                          {
                             extend: 'copy',
                             text: "<span class='glyphicon glyphicon-print'></span> Copy",
                             title: 'Copy',                               
                             action: newexportaction
                          },
                          {
                             "extend": 'excel',
                             text: "<span class='glyphicon glyphicon-print'></span> Excel(All)",
                             "title": 'City Data',                               
                             "action": newexportaction
                          },
                          {
                             "extend": 'csv',
                             text: "<span class='glyphicon glyphicon-print'></span> CSV",
                             "title": 'CSV',                               
                             "action": newexportaction
                          },
                          {
                             "extend": 'pdf',
                             text: "<span class='glyphicon glyphicon-print'></span> PDF",
                             "title": 'PDF',                               
                             "action": newexportaction
                          },
                          {
                             "extend": 'print',
                             text: "<span class='glyphicon glyphicon-print'></span> Print",
                             "title": 'Print',                                
                             "action": newexportaction
                          }                
                
             ],             
          'serverSide': 'true',
          'lengthMenu': [[10,25, 100, -1], [10,25, 100, "All"]],
          'pageLength': 10,
          'processing': 'true',
          //'scrollX': 'true',
         
          'paging': 'true',
          'orderCellsTop': 'true',
          //'fixedHeader': 'true',
          'searching': 'true',
          'order': [],           
          'ajax': {
            'url': '<?php echo base_url(); ?>Expense/getExpenseListAjax',
            'type': 'post',
            "data": function (d) {
             //d.search_name = $('#search_name').val();                     	
           },
           columns: [
                        { data: 'id' },
                        { data: 'expense_name' },
                        { data: 'cost' }
                    ]
         },
         initComplete: function()
        {   
          
        }
                        
       });

       table.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {                        
                	   table.search(this.value).draw();
                }
            });
        });

    function newexportaction(e, dt, button, config) {
          var self = this;
          var oldStart = dt.settings()[0]._iDisplayStart;
          dt.one('preXhr', function (e, s, data) {
              // Just this once, load all data from the server...
              data.start = 0;
              data.length = 2147483647;
              dt.one('preDraw', function (e, settings) {
                  // Call the original action function
                  if (button[0].className.indexOf('buttons-copy') >= 0) {
                      $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                  } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                      $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                          $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                          $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                  } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                      $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                          $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                          $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                  } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                      $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                          $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                          $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                  } else if (button[0].className.indexOf('buttons-print') >= 0) {
                      $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                  }
                  dt.one('preXhr', function (e, s, data) {
                      // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                      // Set the property to what it was before exporting.
                      settings._iDisplayStart = oldStart;
                      data.start = oldStart;
                  });
                  // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                  setTimeout(dt.ajax.reload, 0);
                  // Prevent rendering of the full data to the DOM
                  return false;
              });
          });
          // Requery the server with the new one-time export settings
          dt.ajax.reload();
    }
    $('#save_expense').on('click', function (e) {
         
         var btn = $(this);
         var text = btn.text();
         setTimeout(function(){
             btn.prop('disabled', true);
             btn.text("Wait...");
         }, 10);
         setTimeout(function(){
             btn.prop('disabled', false);
             btn.text( text);
         }, 3*1000);

       e.preventDefault();
         var s = $("#add_expense").valid();          
        if(s){
         var exp_id = $('#exp_id').val(); 
         var exp_name = $('#exp_name').val();
         var exp_cost = $('#exp_cost').val();
         var exp_category = $('#exp_category').val();
         var exp_month = $('#exp_month').val();
         var exp_year = $('#exp_year').val();
         var exp_remark = $('#exp_remark').val();
         var exp_date = $('#exp_date').val();           
         var payment_mode = $('#payment_mode').val();

         $.ajax({
             type: 'post',
             url: '<?php echo base_url(); ?>Expense/saveExpenseData',
             data: {exp_id,exp_name,exp_cost,exp_category,exp_month,exp_year,exp_remark,exp_date,payment_mode},
             success: function (response) {
                 //$('form')[0].reset();
               // $("#feedback").text(response);
                 
                 if(response=="True") {
                     //$('form')[0].reset();
                     resetForm();
                     $("#msg").addClass("exp_msg_success");
                     $('#msg').html("Data Saved Successfully").delay(3000).fadeIn('slow') //also show a success message 
                     $('#msg').delay(5000).fadeOut('slow');
                     table.draw();
                 }
                 else{
                     $("#msg").addClass("exp_msg_error");
                     $('#msg').html("Error while Saving Record").delay(3000).fadeIn('slow') //also show a success message 
                     $('#msg').delay(5000).fadeOut('slow');
                     }
             }
         });
        }           

     });
    $("body").on('click', ".edit_expense", function() {

        var id = $(this).data("id");
        $.ajax({
                  data :{id},
                  url  :"<?php echo base_url(); ?>Expense/getExpenseData", //php page URL where we post this data to view from database
                  type :'POST',
                  success: function(response)
                  {
                  var obj = JSON.parse(response)
                  $('#exp_name').val(obj.expense_name);
                  $('#exp_cost').val(obj.cost); 
                  $('#exp_category').val(obj.category); 
                  $('#exp_month').val(obj.expense_month); 
                  $('#exp_year').val(obj.expense_year); 
                  $('#payment_mode').val(obj.payment_mode); 
                  $('#exp_category').val(obj.category);
                  $('#exp_remark').val(obj.remark);
                  $('#exp_date').val(obj.expense_date);
                  $('#exp_id').val(obj.id);   
                  }
            });

});
$("body").on('click', ".delete_expense", function() {

var id = $(this).data("id");
$.ajax({
         data :{id},
         url  :"<?php echo base_url(); ?>Expense/deleteExpense", //php page URL where we post this data to view from database
         type :'POST',
         success: function(response)
         {         
         table.draw();
         }
});

});
    

      } );
    </script>

  </body>
  <footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-dark" href="#">Shrikant Waghare</a>
  </div>
  <!-- Copyright -->
</footer>
  </html>