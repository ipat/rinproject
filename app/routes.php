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
	return View::make('order-submit');
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
				'report' => false,
				'confirm' => false));
	//------- Unset Cart ----------
	setcookie('cart', null);

	return Redirect::to('order-details/' . $gencode)->with('message', 'ยืนยันการสั่งซื้อเรียบร้อย หากทำการโอนเงินแล้วไปที่หน้า <a href="' . URL::to('') . '/confirm-transfer">ยืนยันการโอนเงิน</a>');
	

});

Route::get('order-details/{id}', function($id)
{
	return View::make('order-details')->with(array('id'=>$id));
});

Route::get('confirm-transfer', function()
{
	return "ยังไม่มีนะจ๊ะ อิอิ";
});

Route::get('search-order', function()
{
	return View::make('search-order');
});

Route::post('search-order', function()
{
	return Redirect::to('order-details/' . Input::get('search', ''));
});


// Validator for PHONE
Validator::extend('phone', function($attribute, $value, $parameters)
{
    return preg_match("/^[0-9]{3}-[0-9]{7}$/", $value);
});