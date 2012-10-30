$(function($){
  $('#myTab a:first').tab('show');
  
  $('#myTab a').click(function (e) {
    //e.preventDefault();
    $(this).tab('show');
  })
})