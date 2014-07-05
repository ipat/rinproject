$(document).ready(function() {
	
	$('.slide-data').css('display', 'none');
	$('.slide-form').css('display', 'none');
	$('.info').hide();
	$('#order-id').on('input', function(event) {
		if($('#order-id').val().length == 7){
			checkDatabase();
		}
		else {
			$(".check-order").val("");
			$(".check-order").empty().addClass('gray').append('<i class="gray glyphicon glyphicon-refresh"></i> กรุณากรอกให้ครบ');
			$(".slide-data").slideUp('400');
			$(".slide-form").slideUp('400');
		}
	});

	$(window).keydown(function(event){
	    if( (event.keyCode == 13) ) {
	      event.preventDefault();
	      return false;
	    }
	});

	$('form').submit(function(e) {
		e.preventDefault();

		var formData  = new FormData(this);

		$.ajax({
			url: 'confirm-transfer',
			type: 'POST',
			dataType: 'json',
			data: formData,
			cache:false,
            contentType: false,
            processData: false
		})
		.success(function(data) {

			if(data.success == false){
				$(".status")
					.empty()
					.append('<div class="alert alert-danger showMsg"><ul></ul></div>');
				var msg = $(".showMsg");

				$.each(data.error, function(index, error) {
					msg.find('ul').append('<li>'+error+'</li>');
				});
			}
				
			else {
				$(".status")
					.empty()
					.append('<div class="alert alert-success showMsg text-center"><h3>ยืนยันการโอนเงินสำเร็จ</h3></div>');
				$(".slide-form").slideUp('400');
				console.log(data.debug);
			}
				
			
			
		})
		.error(function() {
			console.log("Error");
		});
		
	});


});

function checkDatabase(){
	$.ajax({
		url: 'get-order-details/' + $('#order-id').val(),
		type: 'GET',
		dataType: 'json'
	})
	.done(function(data) {
		if(data == "") {
			$(".check-order").empty().addClass('red').append('<i class="red glyphicon glyphicon-remove-circle"></i> ไม่พบหมายเลข Order นี้');
			$(".slide-data").slideUp('400');
		} else {
			$(".check-order").empty().addClass('green').append('<i class="green glyphicon glyphicon-ok-circle"></i> พบหมายเลข Order');
			order = data[0];
			//ADD Data to DOMs
			$(".name")
				.empty()
				.append(order["name"]);
			$(".order-id")
				.empty()
				.append(order["order_code"]);
			$(".address")
				.empty()
				.append(order["address"]);
			$(".phone")
				.empty()
				.append(order["phone"].substring(0,8) + "XXX");
			$(".amount")
				.empty()
				.append(order["total_price"] + " บาท");
			$(".order")
				.val(order["id"]);

			//Get Bank Acoount Data
			$.ajax({
				url: 'get-bank-account',
				type: 'GET',
				dataType: 'json'
			})
			.done(function(data) {
				$("#send-to-bank").empty();
				$.each(data, function(index, val) {
					$("#send-to-bank")
						.append("<option value='" + val['id'] + "'>" + val['bank_name'] + " - " + val['bank_id'] + "</option>");
				});
				
			});

			$.ajax({
				url: 'get-bank-name',
				type: 'GET',
				dataType: 'json'
			})
			.done(function(data) {
				$("#send-from-bank").empty();
				$.each(data, function(index, val) {
					$("#send-from-bank")
						.append("<option value='" + val['id'] + "'>" + val['bank_name'] + "</option>");
				});
				
			});

			$(".slide-data").slideDown('400');

			if(order['transfer'] == 0)
				$(".slide-form").slideDown('400');
			else 
				$(".status")
					.empty()
					.append('<h3>คุณทำการยืนยันโอนเงินเรียบร้อยแล้ว</h3>');
			
		}
	});

}