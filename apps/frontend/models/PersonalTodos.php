<?
use Phalcon\ModelBase;

class PersonalTodos extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $peto_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $peto_user_id;

	/**
	 * @Column(column='project_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $peto_project_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $peto_etablissement_id;

	/**
	 * @Column(column='title', type='text', mtype='text', nullable=false)
	 */
	public $peto_title;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $peto_description;

	/**
	 * @Column(column='is_done', type='integer', mtype='tinyint', nullable=false, default='0', key='MUL', 'length': 1)
	 */
	public $peto_is_done;

	/**
	 * @Column(column='done_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $peto_done_at;

	/**
	 * @Column(column='done_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $peto_done_by;

	/**
	 * @Column(column='priority', type='', mtype='enum', nullable=true, default='medium', 'length': 'low,medium,high,urgent')
	 */
	public $peto_priority;

	/**
	 * @Column(column='due_date', type='date', mtype='date', nullable=true, key='MUL')
	 */
	public $peto_due_date;

	/**
	 * @Column(column='due_time', type='time', mtype='time', nullable=true)
	 */
	public $peto_due_time;

	/**
	 * @Column(column='reminder_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $peto_reminder_at;

	/**
	 * @Column(column='position', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $peto_position;

	/**
	 * @Column(column='labels', type='', mtype='json', nullable=true)
	 */
	public $peto_labels;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $peto_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $peto_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('peto_done_by', 'Profiles', 'pr_id', array('alias' => 'profiles_done_by'));
		$this->belongsTo('peto_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('peto_project_id', 'TodoProjects', 'topr_id', array('alias' => 'todo_projects_project_id'));
		$this->belongsTo('peto_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('personal_todos');
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
            'id' => 'peto_id',
			'user_id' => 'peto_user_id',
			'project_id' => 'peto_project_id',
			'etablissement_id' => 'peto_etablissement_id',
			'title' => 'peto_title',
			'description' => 'peto_description',
			'is_done' => 'peto_is_done',
			'done_at' => 'peto_done_at',
			'done_by' => 'peto_done_by',
			'priority' => 'peto_priority',
			'due_date' => 'peto_due_date',
			'due_time' => 'peto_due_time',
			'reminder_at' => 'peto_reminder_at',
			'position' => 'peto_position',
			'labels' => 'peto_labels',
			'created_at' => 'peto_created_at',
			'updated_at' => 'peto_updated_at'
        );
    }

}
