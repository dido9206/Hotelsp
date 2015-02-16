<script>
	$(document).ready(function() {
		hotelList2('hlist');
		hotelList2('delRoom');
		
		$('#delRoom').change(function(){
			roomList('rlist');
		});
	});
	var result2;
	function validate2(fieldId,save){
		var hotel_id = $('#hlist').val();
		var numbeds = $('#numbeds').val();
		var view = $('#view').val();
		var hasbath = $('#hasbath').val();
		var price = $('#price').val();
		$.ajaxSetup({async: false});
		$.post("php/add_room.php",	
		 	{hotel_id: hotel_id,
		 	 numbeds: numbeds,
		 	 view: view,
		 	 hasbath: hasbath,
		 	 price: price,
		 	 fieldId: fieldId,
			 save: save
			},
			function (data){
				//document.write(data);
				if(data!="0"){
					$('#'+fieldId+'_av').html('<span class="is_not_available">'+data+'<img class="aviability" src="images/not_available.png"></span>');
					result2=false;
					return false;
				}
				else{
					$('#'+fieldId+'_av').html('<span class="is_available"><img class="aviability" src="images/available.png"></span>');
					result2=true;
					return true;
				}
			});
			$.ajaxSetup({async: true});
		return result2;	
	}
	function validateAll2(){
		return validate2("hotel_id","no") &&
			validate2("numbeds","no") &&
			validate2("view","no") &&
			validate2("hasbath","no") &&
			validate2("price","no");
	}
	function saveRoom()
	{
		if( validateAll2()) {
				if(validate2("rinfo","yes"))
				{
					$("#rinfo_av").html('<span class="is_available">Успешно добавихте стая:'+$('#numbeds').val()+' легла, '+$('#price').val()+'лв.</span>');
					$('#addRoom').trigger("reset");
				}
				$("#rinfo_av").fadeIn(1, "linear");
				$("#rinfo_av").fadeOut(5600, "linear");
			}
		hotelList2('hlist');
		hotelList2('delRoom');
		roomList('rlist');
	}
	function updateRoom()
	{
		if( validateAll2()) {
				if(validate2($('#delRoom').val(),"update"))
				{
					$("#rinfo_av").html('<span class="is_available">Успешно променихте стая:'+$('#numbeds').val()+' легла, '+$('#price').val()+'лв.</span>');
					$('#addRoom').trigger("reset");
					$(".buttonadd:hidden").show("fast");
					$(".buttonchange:visible").hide("fast");
				}
				$("#rinfo_av").fadeIn(1, "linear");
				$("#rinfo_av").fadeOut(5600, "linear");
			}
		hotelList2('hlist');
		hotelList2('delRoom');
		roomList('rlist');
	}
	function hotelList2(method){
		var searchHotel = $('#searchHotel2').val();
		
		$.post(
			"php/hotellist.php",
			{searchHotel: searchHotel},
			function (data)
			{
				$('#'+method).html(data);
			}
		);
	
		return false; 
	}
	function roomList(method){
		var id = $('#delRoom').val();
		
		$.post(
			"php/roomlist.php",
			{id: id},
			function (data)
			{
				$('#'+method).html(data);
			}
		);
	
		return false; 
	}
	function delete_room(){
		if(confirm("Наистина ли искате да изтриете тази стая?")){
			var id = $('#rlist').val();
			$.post(
				"php/delete_room.php",
				{id: id},
				function (data)
				{
					alert(data);
					hotelList2('hlist');
					hotelList2('delRoom');
					roomList('rlist');
				}
			);
		}
	}
	function change_room(){
		var id = $('#rlist').val();
			$.post(
				"php/change_room.php",
				{id: id},
				function (data)
				{
					fillForm2(data.hotel_id,data.numbeds,data.view,data.hasbath,data.price);
					$(".buttonchange:hidden").show("fast");
					$(".buttonadd:visible").hide("fast");
					$( "#accordion2" ).accordion({
      					active: 0
    				});
				}, "json"
			);
		$( "#accordion2" ).accordion({
      		active: 0
    	});
	}
	function fillForm2(hotel_id,numbeds,view,hasbath,price)
	{
		$("#hlist option").filter(function() {
    		//may want to use $.trim in here
    		return $(this).val() == hotel_id; 
		}).attr('selected', true);
		$('#numbeds').val(numbeds);
		$('#view').val(view);
		$("#hasbath").val(hasbath);
		$('#price').val(price);
	}
	function initUpload() {

   	/*set the target of the form to the iframe and display the status
      message on form submit.
  	*/
		$('#deleteRoom').submit(function() {
		document.getElementById('deleteRoom').target = 'target_iframe2';
    	document.getElementById('status2').style.display="block"; 
		});
	}	

	//This function will be called when the upload completes.
	function uploadComplete(status){
   		//set the status message to that returned by the server
   		$('#status2').html(status);
	}

	window.onload=initUpload;
</script>
<div id="accordion2">
  <h3>Добави Стая</h3>
  <div>
	<form id="addRoom" method="post">
	<span id="rinfo_av"></span><br/>
	<input type="text" id="searchHotel2" class="searchfield">
	<button type="button" class="btn btn-success" onclick="hotelList2('hlist');">Търси</button><br/>
	<select name="hlist" id="hlist" required size="5"></select><span id='hotel_id_av'></span><br/><hr/>
	Брой легла*: <input type="number" name="numbeds" id="numbeds" min="1" max="10" required/><span id='numbeds_av'></span><br/><hr />
	Гледка*: <input type="text" name="view" id="view" placeholder="Гледка от стаята"/><span id='view_av'></span><br/><hr />
	Има ли баня*: <select name="hasbath" id="hasbath" required>
					<option value="none">[-]</option>
					<option value="Y">Да</option>
					<option value="N">Не</option>
				  </select><span id='hasbath_av'></span><br/><hr />
	Цена*: <input type="text" name="price" id="price" placeholder="Цена на нощувка"/><span id='price_av'></span><br/><hr />
	<span style="font-size: 12px">* - задължително поле</span>
	<button type="button" class="buttonadd" onclick="saveRoom();">Въведи</button>
	<button type="button" class="buttonchange" onclick="updateRoom();">Промени</button>
	
	</form>
  </div>
  <h3>Изтрии/Промени Стая</h3>
  <div>
  	<form method="post" action="php/upload_photo2.php" enctype="multipart/form-data" class="well-home span6 form-horizontal" name="deleteRoom" id="deleteRoom">  
           <input type="text" id="searchHotel" class="searchfield">  
           <button type="button" class="btn btn-success" onclick="hotelList('delRoom');">Търси</button><br/>
           <select name="delRoom" id="delRoom" required size="5"></select><br/>
           <select name="rlist" id="rlist" required size="5"></select>
           <button type="button" class="btn btn-success" onclick="delete_room();">Изтрии</button>
           <button type="button" class="btn btn-success" onclick="change_room();">Промени</button><br /><hr />
           <span style="font-size: 16px; font-weight: bold;">Въведи/Промени снимка (първо изберете хотел от горния списък):</span><br />
           <input name="file" id="file" size="27" type="file" /><br />
			<input type="submit" class="btn btn-success" name="action" value="Качи" />
			<span id="status2" style="display:none">Качване...</span>
			<iframe id="target_iframe2" name="target_iframe2" src="" style="width:0;height:0;border:0px"></iframe>
	</form> 
	
	
  </div>  
</div>