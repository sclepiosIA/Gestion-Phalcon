<?
use Phalcon\ModelBase;

class RdTasks extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rdta_id;

	/**
	 * @Column(column='user_story_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rdta_user_story_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $rdta_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $rdta_description;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='todo', 'length': 'todo,in_progress,done')
	 */
	public $rdta_statut;

	/**
	 * @Column(column='estimation_heures', type='decimal', mtype='decimal', nullable=true, 'length': 5)
	 */
	public $rdta_estimation_heures;

	/**
	 * @Column(column='temps_passe', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 5)
	 */
	public $rdta_temps_passe;

	/**
	 * @Column(column='responsable_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $rdta_responsable_id;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rdta_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rdta_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('rdta_responsable_id', 'Profiles', 'pr_id', array('alias' => 'profiles_responsable_id'));
		$this->belongsTo('rdta_user_story_id', 'RdUserStories', 'rdusst_id', array('alias' => 'rd_user_stories_user_story_id'));

        $this->setSource('rd_tasks');
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
            'id' => 'rdta_id',
			'user_story_id' => 'rdta_user_story_id',
			'titre' => 'rdta_titre',
			'description' => 'rdta_description',
			'statut' => 'rdta_statut',
			'estimation_heures' => 'rdta_estimation_heures',
			'temps_passe' => 'rdta_temps_passe',
			'responsable_id' => 'rdta_responsable_id',
			'created_at' => 'rdta_created_at',
			'updated_at' => 'rdta_updated_at'
        );
    }

}
