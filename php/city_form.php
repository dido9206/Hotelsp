<script>
$(document).ready(function() {
        
		//the min chars for username
		var chars = 4;
		
		//result texts
		var characters_error = 'Трябва да въведете 4-цифрен код';
		var checking_html = '<img src="images/loading.gif" /> Проверяване...';
		
		//when button is clicked
		$('#pcode').keyup(function(){
			//run the character number check
			if($('#pcode').val().length != chars){
				//if it's bellow the minimum show characters_error text
				$('#check_pcode').html(characters_error);
			}else{			
				//else show the cheking_text and run the function to check
				$('#check_pcode').html(checking_html);
				check_availability(0);
			}
		});
		
		
  });

//function to check username availability	
function check_availability(save){
		
		//get the username
		var pcode = $('#pcode').val();
		var name = $("#cname").val();
		var country = $("#country").val();
		//use ajax to run the check
		$.post("php/add_city.php",	
		 	{pcode: pcode,
			name: name,
			country: country,
			save: save
			},
			function(data){
				$("#info").fadeIn(1, "linear");
				$("#info").html(data);
				$("#info").fadeOut(5600, "linear");
				//if the result is 1
				if(data == "1"){
					//show that the username is NOT available
					$('#check_pcode').html('<span class="is_not_available">Заето<img class="aviability" src="images/not_available.png"></span>');
					
				}else{
					//show that the username is available
					$('#check_pcode').html('<span class="is_available">Свободно<img class="aviability" src="images/available.png"></span>');
				}
		});
		return false; 

}  

</script>

<form name="input" method="post">
	<span id="info"></span><br/>
	Пощенски код*: <input type="text" name="pcode" id="pcode" required placeholder="Въведете код..."/><span id='check_pcode'></span><br /><hr />
	Град*: <input type="text" name="cname" id="cname" required placeholder="Въведете град..."/><br /><hr />
	Държава*: <input type="text" name="country" id="country" required placeholder="Въведете държава..."/><br /><hr />
	<span style="font-size: 12px">* - задължително поле</span>
	<button type="button" onclick="check_availability(1);">Въведи</button>
	<div class="success"></div>
</form>