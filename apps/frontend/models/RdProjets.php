<?
use Phalcon\ModelBase;

class RdProjets extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rdpr_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $rdpr_nom;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $rdpr_description;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='actif', 'length': 'actif,en_pause,termine,archive')
	 */
	public $rdpr_statut;

	/**
	 * @Column(column='date_debut', type='date', mtype='date', nullable=true)
	 */
	public $rdpr_date_debut;

	/**
	 * @Column(column='date_fin_prevue', type='date', mtype='date', nullable=true)
	 */
	public $rdpr_date_fin_prevue;

	/**
	 * @Column(column='responsable_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $rdpr_responsable_id;

	/**
	 * @Column(column='couleur', type='text', mtype='text', nullable=true)
	 */
	public $rdpr_couleur;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rdpr_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rdpr_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('rdpr_id', 'RdEpics', 'rdep_projet_id', array('alias' => 'rd_epics_projet_id'));
		$this->hasMany('rdpr_id', 'RdSprints', 'rdsp_projet_id', array('alias' => 'rd_sprints_projet_id'));
		$this->hasMany('rdpr_id', 'RdUserStories', 'rdusst_projet_id', array('alias' => 'rd_user_stories_projet_id'));

		$this->belongsTo('rdpr_responsable_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_id'));

        $this->setSource('rd_projets');
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
            'id' => 'rdpr_id',
			'nom' => 'rdpr_nom',
			'description' => 'rdpr_description',
			'statut' => 'rdpr_statut',
			'date_debut' => 'rdpr_date_debut',
			'date_fin_prevue' => 'rdpr_date_fin_prevue',
			'responsable_id' => 'rdpr_responsable_id',
			'couleur' => 'rdpr_couleur',
			'created_at' => 'rdpr_created_at',
			'updated_at' => 'rdpr_updated_at'
        );
    }

}
