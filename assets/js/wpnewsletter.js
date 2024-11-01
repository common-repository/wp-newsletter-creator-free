jQuery(document).ready(function($){
    $('.colorfield').wpColorPicker();


       $('#quicksearch').bind('keyup', function() { 
							          $('#form').submit();
							      });
							      $("#form").submit(function (event) {
							          event.preventDefault();
							         var data = document.getElementById('quicksearch').value;
							          $.post(ajaxurl, { action: 'quicksearch', bar: true, query: data }, function(response) {
							    
								    if(response !='0'){
									    
											  	  $("#result").html(response); 
									}
											                                    if(data ==""){
												                                    $('#list').show(); 
												                                    jQuery('#result').hide();
											                                    }else{
												                                          if(response !=''){
												                                                $('#list').hide();
											                                                }else{
												                                                $('#list').show();
												                                                $('#result').hide();
																			}
											                                    }       
											});
	 });
});
