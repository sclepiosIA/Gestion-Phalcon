<?php
use Phalcon\ModelBase;

class EmailThreads extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emth_id;

	/**
	 * @Column(column='user_email_account_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $emth_user_email_account_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emth_etablissement_id;

	/**
	 * @Column(column='thread_id', type='text', mtype='text', nullable=false)
	 */
	public $emth_thread_id;

	/**
	 * @Column(column='subject', type='text', mtype='text', nullable=false)
	 */
	public $emth_subject;

	/**
	 * @Column(column='participants', type='', mtype='json', nullable=false)
	 */
	public $emth_participants;

	/**
	 * @Column(column='last_message_date', type='datetime', mtype='datetime', nullable=false, key='MUL')
	 */
	public $emth_last_message_date;

	/**
	 * @Column(column='message_count', type='integer', mtype='int', nullable=false, default='1')
	 */
	public $emth_message_count;

	/**
	 * @Column(column='unread_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $emth_unread_count;

	/**
	 * @Column(column='ai_summary', type='text', mtype='text', nullable=true)
	 */
	public $emth_ai_summary;

	/**
	 * @Column(column='ai_extracted_data', type='', mtype='json', nullable=true)
	 */
	public $emth_ai_extracted_data;

	/**
	 * @Column(column='ai_confidence_score', type='decimal', mtype='decimal', nullable=true, 'length': 3)
	 */
	public $emth_ai_confidence_score;

	/**
	 * @Column(column='ai_last_processed_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $emth_ai_last_processed_at;

	/**
	 * @Column(column='category', type='text', mtype='text', nullable=true)
	 */
	public $emth_category;

	/**
	 * @Column(column='priority', type='', mtype='enum', nullable=true, 'length': 'low,medium,high')
	 */
	public $emth_priority;

	/**
	 * @Column(column='auto_created_etablissement', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $emth_auto_created_etablissement;

	/**
	 * @Column(column='needs_manual_review', type='integer', mtype='tinyint', nullable=true, default='0', key='MUL', 'length': 1)
	 */
	public $emth_needs_manual_review;

	/**
	 * @Column(column='reviewed_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emth_reviewed_by;

	/**
	 * @Column(column='reviewed_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $emth_reviewed_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emth_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $emth_updated_at;

	/**
	 * @Column(column='groupe_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emth_groupe_id;

	/**
	 * @Column(column='partenaire_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emth_partenaire_id;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('emth_id', 'AiProcessingLog', 'aiprlo_email_thread_id', array('alias' => 'ai_processing_log_email_thread_id'));
		$this->hasMany('emth_id', 'AiSuggestedActions', 'aisuac_email_thread_id', array('alias' => 'ai_suggested_actions_email_thread_id'));
		$this->hasMany('emth_id', 'DocumentRelations', 'dore_related_email_thread_id', array('alias' => 'document_relations_related_email_thread_id'));
		$this->hasMany('emth_id', 'EmailMessageIdRegistry', 'emmeidre_source_thread_id', array('alias' => 'email_message_id_registry_source_thread_id'));
		$this->hasMany('emth_id', 'EmailMessages', 'emme_thread_id', array('alias' => 'email_messages_thread_id'));
		$this->hasMany('emth_id', 'EmailToEtablissementSuggestions', 'emtoetsu_email_thread_id', array('alias' => 'email_to_etablissement_suggestions_email_thread_id'));
		$this->hasMany('emth_id', 'SupportTickets', 'suti_email_thread_id', array('alias' => 'support_tickets_email_thread_id'));

		$this->belongsTo('emth_user_email_account_id', 'UserEmailAccounts', 'usemac_id', array('alias' => 'user_email_accounts_user_email_account_id'));
		$this->belongsTo('emth_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('emth_groupe_id', 'GroupesEtablissements', 'gret_id', array('alias' => 'groupes_etablissements_groupe_id'));
		$this->belongsTo('emth_partenaire_id', 'Partenaires', 'pa_id', array('alias' => 'partenaires_partenaire_id'));
		$this->belongsTo('emth_reviewed_by', 'Profiles', 'pr_id', array('alias' => 'profiles_reviewed_by'));

        $this->setSource('email_threads');
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
            'id' => 'emth_id',
			'user_email_account_id' => 'emth_user_email_account_id',
			'etablissement_id' => 'emth_etablissement_id',
			'thread_id' => 'emth_thread_id',
			'subject' => 'emth_subject',
			'participants' => 'emth_participants',
			'last_message_date' => 'emth_last_message_date',
			'message_count' => 'emth_message_count',
			'unread_count' => 'emth_unread_count',
			'ai_summary' => 'emth_ai_summary',
			'ai_extracted_data' => 'emth_ai_extracted_data',
			'ai_confidence_score' => 'emth_ai_confidence_score',
			'ai_last_processed_at' => 'emth_ai_last_processed_at',
			'category' => 'emth_category',
			'priority' => 'emth_priority',
			'auto_created_etablissement' => 'emth_auto_created_etablissement',
			'needs_manual_review' => 'emth_needs_manual_review',
			'reviewed_by' => 'emth_reviewed_by',
			'reviewed_at' => 'emth_reviewed_at',
			'created_at' => 'emth_created_at',
			'updated_at' => 'emth_updated_at',
			'groupe_id' => 'emth_groupe_id',
			'partenaire_id' => 'emth_partenaire_id'
        );
    }

}
