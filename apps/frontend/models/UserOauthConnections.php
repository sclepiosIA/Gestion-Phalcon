<?php
use Phalcon\ModelBase;

class UserOauthConnections extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $usoaco_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $usoaco_user_id;

	/**
	 * @Column(column='provider', type='', mtype='enum', nullable=false, 'length': 'google,microsoft,zoom,nextcloud')
	 */
	public $usoaco_provider;

	/**
	 * @Column(column='access_token', type='text', mtype='text', nullable=false)
	 */
	public $usoaco_access_token;

	/**
	 * @Column(column='refresh_token', type='text', mtype='text', nullable=true)
	 */
	public $usoaco_refresh_token;

	/**
	 * @Column(column='token_expires_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $usoaco_token_expires_at;

	/**
	 * @Column(column='provider_email', type='text', mtype='text', nullable=true)
	 */
	public $usoaco_provider_email;

	/**
	 * @Column(column='provider_user_id', type='text', mtype='text', nullable=true)
	 */
	public $usoaco_provider_user_id;

	/**
	 * @Column(column='scopes', type='', mtype='json', nullable=true)
	 */
	public $usoaco_scopes;

	/**
	 * @Column(column='instance_url', type='text', mtype='text', nullable=true)
	 */
	public $usoaco_instance_url;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $usoaco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $usoaco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('usoaco_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('user_oauth_connections');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'id' => 'usoaco_id',
			'user_id' => 'usoaco_user_id',
			'provider' => 'usoaco_provider',
			'access_token' => 'usoaco_access_token',
			'refresh_token' => 'usoaco_refresh_token',
			'token_expires_at' => 'usoaco_token_expires_at',
			'provider_email' => 'usoaco_provider_email',
			'provider_user_id' => 'usoaco_provider_user_id',
			'scopes' => 'usoaco_scopes',
			'instance_url' => 'usoaco_instance_url',
			'created_at' => 'usoaco_created_at',
			'updated_at' => 'usoaco_updated_at'
        );
    }

}
