@extends('layouts_shop.app')
<script src="{{asset('js/jquery.min.js') }}"></script>
@section('content')

<div class="form-group">
<input type="text" name="search" id="search" class="form-control" placeholder="Type Keywords" />
</div>
<h3 align="center">Total Data : <span id="total_records"></span></h3>
<div  id="all_data"></div>



@endsection()
<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#all_data').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>


