<script src="<?php echo $this->config->item('js_path') ?>bootstrap.js"></script>
<script src="<?php echo $this->config->item('js_path') ?>dcalendar.picker.js"></script>
<script>
$('#calendar-demo').dcalendar({format: 'dd-mm-yyyy'}); //creates the calendar

// $(document).ready(function(){
//     $('#calendar-demo').dcalendarpicker({format: 'mm-dd-yyy'}); //Initializes the date picker and uses the specified format
// });

$(document).ready(function(){

	var url_segment = '<?= $this->router->uri->segments[2]; ?>'

	if(url_segment == 'dashboard'){
	    $('#calendar-demo').dcalendarpicker(
	    	{format: 'dd-mm-yyy'}).on('datechanged', function(e){
	      		//alert(e.date);
	      		//$(this).setDate(e.date);
	      		$(".calender-out").show();

	      		$.ajax({
			      	type: "POST",
			      	url: "<?php echo $this->config->item('admin_base_url').'/dashboard_lead_list';?>",
			      	data: {result_type:'ajax','date':e.date},
			      	/*beforeSend: function() {
			            $('#common_div').block({ message: 'Loading...' }); 
					},*/
			      	success: function(data){
			        	$("#common_div").html(data);
			        	//$('#common_div').unblock(); 
			        	var next = $('#hidden_date').val();
			    	return false;
			      	}
			    });
	    });
    }

  });
</script>

<!--sidebar show-hide: start -->
<script>
var winHeight = $(document).height();
var topheaderHeight = $('.cus-navigation').height();
var sidebarLeft = (winHeight - topheaderHeight) + 40;
$(".filter-option-sidebar").height(sidebarLeft);
// alert(sidebarLeft);

$( document ).ready(function() {
    $(".open-close-arrw").click(function(){
        //alert('hi');
        $(".filter-option-sidebar").toggleClass("foc-open");
    });
});
</script>
<!--sidebar show-hide: close -->
</body>
</html>