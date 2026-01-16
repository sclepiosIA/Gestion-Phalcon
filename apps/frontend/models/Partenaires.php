<?
use Phalcon\ModelBase;

class Partenaires extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pa_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $pa_nom;

	/**
	 * @Column(column='type_partenaire', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 20)
	 */
	public $pa_type_partenaire;

	/**
	 * @Column(column='sous_type', type='text', mtype='text', nullable=true)
	 */
	public $pa_sous_type;

	/**
	 * @Column(column='adresse', type='text', mtype='longtext', nullable=true)
	 */
	public $pa_adresse;

	/**
	 * @Column(column='code_postal', type='string', mtype='varchar', nullable=true, 'length': 20)
	 */
	public $pa_code_postal;

	/**
	 * @Column(column='ville', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 255)
	 */
	public $pa_ville;

	/**
	 * @Column(column='region', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $pa_region;

	/**
	 * @Column(column='pays', type='string', mtype='varchar', nullable=false, default='France', 'length': 100)
	 */
	public $pa_pays;

	/**
	 * @Column(column='telephone', type='string', mtype='varchar', nullable=true, 'length': 50)
	 */
	public $pa_telephone;

	/**
	 * @Column(column='email', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $pa_email;

	/**
	 * @Column(column='site_web', type='text', mtype='text', nullable=true)
	 */
	public $pa_site_web;

	/**
	 * @Column(column='email_domains', type='', mtype='json', nullable=true)
	 */
	public $pa_email_domains;

	/**
	 * @Column(column='statut_relation', type='string', mtype='varchar', nullable=false, default='actif', key='MUL', 'length': 20)
	 */
	public $pa_statut_relation;

	/**
	 * @Column(column='date_debut_partenariat', type='date', mtype='date', nullable=true)
	 */
	public $pa_date_debut_partenariat;

	/**
	 * @Column(column='date_fin_partenariat', type='date', mtype='date', nullable=true)
	 */
	public $pa_date_fin_partenariat;

	/**
	 * @Column(column='responsable_sclepios_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pa_responsable_sclepios_id;

	/**
	 * @Column(column='engagement_score', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $pa_engagement_score;

	/**
	 * @Column(column='dernier_contact', type='date', mtype='date', nullable=true)
	 */
	public $pa_dernier_contact;

	/**
	 * @Column(column='prochaine_action', type='date', mtype='date', nullable=true)
	 */
	public $pa_prochaine_action;

	/**
	 * @Column(column='valeur_partenariat', type='decimal', mtype='decimal', nullable=true, 'length': 12)
	 */
	public $pa_valeur_partenariat;

	/**
	 * @Column(column='notes', type='text', mtype='longtext', nullable=true)
	 */
	public $pa_notes;

	/**
	 * @Column(column='tags', type='', mtype='json', nullable=true)
	 */
	public $pa_tags;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pa_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $pa_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pa_created_by;

	/**
	 * @Column(column='updated_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pa_updated_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('pa_id', 'EmailThreads', 'emth_partenaire_id', array('alias' => 'email_threads_partenaire_id'));
		$this->hasMany('pa_id', 'PartenairesContacts', 'paco_partenaire_id', array('alias' => 'partenaires_contacts_partenaire_id'));
		$this->hasMany('pa_id', 'SupportTickets', 'suti_partenaire_id', array('alias' => 'support_tickets_partenaire_id'));

		$this->belongsTo('pa_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('pa_responsable_sclepios_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_sclepios_id'));
		$this->belongsTo('pa_updated_by', 'Profiles', 'pr_id', array('alias' => 'profiles_updated_by'));

        $this->setSource('partenaires');
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
            'id' => 'pa_id',
			'nom' => 'pa_nom',
			'type_partenaire' => 'pa_type_partenaire',
			'sous_type' => 'pa_sous_type',
			'adresse' => 'pa_adresse',
			'code_postal' => 'pa_code_postal',
			'ville' => 'pa_ville',
			'region' => 'pa_region',
			'pays' => 'pa_pays',
			'telephone' => 'pa_telephone',
			'email' => 'pa_email',
			'site_web' => 'pa_site_web',
			'email_domains' => 'pa_email_domains',
			'statut_relation' => 'pa_statut_relation',
			'date_debut_partenariat' => 'pa_date_debut_partenariat',
			'date_fin_partenariat' => 'pa_date_fin_partenariat',
			'responsable_sclepios_id' => 'pa_responsable_sclepios_id',
			'engagement_score' => 'pa_engagement_score',
			'dernier_contact' => 'pa_dernier_contact',
			'prochaine_action' => 'pa_prochaine_action',
			'valeur_partenariat' => 'pa_valeur_partenariat',
			'notes' => 'pa_notes',
			'tags' => 'pa_tags',
			'created_at' => 'pa_created_at',
			'updated_at' => 'pa_updated_at',
			'created_by' => 'pa_created_by',
			'updated_by' => 'pa_updated_by'
        );
    }

}
