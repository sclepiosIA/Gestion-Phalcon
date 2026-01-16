<?php
use Phalcon\ModelBase;

class Etablissements extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $et_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $et_nom;

	/**
	 * @Column(column='type', type='', mtype='enum', nullable=false, 'length': 'CHU,CH,Clinique,EHPAD,Autre')
	 */
	public $et_type;

	/**
	 * @Column(column='ville', type='text', mtype='text', nullable=false)
	 */
	public $et_ville;

	/**
	 * @Column(column='region', type='text', mtype='text', nullable=false)
	 */
	public $et_region;

	/**
	 * @Column(column='adresse', type='text', mtype='text', nullable=true)
	 */
	public $et_adresse;

	/**
	 * @Column(column='code_postal', type='text', mtype='text', nullable=true)
	 */
	public $et_code_postal;

	/**
	 * @Column(column='telephone', type='text', mtype='text', nullable=true)
	 */
	public $et_telephone;

	/**
	 * @Column(column='email', type='text', mtype='text', nullable=true)
	 */
	public $et_email;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='Contractuel', 'length': 'Contractuel,ConformitÃ©,DÃ©ploiement,Formation,Go-Live,Production,Suspendu')
	 */
	public $et_statut;

	/**
	 * @Column(column='date_signature', type='date', mtype='date', nullable=false)
	 */
	public $et_date_signature;

	/**
	 * @Column(column='date_fin_contrat', type='date', mtype='date', nullable=true)
	 */
	public $et_date_fin_contrat;

	/**
	 * @Column(column='type_offre', type='text', mtype='text', nullable=true)
	 */
	public $et_type_offre;

	/**
	 * @Column(column='nombre_licences', type='integer', mtype='int', nullable=true)
	 */
	public $et_nombre_licences;

	/**
	 * @Column(column='progression', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 5)
	 */
	public $et_progression;

	/**
	 * @Column(column='commercial_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $et_commercial_id;

	/**
	 * @Column(column='chef_projet_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $et_chef_projet_id;

	/**
	 * @Column(column='csm_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $et_csm_id;

	/**
	 * @Column(column='notes', type='text', mtype='text', nullable=true)
	 */
	public $et_notes;

	/**
	 * @Column(column='latitude', type='decimal', mtype='decimal', nullable=true, 'length': 10)
	 */
	public $et_latitude;

	/**
	 * @Column(column='longitude', type='decimal', mtype='decimal', nullable=true, 'length': 11)
	 */
	public $et_longitude;

	/**
	 * @Column(column='derniers_echanges_resume', type='text', mtype='text', nullable=true)
	 */
	public $et_derniers_echanges_resume;

	/**
	 * @Column(column='derniers_echanges_updated_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $et_derniers_echanges_updated_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $et_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $et_updated_at;

	/**
	 * @Column(column='updated_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $et_updated_by;

	/**
	 * @Column(column='email_domains', type='', mtype='json', nullable=true)
	 */
	public $et_email_domains;

	/**
	 * @Column(column='relationship_status', type='string', mtype='varchar', nullable=false, default='prospect', key='MUL', 'length': 30)
	 */
	public $et_relationship_status;

	/**
	 * @Column(column='last_email_received_at', type='datetime', mtype='datetime', nullable=true, key='MUL')
	 */
	public $et_last_email_received_at;

	/**
	 * @Column(column='last_email_sent_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $et_last_email_sent_at;

	/**
	 * @Column(column='engagement_score', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $et_engagement_score;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('et_id', 'AiSuggestedActions', 'aisuac_etablissement_id', array('alias' => 'ai_suggested_actions_etablissement_id'));
		$this->hasMany('et_id', 'CalendarEvents', 'caev_etablissement_id', array('alias' => 'calendar_events_etablissement_id'));
		$this->hasMany('et_id', 'Contacts', 'co_etablissement_id', array('alias' => 'contacts_etablissement_id'));
		$this->hasMany('et_id', 'CustomerActivities', 'cuac_etablissement_id', array('alias' => 'customer_activities_etablissement_id'));
		$this->hasOne('et_id', 'CustomerHealthMetrics', 'cuheme_etablissement_id', array('alias' => 'customer_health_metrics_etablissement_id'));
		$this->hasMany('et_id', 'DocumentFolders', 'dofo_related_etablissement_id', array('alias' => 'document_folders_related_etablissement_id'));
		$this->hasMany('et_id', 'DocumentRelations', 'dore_related_etablissement_id', array('alias' => 'document_relations_related_etablissement_id'));
		$this->hasMany('et_id', 'EmailDomainMappings', 'emdoma_etablissement_id', array('alias' => 'email_domain_mappings_etablissement_id'));
		$this->hasMany('et_id', 'EmailThreads', 'emth_etablissement_id', array('alias' => 'email_threads_etablissement_id'));
		$this->hasMany('et_id', 'EmailToEtablissementSuggestions', 'emtoetsu_suggested_etablissement_id', array('alias' => 'email_to_etablissement_suggestions_suggested_etablissement_id'));
		$this->hasMany('et_id', 'EnquetesSatisfactionSolution', 'ensaso_etablissement_id', array('alias' => 'enquetes_satisfaction_solution_etablissement_id'));
		$this->hasMany('et_id', 'EtablissementUsers', 'etus_etablissement_id', array('alias' => 'etablissement_users_etablissement_id'));
		$this->hasMany('et_id', 'EtablissementsGroupes', 'etgr_etablissement_id', array('alias' => 'etablissements_groupes_etablissement_id'));
		$this->hasMany('et_id', 'FormationSessions', 'fose_etablissement_id', array('alias' => 'formation_sessions_etablissement_id'));
		$this->hasMany('et_id', 'ForumPosts', 'fopo_etablissement_id', array('alias' => 'forum_posts_etablissement_id'));
		$this->hasMany('et_id', 'PersonalTodos', 'peto_etablissement_id', array('alias' => 'personal_todos_etablissement_id'));
		$this->hasMany('et_id', 'PulseConversations', 'puco_etablissement_id', array('alias' => 'pulse_conversations_etablissement_id'));
		$this->hasMany('et_id', 'SupportTickets', 'suti_etablissement_id', array('alias' => 'support_tickets_etablissement_id'));
		$this->hasMany('et_id', 'Taches', 'ta_etablissement_id', array('alias' => 'taches_etablissement_id'));
		$this->hasMany('et_id', 'VisioTranscriptionSessions', 'vitrse_etablissement_id', array('alias' => 'visio_transcription_sessions_etablissement_id'));

		$this->belongsTo('et_chef_projet_id', 'Profiles', 'pr_id', array('alias' => 'profiles_chef_projet_id'));
		$this->belongsTo('et_commercial_id', 'Profiles', 'pr_id', array('alias' => 'profiles_commercial_id'));
		$this->belongsTo('et_csm_id', 'Profiles', 'pr_id', array('alias' => 'profiles_csm_id'));
		$this->belongsTo('et_updated_by', 'Users', 'us_id', array('alias' => 'users_updated_by'));

        $this->setSource('etablissements');
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
            'id' => 'et_id',
			'nom' => 'et_nom',
			'type' => 'et_type',
			'ville' => 'et_ville',
			'region' => 'et_region',
			'adresse' => 'et_adresse',
			'code_postal' => 'et_code_postal',
			'telephone' => 'et_telephone',
			'email' => 'et_email',
			'statut' => 'et_statut',
			'date_signature' => 'et_date_signature',
			'date_fin_contrat' => 'et_date_fin_contrat',
			'type_offre' => 'et_type_offre',
			'nombre_licences' => 'et_nombre_licences',
			'progression' => 'et_progression',
			'commercial_id' => 'et_commercial_id',
			'chef_projet_id' => 'et_chef_projet_id',
			'csm_id' => 'et_csm_id',
			'notes' => 'et_notes',
			'latitude' => 'et_latitude',
			'longitude' => 'et_longitude',
			'derniers_echanges_resume' => 'et_derniers_echanges_resume',
			'derniers_echanges_updated_at' => 'et_derniers_echanges_updated_at',
			'created_at' => 'et_created_at',
			'updated_at' => 'et_updated_at',
			'updated_by' => 'et_updated_by',
			'email_domains' => 'et_email_domains',
			'relationship_status' => 'et_relationship_status',
			'last_email_received_at' => 'et_last_email_received_at',
			'last_email_sent_at' => 'et_last_email_sent_at',
			'engagement_score' => 'et_engagement_score'
        );
    }

}
