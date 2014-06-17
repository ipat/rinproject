<?php

class AdminController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('except' => ['getIndex', 'postIndex']));

		// $this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if(Auth::check()) return Redirect::to('admin/dashboard');
		return View::make('admin.login');
	}

	public function postIndex()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if(Auth::attempt(['username' => $username, 'password' => $password]))
		{
			return Redirect::to(URL::to('admin/dashboard'));
		}

		// return var_dump(Auth::attempt(['username' => $username, 'password' => $password])) . var_dump($password);
		return Redirect::back()->withInput()->withErrors('ไม่มีชื่อผู้ใช้ดังกล่าวอยู่ในระบบ');
	}

	public function getDashboard()
	{
		return View::make('admin.dashboard');
	}


	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}

	public function getManagedessert()
	{
		return View::make('admin.dessert.manage');
	}

	public function getAdddessert()
	{
		return View::make('admin.dessert.add');
	}

	public function postAdddessert()
	{
		$name = Input::get('name');
		$description = Input::get('description', '');
		$price = Input::get('price');
		$picture = Input::file('picture');

		$data = array(
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'picture' => $picture
		);

		$destinationPath = 'upload/images/';

		$rules = array(
			'picture' => 'required|image',
			'name' => 'required|unique:dessert',
			'price' => 'numeric|required|min:0' 
		);

		$messages = array(
			'name.required' => 'จำเป็นต้งใส่ชื่อขนม',
			'name.unique' => 'ชื่อต้องไม่ซ้ำกัน',
			'picture.required' => 'จำเป็นต้องเลือกรูปภาพ',
			'picture.image' => 'กรุณาเลือกไฟล์ที่เป็นรูปภาพ',
			'price.required' => 'จำเป็นต้องใส่ราคา',
			'price.numeric' => 'กรุณาใส่ราคาเป็นตัวเลข',
			'price.min' => 'กรุณาใส่ราคาอย่างต่ำ 0 บาท'
		);


		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		DB::table('dessert')->insert(
			array(
				'name' => $name,
				'price' => $price,
				'description' => $description,
				'image_url' => '')
		);

		$id = DB::table('dessert')->where('name', $name)->select('id')->first()->id;
		$file_name = $id . '.' . $picture->getClientOriginalExtension();
		$upload_success = $picture->move($destinationPath, $file_name);
		
		$file_path = URL::to('') . '/' . $destinationPath . $file_name;

		DB::table('dessert')
			->where('id', $id)
			->update(array('image_url'=> $file_path));

		return Redirect::to('admin/managedessert')->with('message', 'เพิ่มขนมหวานเรียบร้อย');


	}

	public function getEditdessert($id)
	{
		return View::make('admin.dessert.edit', array('id' => $id));
	}

	public function postEditdessert($id)
	{
		// $id = Input::get('id');
		$name = Input::get('name');
		$description = Input::get('description', '');
		$price = Input::get('price');
		$picture = Input::file('picture');

		$data = array(
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'picture' => $picture
		);

		$destinationPath = 'upload/images/';

		$rules = array(
			'picture' => 'image',
			'name' => 'required',
			'price' => 'numeric|required|min:0' 
		);

		$messages = array(
			'name.required' => 'จำเป็นต้งใส่ชื่อขนม',
			'picture.image' => 'กรุณาเลือกไฟล์ที่เป็นรูปภาพ',
			'price.required' => 'จำเป็นต้องใส่ราคา',
			'price.numeric' => 'กรุณาใส่ราคาเป็นตัวเลข',
			'price.min' => 'กรุณาใส่ราคาอย่างต่ำ 0 บาท'
		);


		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		DB::table('dessert')->where('id', $id)->update(
			array(
				'name' => $name,
				'price' => $price,
				'description' => $description)
		);

		if(!is_null($picture)){

			$file_name = $id . '.' . $picture->getClientOriginalExtension();
			$upload_success = $picture->move($destinationPath, $file_name);
			
			$file_path = URL::to('') . '/' . $destinationPath . $file_name;

			DB::table('dessert')
				->where('id', $id)
				->update(array('image_url'=> $file_path));
		}

		

		return Redirect::to('admin/managedessert')->with('message', 'แก้ไขขนมหวานเรียบร้อย');

	}

	public function getEarsedessert($id)
	{
		DB::table('dessert')->where('id', $id)->delete();
		return Redirect::to('admin/managedessert')->with('message', 'ลบข้อมูลเรียบร้อย');
	}

	public function getManageorder()
	{
		return View::make('admin.order.manage-order');
	}



}
