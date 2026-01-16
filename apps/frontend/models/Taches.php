<?
use Phalcon\ModelBase;

class Taches extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $ta_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ta_etablissement_id;

	/**
	 * @Column(column='categorie_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'NO ACTION', 'length': 36)
	 */
	public $ta_categorie_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $ta_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $ta_description;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='A faire', 'length': 'A faire,En cours,BloquÃ©,TerminÃ©')
	 */
	public $ta_statut;

	/**
	 * @Column(column='priorite', type='', mtype='enum', nullable=false, default='medium', 'length': 'low,medium,high')
	 */
	public $ta_priorite;

	/**
	 * @Column(column='echeance', type='date', mtype='date', nullable=true)
	 */
	public $ta_echeance;

	/**
	 * @Column(column='date_realisation', type='date', mtype='date', nullable=true)
	 */
	public $ta_date_realisation;

	/**
	 * @Column(column='responsable_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $ta_responsable_id;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $ta_ordre;

	/**
	 * @Column(column='commentaires', type='text', mtype='text', nullable=true)
	 */
	public $ta_commentaires;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ta_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $ta_updated_at;

	/**
	 * @Column(column='completed_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $ta_completed_by;

	/**
	 * @Column(column='pulse_conversation_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $ta_pulse_conversation_id;

	/**
	 * @Column(column='pulse_created_from_message_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $ta_pulse_created_from_message_id;

	/**
	 * @Column(column='last_pulse_update', type='datetime', mtype='datetime', nullable=true)
	 */
	public $ta_last_pulse_update;

	/**
	 * @Column(column='pulse_mention_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $ta_pulse_mention_count;

	/**
	 * @Column(column='groupe_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ta_groupe_id;

	/**
	 * @Column(column='niveau_tache', type='string', mtype='varchar', nullable=false, default='etablissement', 'length': 20)
	 */
	public $ta_niveau_tache;

	/**
	 * @Column(column='updated_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $ta_updated_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('ta_id', 'CalendarEvents', 'caev_tache_id', array('alias' => 'calendar_events_tache_id'));
		$this->hasMany('ta_id', 'DocumentRelations', 'dore_related_tache_id', array('alias' => 'document_relations_related_tache_id'));
		$this->hasMany('ta_id', 'PulseMessageTaskLinks', 'pumetali_task_id', array('alias' => 'pulse_message_task_links_task_id'));
		$this->hasMany('ta_id', 'SupportTickets', 'suti_tache_id', array('alias' => 'support_tickets_tache_id'));
		$this->hasMany('ta_id', 'TachesDocuments', 'tado_tache_id', array('alias' => 'taches_documents_tache_id'));

		$this->belongsTo('ta_categorie_id', 'CategoriesTaches', 'cata_id', array('alias' => 'categories_taches_categorie_id'));
		$this->belongsTo('ta_completed_by', 'Profiles', 'pr_id', array('alias' => 'profiles_completed_by'));
		$this->belongsTo('ta_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('ta_groupe_id', 'GroupesEtablissements', 'gret_id', array('alias' => 'groupes_etablissements_groupe_id'));
		$this->belongsTo('ta_pulse_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_pulse_conversation_id'));
		$this->belongsTo('ta_responsable_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_id'));
		$this->belongsTo('ta_updated_by', 'Users', 'us_id', array('alias' => 'users_updated_by'));

        $this->setSource('taches');
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
            'id' => 'ta_id',
			'etablissement_id' => 'ta_etablissement_id',
			'categorie_id' => 'ta_categorie_id',
			'titre' => 'ta_titre',
			'description' => 'ta_description',
			'statut' => 'ta_statut',
			'priorite' => 'ta_priorite',
			'echeance' => 'ta_echeance',
			'date_realisation' => 'ta_date_realisation',
			'responsable_id' => 'ta_responsable_id',
			'ordre' => 'ta_ordre',
			'commentaires' => 'ta_commentaires',
			'created_at' => 'ta_created_at',
			'updated_at' => 'ta_updated_at',
			'completed_by' => 'ta_completed_by',
			'pulse_conversation_id' => 'ta_pulse_conversation_id',
			'pulse_created_from_message_id' => 'ta_pulse_created_from_message_id',
			'last_pulse_update' => 'ta_last_pulse_update',
			'pulse_mention_count' => 'ta_pulse_mention_count',
			'groupe_id' => 'ta_groupe_id',
			'niveau_tache' => 'ta_niveau_tache',
			'updated_by' => 'ta_updated_by'
        );
    }

}
