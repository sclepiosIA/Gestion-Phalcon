<?php
use Phalcon\ModelBase;

class UserRoles extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $usro_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $usro_user_id;

	/**
	 * @Column(column='role', type='', mtype='enum', nullable=false, default='user', key='MUL', 'length': 'admin,commercial,chef_projet,csm,manager,rh,user')
	 */
	public $usro_role;

	/**
	 * @Column(column='assigned_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $usro_assigned_at;

	/**
	 * @Column(column='assigned_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $usro_assigned_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('usro_assigned_by', 'Users', 'us_id', array('alias' => 'users_assigned_by'));
		$this->belongsTo('usro_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('user_roles');
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
            'id' => 'usro_id',
			'user_id' => 'usro_user_id',
			'role' => 'usro_role',
			'assigned_at' => 'usro_assigned_at',
			'assigned_by' => 'usro_assigned_by'
        );
    }

}
