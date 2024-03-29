$(function () {
    var table = $('#salesTable').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: baseUrl+"seller/manage_sales",
      order: [ [0, 'Desc'] ],
      columns: [
          {data: 'id', name: 'id'},
          {data: 'voucher_no', name: 'voucher_no'},
          {data: 'customer', name: 'customer'},
          {data: 'seller', name: 'seller'},
          {data: 'v_date', name: 'v_date'},
          {data: 'del_date', name: 'del_date'},
        //   {data: 'del_amount', name: 'del_amount'},
          {data: 'action', name: 'action'}
          ],
          columnDefs: [
              { "orderable": true, "searchable": true }
          ]
    });

  /*View Seals Request Info*/
  $('.table').on('click', '.view-tr', function(){
      "use strict";
      var unitID  = this.id.replace('view-tr-', '');
      var url= baseUrl+"seller/sold_details/"+unitID;
      getAjaxView(url,data=null,'ajaxview',false,'get');
  });
  /*Print Invoice*/
  $('.table').on('click', '.print-tr', function(){
      "use strict";
      var unitID  = this.id.replace('print-tr-', '');
      var url= baseUrl+"seller/print_invoice/"+unitID;
      location.href = url;
  });

//   Print Chalan
$('.table').on('click', '.printchalan-tr', function(){
    "use strict";
    var unitID  = this.id.replace('printchalan-tr-', '');
    var url= baseUrl+"warehouse/print_chalan/"+unitID;
    location.href = url;
});

$(document).on('click','[data-toggle="modal"]', function(e){
  var target_modal_element = $(e.currentTarget).data('content');
  var target_modal = $(e.currentTarget).data('target');

  var modal = $(target_modal);
  var modalBody = $(target_modal + ' .modal-content');

  console.clear();
  
  modalBody.load(target_modal_element);
})

});