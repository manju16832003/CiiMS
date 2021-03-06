<?php

class SocialSettings extends CiiSettingsModel
{
	protected $ha_twitter_enabled = false;
	protected $ha_twitter_key = NULL;
	protected $ha_twitter_secret = NULL;
	protected $ha_twitter_accessToken = NULL;
	protected $ha_twitter_accessTokenSecret = NULL;

	protected $ha_facebook_enabled = false;
	protected $ha_facebook_id = NULL;
	protected $ha_facebook_secret = NULL;
	protected $ha_facebook_scope =  NULL;

	protected $ha_google_enabled = false;
	protected $ha_google_id = NULL;
	protected $ha_google_secret = NULL;
	protected $ha_google_scope = NULL;
	protected $google_plus_public_server_key = NULL;

	protected $ha_linkedin_enabled = false;
	protected $ha_linkedin_key = NULL;
	protected $ha_linkedin_secret = NULL;

	protected $addThisPublisherID = null;

	public function groups()
	{
		return array(
			Yii::t('ciims.models.social', 'Twitter')  => array('ha_twitter_enabled', 'ha_twitter_key', 'ha_twitter_secret', 'ha_twitter_accessToken', 'ha_twitter_accessTokenSecret'),
			Yii::t('ciims.models.social', 'Facebook') => array('ha_facebook_enabled', 'ha_facebook_id', 'ha_facebook_secret', 'ha_facebook_scope'),
			Yii::t('ciims.models.social', 'Google+')  => array('ha_google_enabled', 'ha_google_id', 'ha_google_secret', 'ha_google_scope', 'google_plus_public_server_key'),
			Yii::t('ciims.models.social', 'LinkedIn') => array('ha_linkedin_enabled', 'ha_linkedin_key', 'ha_linkedin_secret'),
			Yii::t('ciims.models.social', 'AddThis') => array('addThisPublisherID')
		);
	}

	public function rules()
	{
		return array(
			array('ha_twitter_key, ha_twitter_secret, ha_twitter_accessToken, ha_twitter_accessToken, ha_twitter_accessTokenSecret', 'length', 'max' => 255),
			array('ha_facebook_id, ha_facebook_secret', 'length', 'max' => 255),
			array('ha_google_id, ha_google_secret, google_plus_public_server_key', 'length', 'max' => 255),
			array('ha_linkedin_key, ha_linkedin_secret', 'length', 'max' => 255),
			array('ha_twitter_enabled, ha_facebook_enabled, ha_google_enabled, ha_linkedin_enabled', 'boolean'),
			array('addThisPublisherID', 'length', 'max' => 255)
		);
	}

	public function attributeLabels()
	{
		return array(
			'ha_twitter_enabled' => Yii::t('ciims.models.social', 'Social Auth'),
			'ha_twitter_key' => Yii::t('ciims.models.social', 'Consumer Key'),
			'ha_twitter_secret' => Yii::t('ciims.models.social', 'Consumer Secret'),
			'ha_twitter_accessToken' => Yii::t('ciims.models.social', 'Access Token'),
			'ha_twitter_accessTokenSecret' => Yii::t('ciims.models.social', 'Access Token Secret'),

			'ha_facebook_enabled' => Yii::t('ciims.models.social', 'Social Auth'),
			'ha_facebook_id' => Yii::t('ciims.models.social', 'App ID'),
			'ha_facebook_secret' => Yii::t('ciims.models.social', 'App Secret'),
			'ha_facebook_scope' => Yii::t('ciims.models.social', 'Scope'),

			'ha_google_enabled' => Yii::t('ciims.models.social', 'Social Auth'),
			'ha_google_id' => Yii::t('ciims.models.social', 'Client ID'),
			'ha_google_secret' => Yii::t('ciims.models.social', 'Client Secret'),
			'ha_google_scope' => Yii::t('ciims.models.social', 'Scope'),
			'google_plus_public_server_key' => Yii::t('ciims.models.social', 'Public Server API Key'),

			'ha_linkedin_enabled' => Yii::t('ciims.models.social', 'Social Auth'),
			'ha_linkedin_key' => Yii::t('ciims.models.social', 'Consumer Key'),
			'ha_linkedin_secret' => Yii::t('ciims.models.social', 'Consumer Secret'),

			'addThisPublisherID' => Yii::t('ciims.models.social', 'AddThis Publisher ID')
		);
	}

	public function afterSave()
	{
		Yii::app()->cache->set('hybridauth_providers', false);
		Cii::getHybridAuthProviders();

		return parent::afterSave();
	}
}
