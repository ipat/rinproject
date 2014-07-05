
var host = window.location.origin + '/rinproject/public';

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

	if($('#order-id').val() != '')
		checkDatabase();

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
			url: host + '/confirm-transfer',
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
			$(".status")
					.empty()
					.append('<div class="alert alert-danger showMsg text-center"><h3>เกิดข้อผิดพลาด</h3></div>');
		});
		
	});


});

function checkDatabase(){
	$.ajax({
		url: host + '/get-order-details/' + $('#order-id').val(),
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
			$(".order")
				.val(order["id"]);
			//Insert Order List
			$(".order-list").find("tr:gt(0)").remove();
			var order_list = $.parseJSON(order["order"]);
			$.each(order_list, function(index, val) {
					$('.order-list tr:last').after('<tr><th>' + val["name"] + '</th><th>' + val['amount'] +'</th><th>'+ val['price'] +' บาท</th><th>' + (val['price'] * val['amount']) +' บาท</th></tr>');
			});
			$('.order-list tr:last').after('<tr class="warning"><th colspan="3">รวมเป็นเงิน</th><th class="amount">' + order["total_price"] + ' บาท</th></tr>');

			//Get Bank Acoount Data
			$.ajax({
				url: host +  '/get-bank-account',
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

			if(order['transfer'] == 0) {
				$(".slide-form").slideDown('400');
				$(".status").empty();
			}
			else {
				$(".status")
					.empty()
					.append('<h3 class="alert alert-success text-center">คุณทำการยืนยันการโอนเงินเรียบร้อยแล้ว</h3>');
				$(".slide-form").slideUp('400');
			}
			
		}
	});

}