<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
  table.table.table-bordered.table-hover.table-checkable.dt-responsive.nowrap {
    color: #fff;
}
</style>
 <body>
  <div class="container">
   <br />
   <br />
   <br />
   <h2 align="center">Tim Kiem</h2><br />
   <div class="form-group">
    <div class="input-group">
    
     <input type="text" name="search_text" id="search_text" placeholder="Search Users" class="form-control" />
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
  <div style="clear:both"></div>
  <br />
  <br />
  <br />
  <br />



<script>
$(document).ready(function(){
  function load_data(query)
    {
        $.ajax({
        url:"<?php echo base_url(); ?>checkout/fetch",
        method:"POST",
        data:{query:query},
        success:function(data){
        $('#result').html(data);
        }
        })
    }
   
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
        load_data(search);
        }
        else
        {
        
        }
    });



});
</script>