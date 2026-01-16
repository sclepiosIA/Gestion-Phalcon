<?
use Phalcon\ModelBase;

class TodoProjects extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $topr_id;

	/**
	 * @Column(column='owner_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $topr_owner_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $topr_name;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $topr_description;

	/**
	 * @Column(column='color', type='text', mtype='text', nullable=true)
	 */
	public $topr_color;

	/**
	 * @Column(column='icon', type='text', mtype='text', nullable=true)
	 */
	public $topr_icon;

	/**
	 * @Column(column='is_shared', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $topr_is_shared;

	/**
	 * @Column(column='position', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $topr_position;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $topr_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $topr_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('topr_id', 'PersonalTodos', 'peto_project_id', array('alias' => 'personal_todos_project_id'));
		$this->hasMany('topr_id', 'TodoProjectMembers', 'toprme_project_id', array('alias' => 'todo_project_members_project_id'));

		$this->belongsTo('topr_owner_id', 'Profiles', 'pr_id', array('alias' => 'profiles_owner_id'));

        $this->setSource('todo_projects');
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
            'id' => 'topr_id',
			'owner_id' => 'topr_owner_id',
			'name' => 'topr_name',
			'description' => 'topr_description',
			'color' => 'topr_color',
			'icon' => 'topr_icon',
			'is_shared' => 'topr_is_shared',
			'position' => 'topr_position',
			'created_at' => 'topr_created_at',
			'updated_at' => 'topr_updated_at'
        );
    }

}
