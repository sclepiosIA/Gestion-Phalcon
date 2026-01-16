<?php
use Phalcon\ModelBase;

class SupportTickets extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $suti_id;

	/**
	 * @Column(column='numero_ticket', type='string', mtype='varchar', nullable=true, key='UNI', 'length': 30)
	 */
	public $suti_numero_ticket;

	/**
	 * @Column(column='email_thread_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_email_thread_id;

	/**
	 * @Column(column='email_message_id', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $suti_email_message_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_etablissement_id;

	/**
	 * @Column(column='partenaire_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_partenaire_id;

	/**
	 * @Column(column='tache_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_tache_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $suti_titre;

	/**
	 * @Column(column='description', type='text', mtype='longtext', nullable=true)
	 */
	public $suti_description;

	/**
	 * @Column(column='type_probleme', type='string', mtype='varchar', nullable=false, default='autre', 'length': 30)
	 */
	public $suti_type_probleme;

	/**
	 * @Column(column='priorite', type='string', mtype='varchar', nullable=false, default='moyenne', 'length': 20)
	 */
	public $suti_priorite;

	/**
	 * @Column(column='statut', type='string', mtype='varchar', nullable=false, default='nouveau', key='MUL', 'length': 30)
	 */
	public $suti_statut;

	/**
	 * @Column(column='assigne_a', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_assigne_a;

	/**
	 * @Column(column='contact_nom', type='text', mtype='text', nullable=true)
	 */
	public $suti_contact_nom;

	/**
	 * @Column(column='contact_email', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $suti_contact_email;

	/**
	 * @Column(column='contact_telephone', type='string', mtype='varchar', nullable=true, 'length': 50)
	 */
	public $suti_contact_telephone;

	/**
	 * @Column(column='ai_summary', type='text', mtype='longtext', nullable=true)
	 */
	public $suti_ai_summary;

	/**
	 * @Column(column='ai_suggested_solution', type='text', mtype='longtext', nullable=true)
	 */
	public $suti_ai_suggested_solution;

	/**
	 * @Column(column='ai_category', type='string', mtype='varchar', nullable=true, 'length': 100)
	 */
	public $suti_ai_category;

	/**
	 * @Column(column='ai_urgency_score', type='decimal', mtype='decimal', nullable=true, 'length': 3)
	 */
	public $suti_ai_urgency_score;

	/**
	 * @Column(column='date_ouverture', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $suti_date_ouverture;

	/**
	 * @Column(column='date_premiere_reponse', type='datetime', mtype='datetime', nullable=true)
	 */
	public $suti_date_premiere_reponse;

	/**
	 * @Column(column='date_resolution', type='datetime', mtype='datetime', nullable=true)
	 */
	public $suti_date_resolution;

	/**
	 * @Column(column='date_fermeture', type='datetime', mtype='datetime', nullable=true)
	 */
	public $suti_date_fermeture;

	/**
	 * @Column(column='date_derniere_activite', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $suti_date_derniere_activite;

	/**
	 * @Column(column='sla_deadline', type='datetime', mtype='datetime', nullable=true)
	 */
	public $suti_sla_deadline;

	/**
	 * @Column(column='sla_breached', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $suti_sla_breached;

	/**
	 * @Column(column='tags', type='', mtype='json', nullable=true)
	 */
	public $suti_tags;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $suti_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $suti_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $suti_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('suti_id', 'SupportTicketComments', 'sutico_ticket_id', array('alias' => 'support_ticket_comments_ticket_id'));

		$this->belongsTo('suti_assigne_a', 'Profiles', 'pr_id', array('alias' => 'profiles_assigne_a'));
		$this->belongsTo('suti_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('suti_email_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_email_thread_id'));
		$this->belongsTo('suti_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('suti_partenaire_id', 'Partenaires', 'pa_id', array('alias' => 'partenaires_partenaire_id'));
		$this->belongsTo('suti_tache_id', 'Taches', 'ta_id', array('alias' => 'taches_tache_id'));

        $this->setSource('support_tickets');
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
            'id' => 'suti_id',
			'numero_ticket' => 'suti_numero_ticket',
			'email_thread_id' => 'suti_email_thread_id',
			'email_message_id' => 'suti_email_message_id',
			'etablissement_id' => 'suti_etablissement_id',
			'partenaire_id' => 'suti_partenaire_id',
			'tache_id' => 'suti_tache_id',
			'titre' => 'suti_titre',
			'description' => 'suti_description',
			'type_probleme' => 'suti_type_probleme',
			'priorite' => 'suti_priorite',
			'statut' => 'suti_statut',
			'assigne_a' => 'suti_assigne_a',
			'contact_nom' => 'suti_contact_nom',
			'contact_email' => 'suti_contact_email',
			'contact_telephone' => 'suti_contact_telephone',
			'ai_summary' => 'suti_ai_summary',
			'ai_suggested_solution' => 'suti_ai_suggested_solution',
			'ai_category' => 'suti_ai_category',
			'ai_urgency_score' => 'suti_ai_urgency_score',
			'date_ouverture' => 'suti_date_ouverture',
			'date_premiere_reponse' => 'suti_date_premiere_reponse',
			'date_resolution' => 'suti_date_resolution',
			'date_fermeture' => 'suti_date_fermeture',
			'date_derniere_activite' => 'suti_date_derniere_activite',
			'sla_deadline' => 'suti_sla_deadline',
			'sla_breached' => 'suti_sla_breached',
			'tags' => 'suti_tags',
			'created_at' => 'suti_created_at',
			'updated_at' => 'suti_updated_at',
			'created_by' => 'suti_created_by'
        );
    }

}
