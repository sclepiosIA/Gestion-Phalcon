<?
use Phalcon\ModelBase;

class RdSprints extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rdsp_id;

	/**
	 * @Column(column='projet_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rdsp_projet_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $rdsp_nom;

	/**
	 * @Column(column='numero', type='integer', mtype='int', nullable=false)
	 */
	public $rdsp_numero;

	/**
	 * @Column(column='date_debut', type='date', mtype='date', nullable=false)
	 */
	public $rdsp_date_debut;

	/**
	 * @Column(column='date_fin', type='date', mtype='date', nullable=false)
	 */
	public $rdsp_date_fin;

	/**
	 * @Column(column='objectif', type='text', mtype='text', nullable=true)
	 */
	public $rdsp_objectif;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='planifie', key='MUL', 'length': 'planifie,actif,termine,annule')
	 */
	public $rdsp_statut;

	/**
	 * @Column(column='velocity_prevue', type='integer', mtype='int', nullable=true)
	 */
	public $rdsp_velocity_prevue;

	/**
	 * @Column(column='velocity_reelle', type='integer', mtype='int', nullable=true)
	 */
	public $rdsp_velocity_reelle;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rdsp_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rdsp_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('rdsp_id', 'RdUserStories', 'rdusst_sprint_id', array('alias' => 'rd_user_stories_sprint_id'));

		$this->belongsTo('rdsp_projet_id', 'RdProjets', 'rdpr_id', array('alias' => 'rd_projets_projet_id'));

        $this->setSource('rd_sprints');
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
            'id' => 'rdsp_id',
			'projet_id' => 'rdsp_projet_id',
			'nom' => 'rdsp_nom',
			'numero' => 'rdsp_numero',
			'date_debut' => 'rdsp_date_debut',
			'date_fin' => 'rdsp_date_fin',
			'objectif' => 'rdsp_objectif',
			'statut' => 'rdsp_statut',
			'velocity_prevue' => 'rdsp_velocity_prevue',
			'velocity_reelle' => 'rdsp_velocity_reelle',
			'created_at' => 'rdsp_created_at',
			'updated_at' => 'rdsp_updated_at'
        );
    }

}
