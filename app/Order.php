<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int status
 */
class Order extends Model {

	private $status_list = array(
		'0' => 'новый',
		'10' => 'подтвержден',
		'20' => 'завершен',
	);

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function partner() {

		return $this->belongsTo('App\Partner');

	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products() {

		return $this->belongsToMany('App\Product', 'order_products')
			->as('params')
			->withPivot(array('quantity', 'price'))
		;

	}

	/**
	 * @return array
	 */
	public function getStatusList() {

		return $this->status_list;

	}

	/**
	 * @return mixed
	 */
	public function getStatus() {

		return $this->status_list[$this->status];

	}

}
