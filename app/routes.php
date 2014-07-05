<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/hello', function()
{
	return View::make('hello');
});

Route::controller('/admin', 'AdminController');

Route::get('/list', function()
{
	return View::make('list');
});



// Show submit-order page
Route::get('/submit-order', function()
{
	return View::make('order/order-submit');
});
// Mange order data and put it in database
Route::post('/submit-order', function()
{
	$name = Input::get('name');
	$address = Input::get('address');
	$phone = Input::get('phone');

	$totalPrice = Input::get('totalPrice');
	$cart = json_decode(Input::get('cart'));

	$data = array(
		'name' => $name,
		'address' => $address,
		'phone' => $phone);

	$rules = array(
		'name' => 'required',
		'address' => 'required',
		'phone' => 'required|phone');

	$messages = array(
		'name.required' => 'จำเป็นต้งใส่ผู้สั่งสินค้า',
		'address.required' => 'จำเป็นต้องใส่ที่อยู่ในการจัดส่งสินค้า',
		'phone.required' => 'จำเป็นต้องใส่หมาบเลขโทรศัพท์',
		'phone.phone' => 'กรุณาใส่หมายเลขโทรศัพท์ในรูปแบบ 0XX-XXXXXXX',
	);

	$validator = Validator::make($data, $rules, $messages);

	if($validator->fails()){
		return Redirect::back()->withErrors($validator)->withInput();
	}

	$digits = 4;

	$gencode = "RIN" . rand(pow(10, $digits-1), pow(10, $digits)-1);
	$temp = DB::table('order')->where('order_code', $gencode)->first();
	while(!is_null($temp))
	{
		$gencode = "RIN" . rand(pow(10, $digits-1), pow(10, $digits)-1);
		$temp = DB::table('order')->where('order_code', $gencode)->first();
	}
	// var_dump(json_encode($cart));
	DB::table('order')->insert(
		array(	'name'=> $name,
				'order_code' => $gencode,
				'address' => $address,
				'phone' => $phone,
				'order' => json_encode($cart),
				'total_price' => $totalPrice,
				'seen' => false,
				'transfer' => false,
				'confirm' => false));
	//------- Unset Cart ----------
	setcookie('cart', null);

	return Redirect::to('order-details/' . $gencode)->with('message', 'ยืนยันการสั่งซื้อเรียบร้อย หากทำการโอนเงินแล้วยืนยันการโองเงินด้านล่าง <b>หากต้องการยืนยันภายหลัง ให้ไปที่หน้าค้นหาแล้วพิมพ์รหัสการสั่งซื้อลงไปเมื่อท่านต้องการยืนยัน</b> ');
	

});

Route::get('order-details/{id}', function($id)
{
	return View::make('order/order-details')->with(array('id'=>$id));
});


Route::post('confirm-transfer', function()
{
	$order_code = Input::get('order-id');

	$sent_from = Input::get('send-from-bank');
	$sent_to = Input::get('send-to-bank');
	$amount = Input::get("amount");
	$date = Input::get("date");
	$time = Input::get("time");
	$picture = Input::file("picture");

	$data = array(
		'sent_from' => $sent_from,
		'sent_to' => $sent_to,
		'amount' => $amount,
		'date' => $date,
		'time' => $time,
		'picture' => $picture);

	$destinationPath = 'upload/transfer/';

	$rules = array(
		'sent_from' => 'required',
		'sent_to' => 'required',
		'amount' => 'numeric|required',
		'date' => 'date|required',
		'time' => 'required',
		'picture' => 'image');

	$messages = array(
		'sent_from.required' => "กรุณาเลือกธนาคารที่โอนมา",
		'sent_to.required' => "กรุณาเลือกธนาคารปลายทาง",
		'amount.required' => "กรุณาใส่จำนวนเงินที่โอนมา",
		'amount.numeric' => "กรุณาใส่จำนวนเงินเป็นตัวเลข",
		'date.date' => "กรุณาเลือกวันที่ให้ถูกต้อง",
		'date.required' => "กรุณาเลือกวันที่",
		'picture.image' => "กรุณาเลือกไฟล์ที่เป็นรูปภาพ",
		'time.required' => "กรุณาใส่เวลาที่ทำการโอน");

	$validator = Validator::make($data, $rules, $messages);

	if($validator->fails()){
		return Response::json([
			'success'=> false, 
			'error' => $validator->errors()->toArray()]);
	}


	$order_id = Input::get('order'); // In format of number
	$order_code = Input::get('order_code'); // In format of RINXXXX

	if(!is_null($picture)) {
		$file_name = $order_code . '.' . $picture->getClientOriginalExtension();
		$upload_success = $picture->move($destinationPath, $file_name);		
		$picture_url = URL::to('') . '/' . $destinationPath . $file_name;
	} else 
		$picture_url = "";




	DB::table('confirm-transfer')->insert(
		array( 'sent_from' => $sent_from,
			   'sent_to' => $sent_to,
			   'order_id' => $order_id,
			   'amount' => $amount,
			   'picture_url' => $picture_url,
			   'date' => $date,
			   'time' => $time));


	DB::table('order')
		->where('id', $order_id)
		->update(
			array('transfer' => 1));

	return Response::json(['success' => true, 'debug' => $picture]);



});

Route::get('search-order', function()
{
	return View::make('order/order-details');
});

//Return order details in JSON file
Route::get('get-order-details/{id}', function($id)
{
	$details = DB::table('order')->where('order_code', $id)->get();
	return json_encode($details);
});

//Return bank account in JSON file
Route::get('get-bank-account', function()
{
	$bank = DB::table('bank-account')->get();
	return json_encode($bank);
});

//Return bank name in JSON file
Route::get('get-bank-name', function()
{
	$bank = DB::table('bank')->get();
	return json_encode($bank);
});



// Validator for PHONE
Validator::extend('phone', function($attribute, $value, $parameters)
{
    return preg_match("/^[0-9]{3}-[0-9]{7}$/", $value);
});