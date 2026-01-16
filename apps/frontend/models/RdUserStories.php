<?php
use Phalcon\ModelBase;

class RdUserStories extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rdusst_id;

	/**
	 * @Column(column='projet_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rdusst_projet_id;

	/**
	 * @Column(column='epic_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $rdusst_epic_id;

	/**
	 * @Column(column='sprint_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $rdusst_sprint_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $rdusst_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $rdusst_description;

	/**
	 * @Column(column='criteres_acceptation', type='', mtype='json', nullable=true)
	 */
	public $rdusst_criteres_acceptation;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='backlog', key='MUL', 'length': 'backlog,todo,in_progress,review,done')
	 */
	public $rdusst_statut;

	/**
	 * @Column(column='points', type='integer', mtype='int', nullable=true)
	 */
	public $rdusst_points;

	/**
	 * @Column(column='priorite', type='', mtype='enum', nullable=false, default='medium', 'length': 'low,medium,high,critical')
	 */
	public $rdusst_priorite;

	/**
	 * @Column(column='responsable_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $rdusst_responsable_id;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $rdusst_ordre;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rdusst_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rdusst_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('rdusst_id', 'RdTasks', 'rdta_user_story_id', array('alias' => 'rd_tasks_user_story_id'));

		$this->belongsTo('rdusst_epic_id', 'RdEpics', 'rdep_id', array('alias' => 'rd_epics_epic_id'));
		$this->belongsTo('rdusst_projet_id', 'RdProjets', 'rdpr_id', array('alias' => 'rd_projets_projet_id'));
		$this->belongsTo('rdusst_responsable_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_id'));
		$this->belongsTo('rdusst_sprint_id', 'RdSprints', 'rdsp_id', array('alias' => 'rd_sprints_sprint_id'));

        $this->setSource('rd_user_stories');
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
            'id' => 'rdusst_id',
			'projet_id' => 'rdusst_projet_id',
			'epic_id' => 'rdusst_epic_id',
			'sprint_id' => 'rdusst_sprint_id',
			'titre' => 'rdusst_titre',
			'description' => 'rdusst_description',
			'criteres_acceptation' => 'rdusst_criteres_acceptation',
			'statut' => 'rdusst_statut',
			'points' => 'rdusst_points',
			'priorite' => 'rdusst_priorite',
			'responsable_id' => 'rdusst_responsable_id',
			'ordre' => 'rdusst_ordre',
			'created_at' => 'rdusst_created_at',
			'updated_at' => 'rdusst_updated_at'
        );
    }

}
