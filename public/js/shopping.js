$(document).ready(function() {
	$('.number-item').TouchSpin({
        min: 0,
        max: 100,
        step: 1,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'ชิ้น'
    });

    $(".pop-cart").popover({
		html: true,
		title: 'ตะกร้าสินค้า',
		trigger: 'manual',
		content: getPopCart()
	});

	var popcart = $(".pop-cart").data('bs.popover');

    $(".pop-cart").on('click', function(event) {
    	popcart.options.content = getPopCart();
    	$(".pop-cart").popover('toggle');
    });

    $('body').on('click', function (e) {
	    $('[data-toggle="popover"]').each(function () {
	        //the 'is' for buttons that trigger popups
	        //the 'has' for icons within a button that triggers a popup
	        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            $(this).popover('hide');
	        }
	    });
	});

	
	console.log(JSON.parse($.cookie("cart")));
});

function addToCart(id, name)
{
	// alert(isNumber(amountItem.val()) + " " + $('[name="item'+ id + '"').val());
	if(!isNumber($('[name="item'+ id + '"').val()) || $('[name="item'+ id + '"').val() == 0)
	{
		showMsg('เกิดข้อผิดพลาด', 'ต้องใส่ข้อมูลเป็นตัวเลขที่มากกว่า 0');
		return;
	}
	var tempCart = $.cookie("cart");
	var amountItem = $('[name="item'+ id + '"');
	var amount = Number(amountItem.val());
	// Check if cookie avaliable or not
	if(typeof tempCart !== "undefined" && tempCart !== 'null')
	{
		var cart = JSON.parse($.cookie("cart"));
		var cartSize = Object.size(cart);
		var duplicate = false;
		// Find if some item already in the cart
		$.each(cart, function(index, item) {
			if(item['id'] == id)
			{	
				var temp = item['amount'] + amount;
				item['amount'] = temp;
				duplicate = true;
				showMsg('เพิ่มสินค้าลงตะกร้าเรียบร้อย', 'ทำการเพิ่ม ' + item["name"] + ' จำนวน ' + amount + ' ชื้น รวมเป็น ' + item["amount"] + ' ชิ้น เรียบร้อย');
			}			
		});	
		// Put item that is NOT contained in cart YET!!!
		if(!duplicate)
		{
			cart[cartSize] = {"id": id, "name": name, "amount": amount};
			showMsg('เพิ่มสินค้าลงตะกร้าเรียบร้อย', 'ทำการเพิ่ม ' + cart[cartSize]["name"] + ' จำนวน ' + cart[cartSize]["amount"] + ' ชิ้น เรียบร้อย');
		}
		$.cookie("cart", JSON.stringify(cart));
		amountItem.val("0");
		
	}
	// In case of no cookie has set
	else 
	{
		var cart = {0 :{"id": id, "name": name, "amount": amount}};
		amountItem.val("0");
		$.cookie("cart", JSON.stringify(cart));
		showMsg('เพิ่มสินค้าลงตะกร้าเรียบร้อย', 'ทำการเพิ่ม ' + cart[0]["name"] + ' จำนวน ' + cart[0]["amount"] + ' ชิ้น เรียบร้อย');
	}
	
}

function removeFromCart(id)
{
	var cart = JSON.parse($.cookie("cart"));
	var cartSize = Object.size(cart);
	
	if(cartSize == 1)
	{
		clearCart();
	} else 
	{
		var newCart = {};
		var cart = JSON.parse($.cookie("cart"));
		var found = false;
		$.each(cart, function(index, item) {
			// alert(typeof Number(index) + " id : " + typeof id);
			if(Number(index) !== id && found == false)
			{	
				newCart[index] = {"id": item["id"], "name": item["name"], "amount": item["amount"]};
			} else if(Number(index) === id) {
				found = true;
				console.log('I Found');
			} else {
				newCart[index-1] = {"id": item["id"], "name": item["name"], "amount": item["amount"]};
			}
		});	
		$.cookie("cart", JSON.stringify(newCart));
	}
	showMsg('นำสินค้าออกจากตะกร้า', 'นำสินค้าออกจากตะกร้าเรียบร้อย');

}

function clearCart()
{
	$.cookie("cart", null);
	showMsg('ล้างตะกร้า', 'ทำการล้างตะกร้าเรียบร้อย');
	console.log($.cookie("cart"));
}

function getPopCart()
{
	var content = "";
	
	var tempCart = $.cookie("cart");
	if (typeof tempCart !== "undefined" && tempCart!=='null') 
	{
		content += "<table class='table table-striped'>" ;
		var cart = JSON.parse(tempCart);
		content += "<thead><tr><th>สินค้า</th><th>จำนวน</th><th></th></tr></thead>"
		$.each(cart, function(index, item) {
			content += "<tr><td>" + item["name"] + "</td><td>" + item["amount"] + " ชิ้น</td>";
			content += "<td><span class='red glyphicon glyphicon-remove-circle' onclick='removeFromCart(" + index + ")'></span></td></tr>";
		});
		content += "</table>";
		content += "<a class='btn btn-primary' style='margin-right:0.2em' onclick='redirectToBuy()'>ยืนยันการซื้อ</a>";
		content += "<a class='btn btn-danger' onclick='clearCart()'>ล้างตะกร้า</a>";

	} else {
		content += "ยังมีมีสินค้าในตะกร้า";
	}
	
	;
	return content;
}

function redirectToBuy()
{
	window.location = "submit-order";
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

var $msgModal = $('#infoModal').modal({
  backdrop: true,
  show: false,
  keyboard: false
});

showMsg = function (header, body) {
  $msgModal
    .find('.modal-header > h4').text(header).end()
    .find('.modal-body').html(body).end()
    .modal('show');
};

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
