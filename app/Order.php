<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int status
 */
class Order extends Model {

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
			->as('total')
			->withPivot('quantity')
		;

	}

	/**
	 * @return mixed
	 */
	public function getStatus() {

		$status = array(
			'0' => 'новый',
			'10' => 'подтвержден',
			'20' => 'завершен',
		);

		return $status[$this->status];

	}

}
