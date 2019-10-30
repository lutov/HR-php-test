<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function list(Request $request) {

		$limit = 25;
		$order = 'id';
		$sort = 'desc';

		$orders = Order::orderBy($order, $sort)->paginate($limit);

		return view('order.list', array(
			'orders' => $orders,
		));

	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function item(Request $request, $id) {

		$order = Order::find($id);

		return view('order.item', array(
			'order' => $order,
		));

	}

}
