<?php
use Phalcon\ModelBase;

class TodoProjectMembers extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $toprme_id;

	/**
	 * @Column(column='project_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $toprme_project_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $toprme_user_id;

	/**
	 * @Column(column='role', type='', mtype='enum', nullable=false, default='member', 'length': 'owner,admin,member')
	 */
	public $toprme_role;

	/**
	 * @Column(column='added_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $toprme_added_at;

	/**
	 * @Column(column='added_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $toprme_added_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('toprme_added_by', 'Profiles', 'pr_id', array('alias' => 'profiles_added_by'));
		$this->belongsTo('toprme_project_id', 'TodoProjects', 'topr_id', array('alias' => 'todo_projects_project_id'));
		$this->belongsTo('toprme_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('todo_project_members');
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
            'id' => 'toprme_id',
			'project_id' => 'toprme_project_id',
			'user_id' => 'toprme_user_id',
			'role' => 'toprme_role',
			'added_at' => 'toprme_added_at',
			'added_by' => 'toprme_added_by'
        );
    }

}
