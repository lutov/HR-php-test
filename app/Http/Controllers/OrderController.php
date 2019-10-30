<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

		$partners = Partner::all();

		return view('order.item', array(
			'order' => $order,
			'partners' => $partners,
		));

	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return mixed
	 */
	public function save(Request $request, $id) {

		$validatedData = $request->validate([
			'client_email' => 'required',
			'partner_id' => 'required',
			'status' => 'required',
		]);

		$client_email = $request->get('client_email');
		$partner_id = $request->get('partner_id');
		$status = $request->get('status');
		$quantity = $request->get('quantity');

		$order = Order::find($id);
		$order->client_email = $client_email;
		$order->partner_id = $partner_id;
		$order->status = $status;
		$order->save();

		foreach($order->products as $key => $product) {
			$order->products()->updateExistingPivot($product->id, array('quantity' => $quantity[$key]));
		}

		return Redirect::back();

	}

}
