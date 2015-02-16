<script>
	$(function() {
    	$( "#accordion" ).accordion({
      		collapsible: true,
      		active: false,
      		heightStyle: "content"
    	});
    	$( "#accordion2" ).accordion({
      		collapsible: true,
      		active: false,
      		heightStyle: "content"
    	});
  	});
	var result;
	$(document).ready(function() {
		hotelList('delHotel');
		cityList('city');
		
		$('#addHotel').submit(function() {
  			return false;
		});
		
		$('#hname').keyup(function(){
			validate("hname","no");
		});
		$('#city').change(function(){
			validate("city","no");
		});
		$('#address').keyup(function(){
			validate("address","no");
		});
		$('#stars').change(function(){
			validate("stars","no");
		});
		$('#roomsInfo').keyup(function(){
			validate("roomsInfo","no");
		});
		$('#email').keyup(function(){
			validate("email","no");
		});
	});
	
	function validate(fieldId,save){
		var name = $('#hname').val();
		var city = $('#city').val();
		var address = $('#address').val();
		var stars = $('#stars').val();
		var roomsInfo = $('#roomsInfo').val();
		var email = $('#email').val();
		$.ajaxSetup({async: false});
		$.post("php/add_hotel.php",	
		 	{name: name,
		 	 city: city,
		 	 address: address,
		 	 stars: stars,
		 	 roomsInfo: roomsInfo,
		 	 email: email,
			 fieldId: fieldId,
			 save: save
			},
			function (data){
				//document.write(data);
				if(data!="0"){
					$('#'+fieldId+'_av').html('<span class="is_not_available">'+data+'<img class="aviability" src="images/not_available.png"></span>');
					result=false;
					return false;
				}
				else{
					$('#'+fieldId+'_av').html('<span class="is_available"><img class="aviability" src="images/available.png"></span>');
					result=true;
					return true;
				}
			});
			$.ajaxSetup({async: true});
		return result;	
	}
	function validateAll(){
		return validate("hname","no") &&
			validate("city","no") &&
			validate("address","no") &&
			validate("stars","no") &&
			validate("roomsInfo","no") &&
			validate("email","no");
	}
	function saveHotel()
	{
		if( validateAll()) {
				if(validate("hinfo","yes"))
				{
					$("#hinfo_av").html('<span class="is_available">Успешно добавихте Хотел:'+$('#hname').val()+','+$('#city').val()+'</span>');
					$('#addHotel').trigger("reset");
					hotelList('delHotel');
				}
				$("#hinfo_av").fadeIn(1, "linear");
				$("#hinfo_av").fadeOut(5600, "linear");
			}
	}
	
	function updateHotel()
	{
		if( validateAll()) {
				if(validate($('#delHotel').val(),"update"))
				{
					$("#hinfo_av").html('<span class="is_available">Успешно променихте Хотел:'+$('#hname').val()+','+$('#city').val()+'</span>');
					$('#addHotel').trigger("reset");
					$(".buttonadd:hidden").show("fast");
					$(".buttonchange:visible").hide("fast");
					hotelList('delHotel');
				}
				$("#hinfo_av").fadeIn(1, "linear");
				$("#hinfo_av").fadeOut(5600, "linear");
			}
	}
	
	function hotelList(method){
		var searchHotel = $('#searchHotel').val();
		
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
	
	function cityList(method){
		
		$.post(
			"php/citylist.php",
			{},
			function (data)
			{
				$('#'+method).html(data);
			}
		);
	
		return false; 
	}
	
	function delete_hotel(){
		if(confirm("Наистина ли искате да изтриете този хотел?")){
			var id = $('#delHotel').val();
			$.post(
				"php/delete_hotel.php",
				{id: id},
				function (data)
				{
					alert(data);
					hotelList('delHotel');
				}
			);
		}
	}
	
	function change_hotel(){
		var id = $('#delHotel').val();
			$.post(
				"php/change_hotel.php",
				{id: id},
				function (data)
				{
					fillForm(data.name,data.city,data.address,data.stars,data.roomsinfo,data.email);
					$(".buttonchange:hidden").show("fast");
					$(".buttonadd:visible").hide("fast");
					$( "#accordion" ).accordion({
      					active: 0
    				});
				}, "json"
			);
		$( "#accordion" ).accordion({
      		active: 0
    	});
	}
	
	function fillForm(name,city,address,stars,roomsInfo,email)
	{
		$('#hname').val(name);
		$('#city').val(city);
		$('#address').val(address);
		$('#stars').val(stars);
		$('#roomsInfo').val(roomsInfo);
		$('#email').val(email);
	}
	function initUpload() {

   	/*set the target of the form to the iframe and display the status
      message on form submit.
  	*/
		$('#deleteHotel').submit(function() {
		document.getElementById('deleteHotel').target = 'target_iframe';
    	document.getElementById('status').style.display="block"; 
		});
	}	

	//This function will be called when the upload completes.
	function uploadComplete(status){
   		//set the status message to that returned by the server
   		$('#status').html(status);
	}

	window.onload=initUpload;
</script>
<div id="accordion">
  <h3>Добави Хотел</h3>
  <div>
    <form id="addHotel" method="post">
	<span id="hinfo_av"></span><br/>
	Име*: <input type="text" name="hname" id="hname" required placeholder="Име на хотела"/><span id='hname_av'></span><br/><hr />
	Град*: <select name="city" id="city" required >
		  </select><span id='city_av'></span><br/><hr />
	Адрес*: <input type="text" name="address" id="address" placeholder="Адрес на хотела"/><span id='address_av'></span><br/><hr />
	Звезди (1-5)*: <input type="number" name="stars" id="stars" min="1" max="5" required/><span id='stars_av'></span><br/><hr />
	<span style="float: left">Стаи:</span> <textarea name="roomsInfo" id="roomsInfo" rows="4" cols="50" placeholder="Информация за стаите на хотела"></textarea><span id='roomsInfo_av'></span><br/><hr />
	Ел. Поща*: <input type="email" name="email" id="email" required  /><span id='email_av'></span><br/><hr />
	<span style="font-size: 12px">* - задължително поле</span>
	<button type="button" class="buttonadd" onclick="saveHotel();">Въведи</button>
	<input type="submit" value="OK" />
	<button type="button" class="buttonchange" onclick="updateHotel();">Промени</button>
	
</form>
  </div>
  <h3>Изтрии/Промени Хотел</h3>
  <div>
   <form method="post" action="php/upload_photo.php" enctype="multipart/form-data" class="well-home span6 form-horizontal" name="deleteHotel" id="deleteHotel">  
           <input type="text" id="searchHotel" class="searchfield">  
           <button type="button" class="btn btn-success" onclick="hotelList('delHotel');">Търси</button><br/>
           <select name="delHotel" id="delHotel" required size="5"></select>
           <button type="button" class="btn btn-success" onclick="delete_hotel();">Изтрии</button>
           <button type="button" class="btn btn-success" onclick="change_hotel();">Промени</button><br /><hr />
           <span style="font-size: 16px; font-weight: bold;">Въведи/Промени снимка (първо изберете хотел от горния списък):</span><br />
           <input name="file" id="file" size="27" type="file" /><br />
			<input type="submit" class="btn btn-success" name="action" value="Качи" />
			<span id="status" style="display:none">Качване...</span>
			<iframe id="target_iframe" name="target_iframe" src="" style="width:0;height:0;border:0px"></iframe>
	</form> 
	
	
 </div>  
  </div>

