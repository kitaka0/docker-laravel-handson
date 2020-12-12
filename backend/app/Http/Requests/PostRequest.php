<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'post_title' => 'required',
			'product_title' => 'required',
		];
	}

	/**
	 * 定義済みバリデーションルールのエラーメッセージ取得
	 *
	 * @return array
	 */
	public function messages()
	{
	  return [
	      'post_title.required' => '記事のタイトルが未入力です',
	      'product_title.required' => '制作物のタイトルが未入力です',
	  ];
	}
}
