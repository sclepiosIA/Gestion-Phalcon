<?php
use Phalcon\ModelBase;

class UserEmailAccounts extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $usemac_id;

	/**
	 * @Column(column='profile_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $usemac_profile_id;

	/**
	 * @Column(column='email_address', type='text', mtype='text', nullable=false)
	 */
	public $usemac_email_address;

	/**
	 * @Column(column='provider', type='text', mtype='text', nullable=false)
	 */
	public $usemac_provider;

	/**
	 * @Column(column='encrypted_password', type='text', mtype='text', nullable=false)
	 */
	public $usemac_encrypted_password;

	/**
	 * @Column(column='imap_host', type='text', mtype='text', nullable=false)
	 */
	public $usemac_imap_host;

	/**
	 * @Column(column='imap_port', type='integer', mtype='int', nullable=false, default='993')
	 */
	public $usemac_imap_port;

	/**
	 * @Column(column='imap_use_ssl', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $usemac_imap_use_ssl;

	/**
	 * @Column(column='smtp_host', type='text', mtype='text', nullable=false)
	 */
	public $usemac_smtp_host;

	/**
	 * @Column(column='smtp_port', type='integer', mtype='int', nullable=false, default='465')
	 */
	public $usemac_smtp_port;

	/**
	 * @Column(column='smtp_use_ssl', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $usemac_smtp_use_ssl;

	/**
	 * @Column(column='last_sync_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $usemac_last_sync_at;

	/**
	 * @Column(column='last_uid_synced', type='text', mtype='text', nullable=true)
	 */
	public $usemac_last_uid_synced;

	/**
	 * @Column(column='sync_enabled', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $usemac_sync_enabled;

	/**
	 * @Column(column='is_active', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $usemac_is_active;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $usemac_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $usemac_updated_at;

	/**
	 * @Column(column='is_shared', type='integer', mtype='tinyint', nullable=false, default='0', key='MUL', 'length': 1)
	 */
	public $usemac_is_shared;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('usemac_id', 'EmailMessageIdRegistry', 'emmeidre_source_account_id', array('alias' => 'email_message_id_registry_source_account_id'));
		$this->hasMany('usemac_id', 'EmailThreads', 'emth_user_email_account_id', array('alias' => 'email_threads_user_email_account_id'));

		$this->belongsTo('usemac_profile_id', 'Profiles', 'pr_id', array('alias' => 'profiles_profile_id'));

        $this->setSource('user_email_accounts');
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
            'id' => 'usemac_id',
			'profile_id' => 'usemac_profile_id',
			'email_address' => 'usemac_email_address',
			'provider' => 'usemac_provider',
			'encrypted_password' => 'usemac_encrypted_password',
			'imap_host' => 'usemac_imap_host',
			'imap_port' => 'usemac_imap_port',
			'imap_use_ssl' => 'usemac_imap_use_ssl',
			'smtp_host' => 'usemac_smtp_host',
			'smtp_port' => 'usemac_smtp_port',
			'smtp_use_ssl' => 'usemac_smtp_use_ssl',
			'last_sync_at' => 'usemac_last_sync_at',
			'last_uid_synced' => 'usemac_last_uid_synced',
			'sync_enabled' => 'usemac_sync_enabled',
			'is_active' => 'usemac_is_active',
			'created_at' => 'usemac_created_at',
			'updated_at' => 'usemac_updated_at',
			'is_shared' => 'usemac_is_shared'
        );
    }

}
