//make search input for live search
<input type="text" name="search" id="search" placeholder="Type your keywords here" class="form-control"/>

//fetch data using ajax javascript from request page with ID..
<tbody id="result"></tbody>

//script start from here for live search
<script>
  $(document).ready(function(){
    load_data();
    function load_data(query)
    {
      $.ajax({
      url:"search_filter.php",
      type:"post",
      data:{query:query},
      success:function(data)
      {
        $('#result').html(data);
      }
      });
    }
    $('#search').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
    }
    else
    {
      load_data();
    }
    });
  });
</script>
//script end from here for live search
