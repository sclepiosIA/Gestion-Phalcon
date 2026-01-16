<?php
use Phalcon\ModelBase;

class GroupesEtablissements extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $gret_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $gret_nom;

	/**
	 * @Column(column='type', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 50)
	 */
	public $gret_type;

	/**
	 * @Column(column='description', type='text', mtype='longtext', nullable=true)
	 */
	public $gret_description;

	/**
	 * @Column(column='adresse_siege', type='text', mtype='longtext', nullable=true)
	 */
	public $gret_adresse_siege;

	/**
	 * @Column(column='code_postal_siege', type='string', mtype='varchar', nullable=true, 'length': 20)
	 */
	public $gret_code_postal_siege;

	/**
	 * @Column(column='ville_siege', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $gret_ville_siege;

	/**
	 * @Column(column='region', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 255)
	 */
	public $gret_region;

	/**
	 * @Column(column='telephone', type='string', mtype='varchar', nullable=true, 'length': 50)
	 */
	public $gret_telephone;

	/**
	 * @Column(column='email', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $gret_email;

	/**
	 * @Column(column='email_domains', type='', mtype='json', nullable=true)
	 */
	public $gret_email_domains;

	/**
	 * @Column(column='responsable_commercial_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $gret_responsable_commercial_id;

	/**
	 * @Column(column='responsable_csm_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $gret_responsable_csm_id;

	/**
	 * @Column(column='nombre_etablissements', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $gret_nombre_etablissements;

	/**
	 * @Column(column='nombre_licences_total', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $gret_nombre_licences_total;

	/**
	 * @Column(column='progression_moyenne', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 5)
	 */
	public $gret_progression_moyenne;

	/**
	 * @Column(column='notes', type='text', mtype='longtext', nullable=true)
	 */
	public $gret_notes;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $gret_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $gret_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $gret_created_by;

	/**
	 * @Column(column='updated_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $gret_updated_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('gret_id', 'Contacts', 'co_groupe_id', array('alias' => 'contacts_groupe_id'));
		$this->hasMany('gret_id', 'EmailThreads', 'emth_groupe_id', array('alias' => 'email_threads_groupe_id'));
		$this->hasMany('gret_id', 'EtablissementsGroupes', 'etgr_groupe_id', array('alias' => 'etablissements_groupes_groupe_id'));
		$this->hasMany('gret_id', 'Taches', 'ta_groupe_id', array('alias' => 'taches_groupe_id'));

		$this->belongsTo('gret_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('gret_responsable_commercial_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_commercial_id'));
		$this->belongsTo('gret_responsable_csm_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_csm_id'));
		$this->belongsTo('gret_updated_by', 'Profiles', 'pr_id', array('alias' => 'profiles_updated_by'));

        $this->setSource('groupes_etablissements');
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
            'id' => 'gret_id',
			'nom' => 'gret_nom',
			'type' => 'gret_type',
			'description' => 'gret_description',
			'adresse_siege' => 'gret_adresse_siege',
			'code_postal_siege' => 'gret_code_postal_siege',
			'ville_siege' => 'gret_ville_siege',
			'region' => 'gret_region',
			'telephone' => 'gret_telephone',
			'email' => 'gret_email',
			'email_domains' => 'gret_email_domains',
			'responsable_commercial_id' => 'gret_responsable_commercial_id',
			'responsable_csm_id' => 'gret_responsable_csm_id',
			'nombre_etablissements' => 'gret_nombre_etablissements',
			'nombre_licences_total' => 'gret_nombre_licences_total',
			'progression_moyenne' => 'gret_progression_moyenne',
			'notes' => 'gret_notes',
			'created_at' => 'gret_created_at',
			'updated_at' => 'gret_updated_at',
			'created_by' => 'gret_created_by',
			'updated_by' => 'gret_updated_by'
        );
    }

}
