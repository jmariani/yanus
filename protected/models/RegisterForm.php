<?php

Yii::import('application.models._base.BaseRegisterForm');

class RegisterForm extends BaseRegisterForm
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}