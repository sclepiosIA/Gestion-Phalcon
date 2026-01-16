<?php
use Phalcon\ModelBase;

class Profiles extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pr_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='UNI', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pr_user_id;

	/**
	 * @Column(column='prenom', type='text', mtype='text', nullable=false)
	 */
	public $pr_prenom;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $pr_nom;

	/**
	 * @Column(column='email', type='text', mtype='text', nullable=false, key='MUL')
	 */
	public $pr_email;

	/**
	 * @Column(column='actif', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $pr_actif;

	/**
	 * @Column(column='two_factor_enabled', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $pr_two_factor_enabled;

	/**
	 * @Column(column='preferences', type='', mtype='json', nullable=true)
	 */
	public $pr_preferences;

	/**
	 * @Column(column='linkedin_url', type='text', mtype='text', nullable=true)
	 */
	public $pr_linkedin_url;

	/**
	 * @Column(column='avatar_url', type='text', mtype='text', nullable=true)
	 */
	public $pr_avatar_url;

	/**
	 * @Column(column='fonction', type='text', mtype='text', nullable=true)
	 */
	public $pr_fonction;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pr_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $pr_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('pr_id', 'AiProcessingLog', 'aiprlo_processed_by', array('alias' => 'ai_processing_log_processed_by'));
		$this->hasMany('pr_id', 'AiSuggestedActions', 'aisuac_reviewed_by', array('alias' => 'ai_suggested_actions_reviewed_by'));
		$this->hasMany('pr_id', 'AuthorizedIps', 'auip_created_by', array('alias' => 'authorized_ips_created_by'));
		$this->hasMany('pr_id', 'BlockedIps', 'blip_blocked_by', array('alias' => 'blocked_ips_blocked_by'));
		$this->hasMany('pr_id', 'CustomerActivities', 'cuac_assigned_to', array('alias' => 'customer_activities_assigned_to'));
		$this->hasMany('pr_id', 'CustomerActivities', 'cuac_created_by', array('alias' => 'customer_activities_created_by'));
		$this->hasMany('pr_id', 'DocumentRelations', 'dore_related_profile_id', array('alias' => 'document_relations_related_profile_id'));
		$this->hasMany('pr_id', 'EmailThreads', 'emth_reviewed_by', array('alias' => 'email_threads_reviewed_by'));
		$this->hasMany('pr_id', 'EmailToEtablissementSuggestions', 'emtoetsu_reviewed_by', array('alias' => 'email_to_etablissement_suggestions_reviewed_by'));
		$this->hasMany('pr_id', 'EtablissementUserRoles', 'etusro_assigned_by', array('alias' => 'etablissement_user_roles_assigned_by'));
		$this->hasMany('pr_id', 'EtablissementUsers', 'etus_created_by', array('alias' => 'etablissement_users_created_by'));
		$this->hasMany('pr_id', 'Etablissements', 'et_chef_projet_id', array('alias' => 'etablissements_chef_projet_id'));
		$this->hasMany('pr_id', 'Etablissements', 'et_commercial_id', array('alias' => 'etablissements_commercial_id'));
		$this->hasMany('pr_id', 'Etablissements', 'et_csm_id', array('alias' => 'etablissements_csm_id'));
		$this->hasMany('pr_id', 'FormationEmargements', 'foem_valide_par', array('alias' => 'formation_emargements_valide_par'));
		$this->hasMany('pr_id', 'FormationSessions', 'fose_created_by', array('alias' => 'formation_sessions_created_by'));
		$this->hasMany('pr_id', 'FormationSessions', 'fose_formateur_id', array('alias' => 'formation_sessions_formateur_id'));
		$this->hasMany('pr_id', 'ForumComments', 'foco_modere_par', array('alias' => 'forum_comments_modere_par'));
		$this->hasMany('pr_id', 'ForumPosts', 'fopo_modere_par', array('alias' => 'forum_posts_modere_par'));
		$this->hasMany('pr_id', 'GroupesEtablissements', 'gret_created_by', array('alias' => 'groupes_etablissements_created_by'));
		$this->hasMany('pr_id', 'GroupesEtablissements', 'gret_responsable_commercial_id', array('alias' => 'groupes_etablissements_responsable_commercial_id'));
		$this->hasMany('pr_id', 'GroupesEtablissements', 'gret_responsable_csm_id', array('alias' => 'groupes_etablissements_responsable_csm_id'));
		$this->hasMany('pr_id', 'GroupesEtablissements', 'gret_updated_by', array('alias' => 'groupes_etablissements_updated_by'));
		$this->hasMany('pr_id', 'NotificationsRules', 'noru_created_by', array('alias' => 'notifications_rules_created_by'));
		$this->hasMany('pr_id', 'Partenaires', 'pa_created_by', array('alias' => 'partenaires_created_by'));
		$this->hasMany('pr_id', 'Partenaires', 'pa_responsable_sclepios_id', array('alias' => 'partenaires_responsable_sclepios_id'));
		$this->hasMany('pr_id', 'Partenaires', 'pa_updated_by', array('alias' => 'partenaires_updated_by'));
		$this->hasMany('pr_id', 'PersonalTodos', 'peto_done_by', array('alias' => 'personal_todos_done_by'));
		$this->hasMany('pr_id', 'PersonalTodos', 'peto_user_id', array('alias' => 'personal_todos_user_id'));
		$this->hasMany('pr_id', 'PulseAiResponses', 'puaire_user_id', array('alias' => 'pulse_ai_responses_user_id'));
		$this->hasMany('pr_id', 'PulseAuditLog', 'puaulo_actor_id', array('alias' => 'pulse_audit_log_actor_id'));
		$this->hasMany('pr_id', 'PulseConversationMembers', 'pucome_invited_by', array('alias' => 'pulse_conversation_members_invited_by'));
		$this->hasMany('pr_id', 'PulseConversationMembers', 'pucome_user_id', array('alias' => 'pulse_conversation_members_user_id'));
		$this->hasMany('pr_id', 'PulseConversations', 'puco_archived_by', array('alias' => 'pulse_conversations_archived_by'));
		$this->hasMany('pr_id', 'PulseConversations', 'puco_created_by', array('alias' => 'pulse_conversations_created_by'));
		$this->hasMany('pr_id', 'PulseMessageArchive', 'pumear_deleted_by', array('alias' => 'pulse_message_archive_deleted_by'));
		$this->hasMany('pr_id', 'PulseMessageArchive', 'pumear_restored_by', array('alias' => 'pulse_message_archive_restored_by'));
		$this->hasMany('pr_id', 'PulseMessageTaskLinks', 'pumetali_created_by', array('alias' => 'pulse_message_task_links_created_by'));
		$this->hasMany('pr_id', 'PulseMessages', 'pume_deleted_by', array('alias' => 'pulse_messages_deleted_by'));
		$this->hasMany('pr_id', 'PulseMessages', 'pume_edited_by', array('alias' => 'pulse_messages_edited_by'));
		$this->hasMany('pr_id', 'PulseMessages', 'pume_user_id', array('alias' => 'pulse_messages_user_id'));
		$this->hasMany('pr_id', 'PulsePollVotes', 'pupovo_user_id', array('alias' => 'pulse_poll_votes_user_id'));
		$this->hasMany('pr_id', 'PulsePolls', 'pupo_created_by', array('alias' => 'pulse_polls_created_by'));
		$this->hasMany('pr_id', 'PulsePresence', 'pupr_user_id', array('alias' => 'pulse_presence_user_id'));
		$this->hasMany('pr_id', 'PulseReactions', 'pure_user_id', array('alias' => 'pulse_reactions_user_id'));
		$this->hasMany('pr_id', 'RdProjets', 'rdpr_responsable_id', array('alias' => 'rd_projets_responsable_id'));
		$this->hasMany('pr_id', 'RdTasks', 'rdta_responsable_id', array('alias' => 'rd_tasks_responsable_id'));
		$this->hasMany('pr_id', 'RdUserStories', 'rdusst_responsable_id', array('alias' => 'rd_user_stories_responsable_id'));
		$this->hasMany('pr_id', 'RessourcesDocumentaires', 'redo_created_by', array('alias' => 'ressources_documentaires_created_by'));
		$this->hasMany('pr_id', 'RhAbsences', 'rhab_profile_id', array('alias' => 'rh_absences_profile_id'));
		$this->hasMany('pr_id', 'RhAbsences', 'rhab_validee_par', array('alias' => 'rh_absences_validee_par'));
		$this->hasMany('pr_id', 'RhObjectifsCa', 'rhobca_profile_id', array('alias' => 'rh_objectifs_ca_profile_id'));
		$this->hasMany('pr_id', 'RhSalairesMensuels', 'rhsame_profile_id', array('alias' => 'rh_salaires_mensuels_profile_id'));
		$this->hasMany('pr_id', 'SecurityLogs', 'selo_user_id', array('alias' => 'security_logs_user_id'));
		$this->hasMany('pr_id', 'SupportTicketComments', 'sutico_author_id', array('alias' => 'support_ticket_comments_author_id'));
		$this->hasMany('pr_id', 'SupportTickets', 'suti_assigne_a', array('alias' => 'support_tickets_assigne_a'));
		$this->hasMany('pr_id', 'SupportTickets', 'suti_created_by', array('alias' => 'support_tickets_created_by'));
		$this->hasMany('pr_id', 'Taches', 'ta_completed_by', array('alias' => 'taches_completed_by'));
		$this->hasMany('pr_id', 'Taches', 'ta_responsable_id', array('alias' => 'taches_responsable_id'));
		$this->hasMany('pr_id', 'TachesDocuments', 'tado_uploaded_by', array('alias' => 'taches_documents_uploaded_by'));
		$this->hasMany('pr_id', 'TodoProjectMembers', 'toprme_added_by', array('alias' => 'todo_project_members_added_by'));
		$this->hasMany('pr_id', 'TodoProjectMembers', 'toprme_user_id', array('alias' => 'todo_project_members_user_id'));
		$this->hasMany('pr_id', 'TodoProjects', 'topr_owner_id', array('alias' => 'todo_projects_owner_id'));
		$this->hasMany('pr_id', 'UserEmailAccounts', 'usemac_profile_id', array('alias' => 'user_email_accounts_profile_id'));
		$this->hasMany('pr_id', 'VisioTranscriptionParticipants', 'vitrpa_user_id', array('alias' => 'visio_transcription_participants_user_id'));
		$this->hasMany('pr_id', 'VisioTranscriptionSegments', 'vitrse_user_id', array('alias' => 'visio_transcription_segments_user_id'));
		$this->hasMany('pr_id', 'VisioTranscriptionSessions', 'vitrse_created_by', array('alias' => 'visio_transcription_sessions_created_by'));

		$this->belongsTo('pr_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('profiles');
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
            'id' => 'pr_id',
			'user_id' => 'pr_user_id',
			'prenom' => 'pr_prenom',
			'nom' => 'pr_nom',
			'email' => 'pr_email',
			'actif' => 'pr_actif',
			'two_factor_enabled' => 'pr_two_factor_enabled',
			'preferences' => 'pr_preferences',
			'linkedin_url' => 'pr_linkedin_url',
			'avatar_url' => 'pr_avatar_url',
			'fonction' => 'pr_fonction',
			'created_at' => 'pr_created_at',
			'updated_at' => 'pr_updated_at'
        );
    }

}
