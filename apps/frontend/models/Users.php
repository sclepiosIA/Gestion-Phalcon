<?php
use Phalcon\ModelBase;

class Users extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $us_id;

	/**
	 * @Column(column='email', type='string', mtype='varchar', nullable=false, key='UNI', 'length': 255)
	 */
	public $us_email;

	/**
	 * @Column(column='password_hash', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $us_password_hash;

	/**
	 * @Column(column='is_active', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $us_is_active;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $us_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $us_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('us_id', 'AiAnalysisLog', 'aianlo_user_id', array('alias' => 'ai_analysis_log_user_id'));
		$this->hasMany('us_id', 'CalendarEvents', 'caev_created_by', array('alias' => 'calendar_events_created_by'));
		$this->hasMany('us_id', 'CalendarShares', 'cash_created_by', array('alias' => 'calendar_shares_created_by'));
		$this->hasMany('us_id', 'CalendarShares', 'cash_shared_with_user_id', array('alias' => 'calendar_shares_shared_with_user_id'));
		$this->hasMany('us_id', 'Calendars', 'ca_owner_id', array('alias' => 'calendars_owner_id'));
		$this->hasMany('us_id', 'Contacts', 'co_updated_by', array('alias' => 'contacts_updated_by'));
		$this->hasMany('us_id', 'DocumentAuditLog', 'doaulo_performed_by', array('alias' => 'document_audit_log_performed_by'));
		$this->hasMany('us_id', 'DocumentFolders', 'dofo_owner_id', array('alias' => 'document_folders_owner_id'));
		$this->hasMany('us_id', 'DocumentRelations', 'dore_created_by', array('alias' => 'document_relations_created_by'));
		$this->hasMany('us_id', 'DocumentShares', 'dosh_shared_by', array('alias' => 'document_shares_shared_by'));
		$this->hasMany('us_id', 'DocumentShares', 'dosh_shared_with_user_id', array('alias' => 'document_shares_shared_with_user_id'));
		$this->hasOne('us_id', 'DocumentStorageQuota', 'dostqu_user_id', array('alias' => 'document_storage_quota_user_id'));
		$this->hasMany('us_id', 'Documents', 'do_created_by', array('alias' => 'documents_created_by'));
		$this->hasMany('us_id', 'Documents', 'do_deleted_by', array('alias' => 'documents_deleted_by'));
		$this->hasMany('us_id', 'EmailDomainMappings', 'emdoma_created_by', array('alias' => 'email_domain_mappings_created_by'));
		$this->hasMany('us_id', 'EmailTemplates', 'emte_created_by', array('alias' => 'email_templates_created_by'));
		$this->hasMany('us_id', 'EtablissementUsers', 'etus_user_id', array('alias' => 'etablissement_users_user_id'));
		$this->hasMany('us_id', 'Etablissements', 'et_updated_by', array('alias' => 'etablissements_updated_by'));
		$this->hasMany('us_id', 'EventAttendees', 'evat_user_id', array('alias' => 'event_attendees_user_id'));
		$this->hasMany('us_id', 'EventReminders', 'evre_user_id', array('alias' => 'event_reminders_user_id'));
		$this->hasMany('us_id', 'InAppNotifications', 'inapno_user_id', array('alias' => 'in_app_notifications_user_id'));
		$this->hasOne('us_id', 'Profiles', 'pr_user_id', array('alias' => 'profiles_user_id'));
		$this->hasMany('us_id', 'ProfilesSecrets', 'prse_user_id', array('alias' => 'profiles_secrets_user_id'));
		$this->hasMany('us_id', 'Taches', 'ta_updated_by', array('alias' => 'taches_updated_by'));
		$this->hasMany('us_id', 'UserOauthConnections', 'usoaco_user_id', array('alias' => 'user_oauth_connections_user_id'));
		$this->hasMany('us_id', 'UserRoles', 'usro_assigned_by', array('alias' => 'user_roles_assigned_by'));
		$this->hasMany('us_id', 'UserRoles', 'usro_user_id', array('alias' => 'user_roles_user_id'));


        $this->setSource('users');
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
            'id' => 'us_id',
			'email' => 'us_email',
			'password_hash' => 'us_password_hash',
			'is_active' => 'us_is_active',
			'created_at' => 'us_created_at',
			'updated_at' => 'us_updated_at'
        );
    }

}
